<?php
require_once("inc/init.inc.php");

$tab = array();
$tab['resultat'] = "";
$tab['pseudo'] = "disponible";

$erreur = false;  // variable de contrôle en fin de script. Si sa valeur est passée à true alors il y a eu une erreur (exemple le pseudo indisponible)

// extract($_POST);
$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
/*
if(isset($_POST['mode']))
{
    $mode = $_POST['mode'];
}
else {
    $mode = "";
}
*/
// action = condition ? condition vraie (if) : condition fausse (false);
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
$civilite = isset($_POST['civilite']) ? $_POST['civilite'] : '';
$ville = isset($_POST['ville']) ? $_POST['ville'] : '';
$date_de_naissance = isset($_POST['date_de_naissance']) ? $_POST['date_de_naissance'] : '';
// addslashes


if($mode == "connexion") {
    // traitement de la connexion/inscription
    // requête pour tester si le pseudo est déjà présent dans la BDD
    $resultat = $pdo->query("SELECT * FROM membre WHERE pseudo = '$pseudo' ");
    $membre = $resultat->fetch(PDO::FETCH_ASSOC);
    if($resultat->rowCount() == 0 )  // s'il n'y a pas de lignes alors le pseudo est libre car inexistant dans la BDD
    {
        $time = time();
        $pdo->query("INSERT INTO membre (pseudo, civilite, ville, date_de_naissance, ip, date_connexion) VALUES ('$pseudo', '$civilite', '$ville', '$date_de_naissance', '$_SERVER[REMOTE_ADDR]', '$time')");

        $id_membre = $pdo->lastInsertId();  // on récupère le dernier id inséré

        $tab['resultat'] = "Membre enregistré !";
    }
    elseif ($resultat->rowCount() > 0 && $_SERVER['REMOTE_ADDR'] == $membre['ip'])
    {
        // si le pseudo existe et que l'adresse ip est la même que celle enregistrée, c'est donc le même utilisateur
        // on met à jour uniquement sa date_connexion
        $time = time();
        $pdo->query("UPDATE membre SET date_connexion=$time WHERE id_membre = $membre[id_membre]");
        $id_membre = $membre['id_membre'];
    }
    else {
        // le pseudo est déjà pris et l'adresse ne correspond pas à ce pseudo
        $tab['resultat'] = "Pseudo indisponible, veuillez recommencer";
        $erreur = true;  // nous sommes dans un cas d'erreur, nous changeons la valeur de cette variable pour la tester après
        $tab['pseudo'] = "indisponible";  // évite la redirection depuis index.php
    }

    if(!$erreur)  // if($erreur == false)  // s'il n'y a pas d'erreur durant les traitements précédents
    {
        // on place dans la $_SESSION le pseudo, l'id et la civilité de l'utilisateur
        $_SESSION['id_membre'] = $id_membre;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['civilite'] = $civilite;

        $f =    fopen("prenom.txt", "a");  // on ouvre le fichier prenom.txt sinon on le crée
                fwrite($f, $pseudo . "\n");  // on écrit dans ce fichier le pseudo de l'utilisateur
                fclose($f);  // pour fermer le fichier et libérer de la ressource
    }

}
echo json_encode($tab);