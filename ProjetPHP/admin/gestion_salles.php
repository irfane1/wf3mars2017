<?php
require_once('../inc/init.inc.php');


// ---------------- TRAITEMENT -----------------------
// 1- Vérification ADMIN
// if (!internauteEstConnecteEtEstAdmin()) {
//     header('location:../connexion.php');  // si membre pas ADMIN, alors on le redirige vers la page de connexion qui est à la racine du site (en dehors du dossier admin)
//     exit();
// }

// 7- Suppression d'une salle
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_salle'])) {

    // On sélectionne en base la photo pour pouvoir supprimer le fichier photo correspondant
    $resultat = executeRequete("SELECT photo FROM salle WHERE id_salle = :id_salle", array(':id_salle' => $_GET['id_salle']));

    $produit_a_supprimer = $resultat->fetch(PDO::FETCH_ASSOC);  // pas de while car qu'un seul produit

    $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $produit_a_supprimer['photo'];  // chemin du fichier à supprimer

    if (!empty($produit_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) {
        // s'il y a un chemin de photo en base ET que le fichier existe (file_exists est une fonction prédéfinie), on peut le supprimer
        unlink($chemin_photo_a_supprimer);  // supprime le fichier spécifié
    }

    // Puis suppression de la salle en BDD
    executeRequete("DELETE FROM salle WHERE id_salle = :id_salle", array(':id_salle' => $_GET['id_salle']));

    $contenu .= '<div class="bg-success">La salle a été supprimée !</div>';
    $_GET['action'] = 'affichage';  // pour lancer l'affichage des produits dans le tableau HTML (point 6)
}





// 4- Enregistrement de la salle en BDD
if ($_POST) {  // équivalent à !empty($_POST) car si le $_POST est rempli, il vaut TRUE = formulaire posté

    // ici il faudrait mettre les contrôles sur le formulaire

    $photo = '';  // la photo subit un traitement spécifique en BDD. Cette variable contiendra son chemin d'accès

    // 9- Modification de la photo (suite)
    if (isset($_GET['action']) && $_GET['action'] == 'modification') {
        // si je suis en modification, je mets en base la photo du champ hidden photo_actuelle du formulaire
        $photo = $_POST['photo_actuelle'];
    }


    // 5- Traitement de la photo
    // echo '<pre>'; print_r($_FILES); echo '</pre>';
    if (!empty($_FILES['photo']['name'])) {  // si une image a été uploadée, $_FILES est remplie

        // On constitue un nom unique pour le fichier photo
        $nom_photo = $_POST['id_salle'] . '_' . $_FILES['photo']['name'];

        // On constitue le chemin de la photo enregistrée en BDD
        $photo = RACINE_SITE . 'photo/' . $nom_photo;  // on obtient ici le nom et le chemin de la photo depuis la racine du site

        // On constitue le chemin absolu complet de la photo depuis la racine serveur
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . $photo;

        // echo '<pre>'; print_r($photo_dossier); echo '</pre>';

        // Enregistrement du fichier photo sur le serveur
        copy($_FILES['photo']['tmp_name'], $photo_dossier);  // on copie le fichier temporaire de la photo stockée au chemin indiqué par $_FILES['photo']['tmp_name'] dans le chemin $photo_dossier de notre serveur

    }


    // 4- Suite de l'enregistrement en BDD
    executeRequete("REPLACE INTO salle (id_salle, titre, description, photo, pays, ville, adresse, cp, capacite, categories) VALUES(:id_salle, :titre, :description, :photo, :pays, :ville, :adresse, :cp, :capacite, :categories)", array('id_salle' => $_POST['id_salle'], 'titre' => $_POST['titre'], 'description' => $_POST['description'],  ':photo' => $photo, 'pays' => $_POST['pays'], 'ville' => $_POST['ville'], 'adresse' => $_POST['adresse'], 'cp' => $_POST['cp'], 'capacite' => $_POST['capacite'], 'categories' => $_POST['categories'] ));

    $contenu .= '<div class="bg-success">Le produit a été enregistré</div>';
    $_GET['action'] = 'affichage';  // on met la valeur 'affichage' dans $_GET['action'] pour afficher automatiquement la table HTML des produits plus loin dans le script (point 6)
}


// 2- Les liens "affichage" et "ajout d'une salle"
$contenu .= '<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des salles</a></li>
                <li><a href="?action=ajout">Ajout d\'une salle</a></li>
            </ul>';



// 6- Affichage des produits dans le back-office
if (isset($_GET['action']) && $_GET['action'] == 'affichage' || !isset($_GET['action'])) {  // si $_GET contient affichage ou que l'on arrive sur la page la 1ère fois ($_GET['action'] n'existe pas

    $resultat = executeRequete("SELECT * FROM salle");  // on sélectionne toutes les salles

    $contenu .= '<h3>Affichage des salles</h3>';
    $contenu .= '<p>Nombre de salle(s) : ' . $resultat->rowCount() . '</p>';

    $contenu .= '<table class="table">';
        // La ligne des en-têtes
        $contenu .= '<tr>';
            for($i = 0; $i < $resultat->columnCount(); $i++) {
                $colonne = $resultat->getColumnMeta($i);
                // echo '<pre>'; print_r($colonne); echo '</pre>';
                $contenu .= '<th>' . $colonne['name'] . '</th>';  // getColumnMeta() retourne un array contenant notamment l'indice name contenant le nom de la colonne
            }
            $contenu .= '<th>Action</th>';  // on ajoute une colonne "action"
        $contenu .= '</tr>';

        // Affichage des lignes
        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
            $contenu .= '<tr>';
                // echo '<pre>'; print_r($ligne); echo '</pre>';
                foreach($ligne as $index => $data) {  // $index réceptionne les indices, $data les valeurs
                    if ($index == 'photo') {
                        $contenu .= '<td><img src="'. $data .'" width="70" height="70"></td>';
                    } else {
                        $contenu .= '<td>' . $data . '</td>';                    
                    }
                }

                $contenu .= '<td>
                                <a href="?action=modification&id_salle='. $ligne['id_salle'] .'">Modifier</a> /
                                <a href="?action=suppression&id_salle='. $ligne['id_salle'] .'"
                                onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette salle ? \'));" >Supprimer</a> 
                            </td>';
            $contenu .= '</tr>';
        }
    $contenu .= '</table>';
}




// ---------------- AFFICHAGE -----------------------
require_once('../inc/haut.inc.php');
echo $contenu;

// 3- Formulaire HTML
if (isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')) :
// Si on a demandé l'ajout d'un produit ou sa modification , on affiche le formulaire

    // 8- Formulaire de modification avec présaisie des infos dans le formulaire
    if (isset($_GET['id_salle'])) {
        // Pour préremplir le formulaire, on requête en BDD les infos du produit passé dans l'URL
        $resultat = executeRequete("SELECT * FROM salle WHERE id_salle = :id_salle", array(':id_salle' => $_GET['id_salle']));

        $salle_actuelle = $resultat->fetch(PDO::FETCH_ASSOC);  // pas de while car qu'un seul produit

    }


?>
<h3>Formulaire d'ajout ou de modification d'une salle</h3>
<form method ="post" enctype="multipart/form-data" action=""><!-- "multipart/form-data" permet d'uploader un fichier et de générer une superglobale $_FILES -->

    <input type="hidden" id="id_salle" name="id_salle" value="<?php echo $salle_actuelle['id_salle'] ?? 0; ?>"><!-- champ caché qui réceptionne -->

    <label for="titre">Titre</label><br>
    <input type="text" id="titre" name="titre" placeholder="Titre de la salle" value="<?php echo $salle_actuelle['titre'] ?? ''; ?>"><br><br>

    <label for="description">Description</label><br>
    <textarea id="description" name="description" placeholder="Description de la salle"><?php echo $salle_actuelle['description'] ?? ''; ?></textarea><br><br>

    <label for="photo">Photo</label><br>
    <input type="file" id="photo" name="photo"><br><br><!-- coupler avec l'attribut enctype="multipart/form-data" de la balise <form>, le type 'file' permet d'uploader un fichier (ici une photo) -->

    <label for="pays">Pays</label><br>
    <input type="text" id="pays" name="pays" placeholder="Pays de la salle" value="<?php echo $salle_actuelle['pays'] ?? ''; ?>"><br><br>

    <label for="ville">Ville</label><br>
    <input type="text" id="ville" name="ville" placeholder="Ville de la salle" value="<?php echo $salle_actuelle['ville'] ?? ''; ?>"><br><br>

    <label for="adresse">Adresse</label><br>
    <input type="text" id="adresse" name="adresse" placeholder="Adresse de la salle" value="<?php echo $salle_actuelle['adresse'] ?? ''; ?>"><br><br>

    <label for="cp">Code postal</label><br>
    <input id=cp name=cp type=text placeholder="Code postal de la salle" value="<?php echo $salle_actuelle['cp'] ?? ''; ?>"><br><br>

    <label for="capacite">Capacité</label><br>
    <input id=capacite name=capacite type=text placeholder="Capacité de la salle" value="<?php echo $salle_actuelle['capacite'] ?? ''; ?>"><br><br>

    <label for="categories">Catégorie</label><br>
    <select name="categories">
        <option value="reunion" selected>Réunion</option>
        <option value="bureau" <?php if(isset($salle_actuelle['categories']) && $salle_actuelle['categories'] == 'bureau') echo 'selected'; ?>   >Bureau</option>
        <option value="formation" <?php if(isset($salle_actuelle['categories']) && $salle_actuelle['categories'] == 'formation') echo 'selected'; ?>   >Formation</option>
    </select><br><br><br>

    


    <!-- 9- Modification de la photo -->
    <?php
        if (isset($salle_actuelle['photo'])) {
            echo '<i>Vous pouvez uploader une nouvelle photo</i><br>';
            // Afficher la photo actuelle
            echo'<img src="'. $salle_actuelle['photo'] .'" width="90" height="90"><br>';
            // Mettre le chemin de la photo dans un champ caché pour l'enregistrer en base
            echo '<input type="hidden" name="photo_actuelle" value="'. $salle_actuelle['photo'] .'">';  // ce champ renseigne le $_POST['photo_actuelle'] qui va en base quand on soumet le formulaire de modification. Si on ne remplit pas le formulaire ici, le champ photo de la base est remplacé par un vide, ce qui efface le chemin de la photo
        }
    ?>


    <input type="submit" value="enregistrer" class="btn">

</form>
<?php
endif;
require_once('../inc/bas.inc.php');