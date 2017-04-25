<?php
// Exercice : créer le formulaire indiqué au tableau, récupérer les données saisies et les afficher dans la même page.

if(! empty($_POST)) {   // not empty signifie que l'array $_POST n'est pas vide, autrement dit que  le formulaire a été posté. Il peut cependant avoir été posté avec des champs vides : les valeurs de l'array $_POST sont vides MAIS il y a bien les indices 'prenom' et 'description' à l'intérieur.
    echo 'Ville : ' . $_POST['ville'] . '<br>';
    echo 'Code postal : ' . $_POST['cp'] . '<br>';  // attention : les name sont sensibles à la casse
    echo 'Adresse : ' . $_POST['adresse'] . '<br>';
}




?>

<h1>Formulaire2</h1>
<form method="post" action="">

    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville"><br>

    <label for="cp">Code postal</label>
    <input type="text" id="cp" name="cp"><br>

    <label for="adresse">Adresse</label>
    <textarea name="adresse" id="adresse"></textarea><br>

    <input type="submit" name="validation" value="envoyer">

</form>


