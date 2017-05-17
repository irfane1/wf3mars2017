<?php

//---------------------

if(isset($_GET['id_film'])){
	
	$query = $pdo->prepare('SELECT * FROM movies WHERE id_film = :id_film');
	$query->bindParam(':id_film', $_GET['id_film'], PDO::PARAM_INT);
	$query->execute();
	$film = $query->fetch(PDO::FETCH_ASSOC);

	$contenu .= '<h1>Détail du film</h1>';
	if (!empty($film)) {
		$contenu .= '<p>Titre : '. $film['title'] .'</p>';
		$contenu .= '<p>Acteur : '. $film['actors'] .'</p>';
		$contenu .= '<p>Réalisateur : '. $film['director'] .'</p>';
		$contenu .= '<p>Producteur : '. $film['producer'] .'</p>';
		$contenu .= '<p>Année de production : '. $film['year_of_prod'] .'</p>';
		$contenu .= '<p>Langue : '. $film['language'] .'</p>';
		$contenu .= '<p>Catégorie : '. $film['category'] .'</p>';
		$contenu .= '<p>Synopsis : '. $film['storyline'] .'</p>';
		$contenu .= '<p>Vidéo : '. $film['video'] .'</p>';
	} else {
		$contenu .= '<div>Ce film n\'existe pas</div>';
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Liste des films</title>
</head>
<body>
	<?php echo $contenu; ?>
</body>
</html>

