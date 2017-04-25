<?php

// Exercice : réaliser un formulaire "pseudo" et "email" en récupérant et affichant les informations dans formulaire3.php



?>

<h1>Formulaire3</h1>
<form method="post" action="formulaire4.php">   <!-- action permet de préciser le fichier de destination des informations -->

    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo"><br>

    <label for="email">Email</label>
    <input type="text" id="email" name="email"><br>

   <input type="submit" value="envoyer">

</form>