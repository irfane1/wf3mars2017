<h1>Couleur du fruit</h1>
<?php
// Exercice

/*
- Dans le fichier listeFruits.php : créer 3 liens banane, kiwi et cerise. Quand on clique sur les liens, on passe le nom du fruit dans l'URL à la page couleur.php

- Dans couleur.php : vous récupérer le nom du fruit et afficher sa couleur

- Notez que vous ne passez pas par la couleur dans l'URL mais vous la déduisez dans couleur.php
*/

// print_r($_GET);

if (isset($_GET['fruit'])) {
    echo 'Fruit : ' . $_GET['fruit'] . '<br>';

    if ($_GET['fruit'] == 'banane') {
        echo 'Couleur : jaune <br>';
    } elseif ($_GET['fruit'] == 'kiwi') {
        echo 'Couleur : vert <br>';
    } elseif ($_GET['fruit'] == 'cerise') {
        echo 'Couleur : rouge <br>';
    } else {
        echo 'Ce fruit n\'existe pas <br>';
    }
} else {
    echo 'Aucun fruit sélectionné';
}