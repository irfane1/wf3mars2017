<?php
require_once('inc/init.inc.php');
//---------------------------------------------------TRAITEMENT -----------------------------------------------------------
//SI le visiteur n'est pas connecté, on l\'envoit vers la page de connexion.php_ini_loaded_file
if(!internauteEstConnecte()){
    header('location:connexion.php'); //nous l'invitons à se connecter
    exit();
}
$contenu .= '<h2>Bonjour '.$_SESSION['membre']['pseudo'].'</h2>';
// On affiche le statut du membre
if($_SESSION['membre']['statut']==1){
    $contenu .= '<p>Vous êtes admin</p>';
} else {
    $contenu .= '<p>Vous êtes membre</p>';
}
$contenu .= '<div><h3> Voici votre historique</h3>';
    $contenu .= '<p>Votre email: '.$_SESSION['membre']['email'].'</p>';
    $contenu .= '<p>Inscrit(e) depuis le: '.$_SESSION['membre']['date_enregistrement'].'</p>';
    $contenu .= '</div>';
// if(isset($_SESSION['membre']){
    $id_membre =$_SESSION['membre']['id_membre'];
    $suivi = executeRequete("SELECT id_commande, date_enregistrement FROM commande WHERE id_membre = '$id_membre'");
    //S'il y ades commandes dans $resultat, on les affiche
    if ($suivi->rowCount() > 0) {
        //on affiche les commandes
    $contenu .= '<ul>';
    while ($suivi2 = $suivi->fetch(PDO::FETCH_ASSOC)){
    $contenu .= '<li>Votre commande N°: '.$suivi2['id_commande'].' du '.$suivi2['date_enregistrement'].'</li>';
    $contenu .= '</ul>';
    }
    } else { //il n'y a pas de coammandes'
    $contenu .= '<p>Vous n\'avez pas de commande en cours</p>';
    };
//---------------------------------------------------AFFICHAGE -----------------------------------------------------------
require_once('inc/haut.inc.php');
echo $contenu;
require_once('inc/bas.inc.php');
?>