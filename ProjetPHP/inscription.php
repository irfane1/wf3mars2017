<?php

// ---------------- TRAITEMENT -----------------------
require_once('inc/init.inc.php');
$inscription = false;  // variable qui permet de savoir si le membre est inscrit pour ne pas réafficher le formulaire d'inscription

// Traitement du POST
if (!empty ($_POST)) {  // si le formulaire est posté

    // Validation du formulaire
    if (strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20) {
        $contenu .= '<div class="bg-danger">Le pseudo doit contenir au moins 4 caractères</div>';
    }

    if (strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20) {
        $contenu .= '<div class="bg-danger">Le mot de passe doit contenir au moins 4 caractères</div>';
    }

    if (strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) {
        $contenu .= '<div class="bg-danger">Le nom doit contenir au moins 2 caractères</div>';
    }

    if (strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) {
        $contenu .= '<div class="bg-danger">Le prénom doit contenir au moins 2 caractères</div>';
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $contenu .= '<div class="bg-danger">Email est invalide</div>';
    }
    // filter_var() permet de valider des formats de chaînes de caractères pour vérifier qu'il s'agit ici d'email (on pourrait valider une URL par exemple).

    if ($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f') {
        $contenu .= '<div class="bg-danger">La civilité est incorrecte</div>';        
    }

    if (strlen($_POST['ville']) < 1 || strlen($_POST['ville']) > 20) {
        $contenu .= '<div class="bg-danger">La ville ne doit pas être vide</div>';
    }

    // Validation du Code postal avec une expression régulière
    if (!preg_match('#^[0-9]{5}$#', $_POST['code_postal'])) {  // preg_match retourne true si le tring en deuxième argument correspond à l'expression régulière
        $contenu .= '<div class="bg-danger">Le code postal n\'est pas valide</div>';        
    }
    /* Explication de l'expression régulière :
        Elle est délimitée par des # au début et à la fin
        Le ^ signifie que l'expression débute par tout ce qui suit
        Le $ signifie que l'expression termine par tout ce qui précède
        [0-9] définit l'intervalle de caractères autorisés, ici de 0 à 9
        {5} est un quantificateur qui indique qu'il faut 5 caractères autorisés (pas plus, pas moins)
    */


    if (strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 50) {
        $contenu .= '<div class="bg-danger">L\'adresse doit contenir au moins 4 caractères</div>';
    }

    // Si aucune erreur sur le formulaire, on vérifie l'unicité du pseudo avant inscription en BDD
    if (empty($contenu)) {  // si $contenu est vide, c'est qu'il n'y a pas d'erreur

        $membre = executeRequete("SELECT id_membre FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));  // on vérifie l'existence du pseudo

        if ($membre->rowCount() > 0) {  // s'il y a des lignes dans le résultat de la requête
            $contenu .= '<div class="bg-danger">Le pseudo est indisponible : veuillez en choisir un autre</div>';
        } else {
        // Si le pseudo est unique, on peut faire l'inscription en BDD

        $_POST['mdp'] = md5($_POST['mdp']);  // permet d'encrypter le mot de passe selon l'algorithme md5. Il faudra le faire aussi sur la page de connexion pour comparer 2 mots cryptés

        executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, 0)", array(':pseudo' => $_POST['pseudo'], ':mdp' => $_POST['mdp'], ':nom' => $_POST['nom'], ':prenom' => $_POST['prenom'], ':email' => $_POST['email'], ':civilite' => $_POST['civilite'], ':ville' => $_POST['ville'], ':code_postal' => $_POST['code_postal'], ':adresse' => $_POST['adresse']));

        $contenu .= '<div class="bg-success">Vous êtes inscrits. <a href="connexion.php">Cliquez ici pour vous connecter</a></div>';
        $inscription = true;  // pour ne plus afficher le formulaire d'inscription

        }        
    }  // fin du if (empty($contenu))
}  // fin du if(!empty($_POST))









// ---------------- AFFICHAGE -----------------------
require_once('inc/haut.inc.php');
echo $contenu;  // affiche les messages du site

if (!$inscription) :  // si membre non inscrit ($inscription vaut false), on affiche le formulaire
?>
<h3>Veuillez renseigner le formulaire pour vous inscrire</h3>
<form method="post" action="">
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
    <input type="radio" id="homme" name="civilite" value="m" checked><label for="homme">Homme</label>
    <input type="radio" id="femme" name="civilite" value="f"><label for="femme">Femme</label><br><br>
    
    <label for="ville">Ville</label><br>
    <input type="text" id="ville" name="ville" value=""><br><br>

    <label for="code_postal">Code postal</label><br>
    <input type="text" id="code_postal" name="code_postal" value=""><br><br>

    <label for="adresse">Adresse</label><br>
    <textarea id="adresse" name="adresse"></textarea><br><br>

    <input type="submit" name="inscription" value="s'inscrire" class="btn">

</form>


<?php
endif;  // synthaxe du if avec ":" qui remplace la première accolade et "endif" qui remplace la seconde
require_once('inc/bas.inc.php');