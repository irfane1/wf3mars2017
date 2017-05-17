<?php

$contenu = '';

$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$query = $pdo->prepare('SELECT * FROM movies');
$query->execute();
$contenu .= '<h1>Liste des films</h1>
			 <table border="1">';
		$contenu .= '<tr>
						<th>Nom du film</th>
						<th>Réalisateur</th>
						<th>Année de production</th>
						<th>Autres infos</th>
					</tr>';

while ($films = $query->fetch(PDO::FETCH_ASSOC)){
		$contenu .= '<tr>
						<td>'. $films['title'] .'</td>
						<td>'. $films['director'] .'</td>
						<td>'. $films['year_of_prod'] .'</td>
						<td>
							<a href="?exercice3etape4.php'. $films['id_film'] .'">Plus d\'infos</a>
						</td>
					</tr>';
	}			
			
$contenu .= '</table>';


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