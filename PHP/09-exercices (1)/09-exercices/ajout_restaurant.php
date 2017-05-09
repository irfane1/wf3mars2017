<?php

/* 1- Créer une base de données "restaurants" avec une table "restaurant" :
	  id_restaurant PK AI INT(3)
	  nom VARCHAR(100)
	  adresse VARCHAR(255)
	  telephone VARCHAR(10)
	  type ENUM('gastronomique', 'brasserie', 'pizzeria', 'autre')
	  note INT(1)
	  avis TEXT

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un restaurant dans la bdd. Les champs type et note sont des menus déroulants que vous créez avec des boucles.
	
	3- Effectuer les vérifications nécessaires :
	   Le champ nom contient 2 caractères minimum
	   Le champ adresse ne doit pas être vide
	   Le téléphone doit contenir 10 chiffres
	   Le type doit être conforme à la liste des types de la bdd
	   La note est un nombre entre 0 et 5
	   L'avis ne doit être vide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter le restaurant à la BDD et afficher un message en cas de succès ou en cas d'échec.

*/

$contenu = '';

$type = array('gastronomique', 'brasserie', 'pizzeria', 'autre');

$pdo = new PDO('mysql:host=localhost;dbname=restaurants', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));



if (!empty ($_POST)) {

	if (strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 100) {
        $contenu .= '<div class="bg-danger">Le nom doit contenir au moins 2 caractères</div><br>';
    }

	if (empty($_POST['adresse']) || strlen($_POST['adresse']) > 255) {
        $contenu .= '<div class="bg-danger">Veuillez entrer une adresse</div><br>';
    }

	if (!preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {
        $contenu .= '<div class="bg-danger">Le téléphone doit contenir 10 caractères</div><br>';
    }

	if(!in_array($_POST['type'], $type)){
		$contenu .= '<article>Le type n\'est pas correct</article><br>';
	} 

	if (!is_numeric($_POST['note']) || $_POST['note'] < 0 || $_POST['note'] > 5) {
        $contenu .= '<div class="bg-danger">La note doit être entre 0 et 5</div><br>';
    }

	if (empty($_POST['avis'])) {
        $contenu .= '<div class="bg-danger">Veuillez laisser un avis</div><br>';
    }

	if (empty($contenu)) {

		foreach($_POST as $indice => $valeur){
			$_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
		}

		$query = $pdo->prepare('INSERT INTO restaurant (nom, adresse, telephone, type, note, avis) VALUES (:nom, :adresse, :telephone, :type, :note, :avis)');
			
		$query->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
		$query->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
		$query->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_STR);
		$query->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
		$query->bindParam(':note', $_POST['note'], PDO::PARAM_INT);
		$query->bindParam(':avis', $_POST['avis'], PDO::PARAM_STR);

		$succes = $query->execute();

		if ($succes) {
			$contenu .= '<div>Votre avis a bien été validé<div><br>';
		} else {
			$contenu .= '<div>Erreur lors de la soumission du formulaire<div><br>';
	}

}


?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Formulaire</title>
	</head>
	<body>
	<?php echo $contenu; ?>
		<form method="post" action="">
			<label for="id_restaurant">Identifiant restaurant</label>
			<input type="text" id="id_restaurant" name="id_restaurant"><br><br>

			<label for="nom">Nom</label>
			<input type="text" id="nom" name="nom"><br><br>

			<label for="adresse">Adresse</label><br>
  			<textarea id="adresse" name="adresse"></textarea><br><br>

			<label for="telephone">Téléphone</label>
			<input type="text" id="telephone" name="telephone"><br><br>

			<label for="type">Type</label>
                <select name="type" id="type">
                    <?php 
                    foreach($type as $key => $value){
                        echo "<option value=$value>$value</option>";
                    } 
                    ?>			
                </select><br><br>

			<label for="note">Note</label>
                <select name="note" id="note">
                    <?php 
                    for($i = 0; $i <= 5; $i++){
                        echo "<option value=$i>$i</option>";
                    } 
                    ?>			
                </select><br><br>
			
			<label for="avis">Avis</label><br>
  			<textarea id="avis" name="avis"></textarea><br><br>

			<input type="submit" name="validation" value="envoyer">


		</form>
		
	</body>
</html>