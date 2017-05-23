<?php
require_once('../inc/init.inc.php');


// ---------------- TRAITEMENT -----------------------
// 1- Vérification ADMIN
// if (!internauteEstConnecteEtEstAdmin()) {
//     header('location:../connexion.php');  // si membre pas ADMIN, alors on le redirige vers la page de connexion qui est à la racine du site (en dehors du dossier admin)
//     exit();
// }

// 7- Suppression d'une avis
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_avis'])) {  
 
    executeRequete("DELETE FROM avis WHERE id_avis = :id_avis", array(':id_avis' => $_GET['id_avis']));

    $contenu .= '<div class="bg-success">L\'avis a été supprimée !</div>';
    $_GET['action'] = 'affichage';  // pour lancer l'affichage des aviss dans le tableau HTML (point 6)
}





// 4- Enregistrement de la avis en BDD
if ($_POST) {  // équivalent à !empty($_POST) car si le $_POST est rempli, il vaut TRUE = formulaire posté

    // 4- Suite de l'enregistrement en BDD
    executeRequete("REPLACE INTO avis (id_avis, id_membre, id_salle, commentaire, note, date_enregistrement) VALUES(:id_avis, :id_membre, :id_salle, :commentaire, :note, NOW())", array('id_avis' => $_POST['id_avis'], 'id_membre' => $_POST['id_membre'], 'id_salle' => $_POST['id_salle'],  ':commentaire' => $_POST['commentaire'], 'note' => $_POST['note'] ));

    $contenu .= '<div class="bg-success">L\'avis a été enregistré</div>';
    $_GET['action'] = 'affichage';  // on met la valeur 'affichage' dans $_GET['action'] pour afficher automatiquement la table HTML des aviss plus loin dans le script (point 6)
}






// 6- Affichage des avis dans le back-office
if (isset($_GET['action']) && $_GET['action'] == 'affichage' || !isset($_GET['action'])) {  // si $_GET contient affichage ou que l'on arrive sur la page la 1ère fois ($_GET['action'] n'existe pas

    $resultat = executeRequete("SELECT * FROM avis");  // on sélectionne tous les avis

    $contenu .= '<h3>Affichage des avis</h3>';
    $contenu .= '<p>Nombre d\'avis(s) : ' . $resultat->rowCount() . '</p>';

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
                                <a href="?action=modification&id_avis='. $ligne['id_avis'] .'">Modifier</a> /
                                <a href="?action=suppression&id_avis='. $ligne['id_avis'] .'"
                                onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cet avis ? \'));" >Supprimer</a> 
                            </td>';
            $contenu .= '</tr>';
        }
    $contenu .= '</table>';
}




// ---------------- AFFICHAGE -----------------------
require_once('../inc/haut.inc.php');
echo $contenu;

// 3- Formulaire HTML
if (isset($_GET['action']) && $_GET['action'] == 'modification') :
// Si on a demandé la modification d'un avis, on affiche le formulaire

    // 8- Formulaire de modification avec présaisie des infos dans le formulaire
    if (isset($_GET['id_avis'])) {
        // Pour préremplir le formulaire, on requête en BDD les infos de l'avis passé dans l'URL
        $resultat = executeRequete("SELECT * FROM avis WHERE id_avis = :id_avis", array(':id_avis' => $_GET['id_avis']));

        $avis_actuel = $resultat->fetch(PDO::FETCH_ASSOC);  // pas de while car qu'un seul avis

    }


?>
<h3>Formulaire de modification d'un avis</h3>
<form method ="post" enctype="multipart/form-data" action=""><!-- "multipart/form-data" permet d'uploader un fichier et de générer une superglobale $_FILES -->

    <input type="hidden" id="id_avis" name="id_avis" value="<?php echo $avis_actuel['id_avis'] ?? 0; ?>"><!-- champ caché qui réceptionne -->

    <label for="id_avis">id_avis</label><br>
    <input type="text" id="id_avis" name="id_avis" placeholder="Titre de la avis" value="<?php echo $avis_actuel['id_avis'] ?? ''; ?>"><br><br>

    <label for="id_membre">id_membre</label><br>
    <input type="id_membre" id="id_membre" name="id_membre" placeholder="id_membre de la avis" value="<?php echo $avis_actuel['id_membre'] ?? ''; ?>"><br><br>

    <label for="id_salle">id_salle</label><br>
    <input type="id_salle" id="id_salle" name="id_salle" placeholder="id_salle de la avis" value="<?php echo $avis_actuel['id_salle'] ?? ''; ?>"><br><br> 

    <label for="commentaire">Commentaire</label><br>
    <input type="commentaire" name="commentaire" placeholder="commentaire de la avis" value="<?php echo $avis_actuel['commentaire'] ?? ''; ?>"><br><br>    

    <label>Note</label><br>
    <select name="note">
        <option value="5etoile" selected>★★★★★</option>
        <option value="4etoile" <?php if(isset($avis_actuel['note']) && $avis_actuel['note'] == '4') echo 'selected'; ?>   >★★★★</option>
        <option value="3etoile" <?php if(isset($avis_actuel['note']) && $avis_actuel['note'] == '3') echo 'selected'; ?>   >★★★</option>
        <option value="2etoile" <?php if(isset($avis_actuel['note']) && $avis_actuel['note'] == '2') echo 'selected'; ?>   >★★</option>
        <option value="1etoile" <?php if(isset($avis_actuel['note']) && $avis_actuel['note'] == '1') echo 'selected'; ?>   >★</option>        
    </select><br><br><br>

    <input type="submit" value="enregistrer" class="btn">

</form>
<?php
endif;
require_once('../inc/bas.inc.php');