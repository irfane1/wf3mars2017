<?php

$contenu = '';
$langues = array('français', 'anglais', 'espagnol', 'autre');
$categories = array('comédie', 'drame', 'policier', 'autre');


$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));



if(!empty($_POST)) {
    if (strlen($_POST['title']) < 5 || strlen($_POST['title']) > 255){
		$contenu .= '<div style="color:red;">Le TITRE doit comporter au moins 5 caractères</div><br>';
	}

    if (strlen($_POST['actors']) < 5 || strlen($_POST['actors']) > 255){
		$contenu .= '<div style="color:red;">Le champ ACTEURS doit comporter au moins 5 caractères</div><br>';
	}

    if (strlen($_POST['director']) < 5 || strlen($_POST['director']) > 255){
		$contenu .= '<div style="color:red;">Le champ NOM DU REALISATEUR doit comporter au moins 5 caractères</div><br>';
	}

    if (strlen($_POST['producer']) < 5 || strlen($_POST['producer']) > 255){
		$contenu .= '<div style="color:red;">Le champ PRODUCTEUR doit comporter au moins 5 caractères</div><br>';
	}

    if (strlen($_POST['storyline']) < 5 || strlen($_POST['storyline']) > 255){
		$contenu .= '<div style="color:red;">Le champ SYNOPSIS doit comporter au moins 5 caractères</div><br>';
	}


    // if (!preg_match('#^(http|https)://[\w-]+[\w.-]+\.[a-zA-Z]{2,6}#i', $_POST['video'])){
    //     $contenu .= '<div style="color:red;">L\'URL n\'est pas valide</div><br>';
    // }

    if (empty($contenu)) {

		foreach($_POST as $indice => $valeur)
		{
			$_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
		}


		$query = $pdo->prepare("INSERT INTO movies(title, actors, director, producer, year_of_prod, language, category, storyline, video) VALUES(:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video)");

        $query->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
        $query->bindParam(':actors', $_POST['actors'], PDO::PARAM_STR);
        $query->bindParam(':director', $_POST['director'], PDO::PARAM_STR);
        $query->bindParam(':producer', $_POST['producer'], PDO::PARAM_STR);
        $query->bindParam(':year_of_prod', $_POST['year_of_prod'], PDO::PARAM_INT);
        $query->bindParam(':language', $_POST['language'], PDO::PARAM_STR);
        $query->bindParam(':category', $_POST['category'], PDO::PARAM_STR);
        $query->bindParam(':storyline', $_POST['storyline'], PDO::PARAM_STR);
        $query->bindParam(':video', $_POST['video'], PDO::PARAM_STR);
        $succes = $query->execute();
                    
        if($succes){
            echo 'Le film a été enregistré avec succès';
        } else{
            echo 'Erreur lors de l\'enregistrement';
        }
    }
            

}


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ajouter un film</title>
    </head>
    <body>

    <h1>Ajouter un film</h1>

	<?php echo $contenu; ?>

	<form method="post" action="">

        <div class="input-group">
			<label for="title">Titre</label>
			<input type="text" name="title" id="title">
		</div>

		<div class="input-group">
			<label for="actors ">Acteurs</label>
			<input type="text" name="actors" id="actors">
		</div>

		<div class="input-group">
			<label for="director">Nom du réalisateur</label>
			<input type="text" name="director" id="director">
		</div>

        <div class="input-group">
			<label for="producer">Producteur</label>
			<input type="text" name="producer" id="producer">
		</div>


		<div class="input-group">
			<label for="year_of_prod">Année de production</label>
	
			<select name="year_of_prod" id="<year_of_prod></year_of_prod>">
				<?php 
				for($i=date('Y'); $i>=date('Y')-100; $i--) {
					echo "<option value=$i>$i</option>";
				} 
				?>
				
			</select>
		</div>


		<div class="input-group">
			<label for="language">Langue</label>
	
			<select name="language" id="language">
				<?php 
				foreach($langues as $key => $value){
					echo "<option value=$value>$value</option>";
				} 
				?>
				
			</select>
		</div>


        <div class="input-group">
			<label for="category">Catégorie</label>
	
			<select name="category" id="category">
				<?php 
				foreach($categories as $key => $value){
					echo "<option value=$value>$value</option>";
				} 
				?>
				
			</select>
		</div>


		<div class="input-group">
			<label for="storyline">Synopsis</label>
			<input type="text" name="storyline" id="storyline">
		</div>

        <div class="input-group">
			<label for="video">Lien de la bande-annonce</label>
			<input type="text" name="video" id="video">
		</div>

        <button type="submit">Envoyer</button>
    
    </form>
        
    </body>
</html>