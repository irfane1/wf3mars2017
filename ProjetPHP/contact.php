<?php

// ---------------- TRAITEMENT -----------------------
require_once('inc/init.inc.php');
$inscription = false;  // variable qui permet de savoir si le membre est inscrit pour ne pas réafficher le formulaire d'inscription

// Traitement du POST
if (!empty ($_POST)) {  // si le formulaire est posté

    // Validation du formulaire

    if (strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {
        $contenu .= '<div class="bg-danger">Le nom doit contenir au moins 2 caractères</div>';
    }

    if (strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) {
        $contenu .= '<div class="bg-danger">Le prénom doit contenir au moins 2 caractères</div>';
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $contenu .= '<div class="bg-danger">Email est invalide</div>';
    }


    if (strlen($_POST['message']) < 4) {
        $contenu .= '<div class="bg-danger">Le message doit contenir au moins 4 caractères</div>';
    }

    // Si aucune erreur sur le formulaire, on vérifie l'unicité du pseudo avant inscription en BDD
    if (empty($contenu)) {  // si $contenu est vide, c'est qu'il n'y a pas d'erreur    

        executeRequete("INSERT INTO membre (nom, prenom, email, message) VALUES(:nom, :prenom, :email, :message)", array(':nom' => $_POST['nom'], ':prenom' => $_POST['prenom'], ':email' => $_POST['email'], ':message' => $_POST['message']));

        $contenu .= '<div class="bg-success">Votre message a bien été envoyé.</div>';

           
    }  // fin du if (empty($contenu))
}  // fin du if(!empty($_POST))









// ---------------- AFFICHAGE -----------------------
require_once('inc/haut.inc.php');
echo $contenu;  // affiche les messages du site

if (!$inscription) :  // si membre non inscrit ($inscription vaut false), on affiche le formulaire
?>
<h3>Formulaire de contact</h3>

<form method="post" action="">

    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" value=""><br><br>

    <label for="prenom">Prénom</label><br>
    <input type="text" id="prenom" name="prenom" value=""><br><br>

    <label for="email">Email</label><br>
    <input type="text" id="email" name="email" value=""><br><br>

    <label>Message</label><br>
    <textarea name="message" cols="60" rows="10"></textarea><br><br>

    <input type="submit" name="inscription" value="envoyer" class="btn">

</form>

<?php
endif;  // synthaxe du if avec ":" qui remplace la première accolade et "endif" qui remplace la seconde
require_once('inc/bas.inc.php');