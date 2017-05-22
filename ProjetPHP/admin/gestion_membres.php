<?php
require_once('../inc/init.inc.php');


// ---------------- TRAITEMENT -----------------------
// 1- Vérification ADMIN
// if (!internauteEstConnecteEtEstAdmin()) {
//     header('location:../connexion.php');  // si membre pas ADMIN, alors on le redirige vers la page de connexion qui est à la racine du site (en dehors du dossier admin)
//     exit();
// }

$resultat = '';

// 7- Suppression d'un membre
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_membre'])) {

    

    $membre_a_supprimer = $resultat->fetch(PDO::FETCH_ASSOC);  // pas de while car qu'un seul produit

    
    // Puis suppression de la membre en BDD
    executeRequete("DELETE FROM membre WHERE id_membre = :id_membre", array(':id_membre' => $_GET['id_membre']));

    $contenu .= '<div class="bg-success">La membre a été supprimé !</div>';
    $_GET['action'] = 'affichage';  // pour lancer l'affichage des produits dans le tableau HTML (point 6)
}





// 4- Enregistrement de la membre en BDD
if ($_POST) {  // équivalent à !empty($_POST) car si le $_POST est rempli, il vaut TRUE = formulaire posté

    // ici il faudrait mettre les contrôles sur le formulaire


    // 4- Suite de l'enregistrement en BDD
    executeRequete("REPLACE INTO membre (id_membre, pseudo, mdp, nom, prenom, email, civilite, statut, date) VALUES(:id_membre, :pseudo, :mdp, :nom, :prenom, :email, :civilite, :statut, NOW())", array('id_membre' => $_POST['id_membre'], 'pseudo' => $_POST['pseudo'], 'mdp' => $_POST['mdp'],  ':nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'email' => $_POST['email'], 'civilite' => $_POST['civilite'], 'statut' => $_POST['statut'] ));

    $contenu .= '<div class="bg-success">Le membre a été enregistré</div>';
    $_GET['action'] = 'affichage';  // on met la valeur 'affichage' dans $_GET['action'] pour afficher automatiquement la table HTML des produits plus loin dans le script (point 6)
}


// 2- Les liens "affichage" et "ajout d'un membre"
$contenu .= '<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des membres</a></li>
                <li><a href="?action=ajout">Ajout d\'un membre</a></li>
            </ul>';



// 6- Affichage des produits dans le back-office
if (isset($_GET['action']) && $_GET['action'] == 'affichage' || !isset($_GET['action'])) {  // si $_GET contient affichage ou que l'on arrive sur la page la 1ère fois ($_GET['action'] n'existe pas

    $resultat = executeRequete("SELECT * FROM membre");  // on sélectionne tous les membres

    $contenu .= '<h3>Affichage des membres</h3>';
    $contenu .= '<p>Nombre de membre(s) : ' . $resultat->rowCount() . '</p>';

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
                                <a href="?action=modification&id_membre='. $ligne['id_membre'] .'">Modifier</a> /
                                <a href="?action=suppression&id_membre='. $ligne['id_membre'] .'"
                                onclick="return(confirm(\'Etes-vous certain de vouloir supprimer ce membre ? \'));" >Supprimer</a> 
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
    if (isset($_GET['id_membre'])) {
        // Pour préremplir le formulaire, on requête en BDD les infos du produit passé dans l'URL
        $resultat = executeRequete("SELECT * FROM membre WHERE id_membre = :id_membre", array(':id_membre' => $_GET['id_membre']));

        $membre_actuel = $resultat->fetch(PDO::FETCH_ASSOC);  // pas de while car qu'un seul produit

    }


?>
<h3>Formulaire d'ajout ou de modification d'un membre</h3>
<form method ="post" enctype="multipart/form-data" action=""><!-- "multipart/form-data" permet d'uploader un fichier et de générer une superglobale $_FILES -->

    <input type="hidden" id="id_membre" name="id_membre" value="<?php echo $membre_actuel['id_membre'] ?? 0; ?>"><!-- champ caché qui réceptionne -->

    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" value=""><br><br>

    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp" name="mdp" value=""><br><br>

    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" value=""><br><br>

    <label for="prenom">Prénom</label><br>
    <input type="text" id="prenom" name="prenom" value=""><br><br>

    <label for="email">Email</label><br>
    <input type="text" id="email" name="email" value=""><br><br>

    <label>Civilité</label><br>
    <input type="radio" id="homme" name="civilite" value="m" checked><label for="homme">Homme</label><br>
    <input type="radio" id="femme" name="civilite" value="f"><label for="femme">Femme</label><br><br>

    <label>Statut</label><br>
    <input type="radio" id="admin" name="statut" value="admin" checked><label for="admin">Administrateur</label><br>
    <input type="radio" id="utilisateur" name="statut" value="utilisateur"><label for="utilisateur">Utilisateur</label><br><br>


    <input type="submit" value="enregistrer" class="btn">

</form>
<?php
endif;
require_once('../inc/bas.inc.php');