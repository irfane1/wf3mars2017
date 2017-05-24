<?php
//Traitement
require_once('inc/init.inc.php');
$inscription = false;
//Traitement du post
if(!empty($_POST)) { // Si le formulaire est posté
        //validation du formulaire:
        if (strlen($_POST['pseudo']) <4 || strlen($_POST['pseudo']) >20){
            $contenu .= '<div class="bg-danger">Le pseudo doit contenir au moins 4 caractères</div>';
        }
        if (strlen($_POST['mdp']) <4 || strlen($_POST['mdp']) >20){
            $contenu .= '<div class="bg-danger">Le mdp doit contenir au moins 4 caractères</div>';
        }
        if (strlen($_POST['nom']) <2 || strlen($_POST['nom']) >20){
            $contenu .= '<div class="bg-danger">Le nom doit contenir au moins 4 caractères</div>';
        }
        if (strlen($_POST['prenom']) <2 || strlen($_POST['prenom']) >20){
            $contenu .= '<div class="bg-danger">Le prénom doit contenir au moins 4 caractères</div>';
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $contenu = '<div class="bg-danger">Email est invalide</div>';
        }
        //filter var() permet de valider des formats de chaines de caractères pour valider qu'il s'agit ici d'email (on pourrait valider une rul par exemple)'
        if($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f'){
            $contenu .= '<div class="bg-danger">La civilité est incorrecte</div>';
        }
        // SI aucune erreur sur le formulaire, on vérifie l'unicité du pseudo avant l'inscription en bdd:
        if(empty($contenu)) { //Si contenu est vide, c'est qu'il n'y a pas de message d'errerur
            $membre = executeRequete("SELECT id_membre FROM membre WHERE pseudo = :pseudo", array(':pseudo'=>$_POST['pseudo'])); //on vérifie l'existence du pseudo
            if($membre->rowCount()>0){ //s'il y a des ligne sdasn el resultat de la requête '
             $contenu .= '<div class="bg-danger">Le pseudo est indisponible, Choisissez-en un autre</div>';
            } else {
                //si le pseudo est unique, on peut faire l'inscription en bdd:
                $_POST['mdp']= md5($_POST['mdp']); //Permet d'encrypter le mt de passe
                executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, date_enregistrement) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, NOW() )", array(':pseudo' => $_POST['pseudo'], ':mdp'=> $_POST['mdp'], ':nom'=>$_POST['nom'], ':prenom'=>$_POST['prenom'], ':email'=>$_POST['email'], ':civilite'=>$_POST['civilite'] ));
                $contenu .= '<div class="bg-success"> Vous êtes inscrits. <a href="connexion.php"> Cliquez ici pour vous connecter</a></div>';
                $inscription = true; // pour ne plus afficher le formulaire d'inscription'
            } // fin du else de if ($membre->rowcount () > 0)
        } //fin du if (empty($contenu))
}// fin du if(!empty($_POST))
// Affichage
require_once('inc/haut.inc.php');
echo $contenu;  //affiche des messages du site
if (!$inscription) : // Si membre non inscrit, on affiche le formulaire.
?>

<h3>S'inscrire</h3>
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

    <label for="civilite">civilite</label><br>
    <select name="civilite" id="civilite">
    <option name="civilite" id="homme" value="m">Homme</option>
    <option name="civilite" id="femme" value="f">Femme</option>
    </select><br><br>


    <input type="submit" name="inscription" value="s'inscrire" class="btn"><br><br>
</form>


<?php
endif; //synthaxe du if avec : qui remplace la première accolade et endif qui remplace la seocnde
require_once('inc/bas.inc.php');
?>