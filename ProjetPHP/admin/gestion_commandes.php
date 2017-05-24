<?php
require_once('../inc/init.inc.php');


// ---------------- TRAITEMENT -----------------------
// 1- Vérification ADMIN
// if (!internauteEstConnecteEtEstAdmin()) {
//     header('location:../connexion.php');  // si membre pas ADMIN, alors on le redirige vers la page de connexion qui est à la racine du site (en dehors du dossier admin)
//     exit();
// }

// 7- Suppression d'une commande
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_commande'])) {

    // Puis suppression de la commande en BDD
    executeRequete("DELETE FROM commande WHERE id_commande = :id_commande", array(':id_commande' => $_GET['id_commande']));

    $contenu .= '<div class="bg-success">La commande a été supprimée !</div>';
    $_GET['action'] = 'affichage';  // pour lancer l'affichage des produits dans le tableau HTML (point 6)
}



// 4- Enregistrement de la commande en BDD
if ($_POST) {  // équivalent à !empty($_POST) car si le $_POST est rempli, il vaut TRUE = formulaire posté


    // 4- Suite de l'enregistrement en BDD
    executeRequete("REPLACE INTO commande (id_commande, id_membre, id_produit['prix'], date_enregistrement) VALUES(:id_commande, :id_membre, :id_produit['prix'], NOW())", array('id_commande' => $_POST['id_commande'], 'id_membre' => $_POST['id_membre'], 'id_produit' => $_POST['id_produit'] ));

    $contenu .= '<div class="bg-success">La commande a été enregistrée</div>';
    $_GET['action'] = 'affichage';  // on met la valeur 'affichage' dans $_GET['action'] pour afficher automatiquement la table HTML des produits plus loin dans le script (point 6)
}





// 6- Affichage des produits dans le back-office
if (isset($_GET['action']) && $_GET['action'] == 'affichage' || !isset($_GET['action'])) {  // si $_GET contient affichage ou que l'on arrive sur la page la 1ère fois ($_GET['action'] n'existe pas

    $resultat = executeRequete("SELECT * FROM commande");  // on sélectionne toutes les commandes

    $contenu .= '<h3>Affichage des commandes</h3>';
    $contenu .= '<p>Nombre de commande(s) : ' . $resultat->rowCount() . '</p>';

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
                                <a href=""><i class="fa fa-search" aria-hidden="true"></i></a> /
                                <a href="?action=suppression&id_commande='. $ligne['id_commande'] .'"
                                onclick="return(confirm(\'Etes-vous certain de vouloir supprimer cette commande ? \'));" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> 
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
    if (isset($_GET['id_commande'])) {
        // Pour préremplir le formulaire, on requête en BDD les infos du produit passé dans l'URL
        $resultat = executeRequete("SELECT * FROM commande WHERE id_commande = :id_commande", array(':id_commande' => $_GET['id_commande']));

        $commande_actuelle = $resultat->fetch(PDO::FETCH_ASSOC);  // pas de while car qu'un seul produit

    }


endif;
require_once('../inc/bas.inc.php');