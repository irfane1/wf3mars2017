<?php
require_once('inc/init.inc.php');


// ---------------- TRAITEMENT -----------------------
// Déconnexion demandée par l'internaute
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    // si l'internaute demande la déconnexion, on détruit la session :
    session_destroy();
}


// Internaute déjà connecté
if (internauteEstConnecte()) {  // si l'internaute est déjà connecté, il n'a rien à faire ici, on le redirige donc vers son profil
    header('location:profil.php');  // demande la page profil.php
}

// Traitement du formulaire de connexion et remplissage de la session
if (!empty($_POST)) {
    // contrôle de formulaire
    if (empty($_POST['pseudo'])) {
        $contenu .= '<div class="bg-danger">Le pseudo est requis</div>';
    }
    if (empty($_POST['mdp'])) {
        $contenu .= '<div class="bg-danger">Le mot de passe est requis</div>';
    }

    // Si le formulaire est correct, on contrôle les identifiants
    if (empty($contenu)) {
        $mdp = md5($_POST['mdp']);  // on crypte le mdp pour le comparer avec celui de la base

        $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp", array(':pseudo' => $_POST['pseudo'], ':mdp' => $mdp));

        if ($resultat->rowCount() != 0) {  // s'il y a un enregistrement dans le $résultat, c'est que pseudo et mot de passe correspondent
            $membre = $resultat->fetch(PDO::FETCH_ASSOC);  // pas de while car il n'y a qu'un seul pseudo de même nom (ils sont uniques)
            // echo '<pre>'; print_r($membre); echo '</pre>';

            $_SESSION['membre'] = $membre;  // nous remplissons la session avec des éléments provenant de la BDD. Cette session permet de conserver les infos du membre dans l'ensemble du site.

            header('location:profil.php');  // le membre étant connecté, on l'envoie vers son profil
            exit();
        } else {
            // si les identifiants ne correspondent pas, on affiche un message d'erreur
            $contenu .= '<div class="bg-danger">Erreur sur les identifiants</div>';
        }
    }  // fin du if (empty($contenu))
}  // fin du if (!empty($_POST))


// ---------------- AFFICHAGE -----------------------
require_once('inc/haut.inc.php');
echo $contenu;
?>
<h3>Veuillez renseigner vos identifiants pour vous connecter</h3>
<form method="post" action="">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" value=""><br><br>

    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp" name="mdp" value=""><br><br>

    <input type="submit" value="se connecter" class="btn">
</form>

<?php
require_once('inc/bas.inc.php');