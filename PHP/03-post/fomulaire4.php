<?php

// Exercice : réaliser un formulaire "pseudo" et "email" en récupérant et affichant les informations dans formulaire4.php

// De plus, une fois le formulaire soumis, vous vérifierez que le pseudo n'est pas vide. Si tel est le cas, affichez un message d'erreur à l'internaute (dans formulaire4.php).




if (!empty($_POST)) {   // = si le formulaire est soumis, il y a les indices correspondants aux names
    if (!empty($_POST['pseudo'])) {
        echo 'Pseudo : ' . $_POST['pseudo'] . '<br>';
    } else {
        echo 'Erreur sur le pseudo <br>';
    }

    echo 'Email : ' . $_POST['email'] . '<br>';
}






