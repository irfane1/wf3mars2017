<?php


//***************** Fonctions membres ***************
function internauteEstConnecte() {
    // Cette fonction indique si l'internaute est connecté : si la session 'membre' est définie, c'est que l'internaute est passé par la page de connexion avec le bon mot de passe
    if (isset($_SESSION['membre'])) {
        return true;
    } else {
        return false;
    }

    // on pourrait écrire :
    // return isset($_SESSION['membre']); car isset retourne déjà true ou false
}

//---------
function internauteEstConnecteEtEstAdmin() {
    // Cette fonction indique si le membre connecté est admin
    if (internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) {
        return true;
    } else {
        return false;
    }
}