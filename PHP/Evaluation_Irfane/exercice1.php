<?php

/*
    Créer un tableau en PHP contenant les infos suivantes :
        ● Prénom
        ● Nom
        ● Adresse
        ● Code Postal
        ● Ville
        ● Email
        ● Téléphone
        ● Date de naissance au format anglais (YYYY-MM-DD)

    A l’aide d’une boucle, afficher le contenu de ce tableau (clés + valeurs) dans une liste HTML.
    La date sera affichée au format français (DD/MM/YYYY).

    Bonus : Gérer l’affichage de la date de naissance à l’aide de la classe DateTime
*/


$tableau = array('Prénom' => 'Irfane', 'Nom' => 'Tayabdjee', 'Adresse' => '12 rue des Tulipes', 'Code Postal' => '75014', 'Ville' => 'Paris', 'Email' => 'irfanetayabdjee@msn.com', 'Téléphone' => '0665087495', 'Date de naissance' => '1990-08-08');

$contenu = '';


$contenu .= '<ul>';

foreach ($tableau as $key => $value) {
    if ($value == '1990-08-08'){
        $value = new DateTime('1990-08-08');
        echo '<li> Date de naissance :  ' .$value->format('d/m/Y') . '</li><br>';
        
    } else {
        echo "<li> $key :  $value</li><br>";
    }

    
}


?>