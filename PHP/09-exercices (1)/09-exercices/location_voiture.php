<?php
/*
   1- Vous créez un formulaire avec un menu déroulant avec les catégories A,B,C et D de véhicules de location et un champ nombre de jours de location. Lorsque le formulaire est soumis, vous affichez "La location de votre véhicule sera de X euros pour Y jour(s)." sous le formulaire.

   2- Vous validez le formulaire : la catégorie doit être correcte et le nombre de jours un entier positif.

   3- Vous créez une fonction prixLoc qui retourne le prix total de la location en fonction du prix de la catégorie choisie (A : 30€, B : 50€, C : 70€, D : 90€) multiplié par le nombre de jours de location. 

   4- Si le prix de la location est supérieur à 150€, vous consentez une remise de 10%.

*/


$contenu = '';

$categorie = array('A', 'B', 'C', 'D');






if (!empty ($_POST)) {

   

    if ($_POST['categorie'] != 'A' && $_POST['categorie'] != 'B' && $_POST['categorie'] != 'C' && $_POST['categorie'] != 'D') {
		$contenu .= '<div>Le type de catégorie n\'est pas valide</div>';
	}

    if(empty ($_POST['jours'])) {
        $contenu .= '<div>Veuillez saisir le nombre de jours de location</div>';

    } else {
        $contenu .= '<div>La location de votre véhicule sera de ' . prixLoc($_POST['categorie'], $_POST['jours']) . ' euros pour ' . $_POST['jours'] . ' jour(s)</div><br><br>';
    }

    if (empty($contenu)) {

		foreach($_POST as $indice => $valeur)
		{
			$_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
		}
	}
}


function prixLoc ($categorie, $jours) {

     
    if ($_POST['categorie'] == 'A') {
        $prix = 30;
    }

    else if ($_POST['categorie'] == 'B') {
        $prix = 50;
    }

    else if ($_POST['categorie'] == 'C') {
        $prix = 70;
    }

    else if ($_POST['categorie'] == 'D') {
        $prix = 90;
    }

    $prixTotal = $prix * $jours;
    

    return $prix * $jours;

    if ($prixTotal >= 150){
        return $prixTotal - ($prixTotal * 0.1);
    } else {
        return $prixTotal;
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


    <form method="post" action="">

        <label for="categorie">Type de catégorie</label>
                <select name="categorie" id="categorie">
                    <?php 
                    foreach($categorie as $key => $value){
                        echo "<option value=$value>$value</option>";
                    } 
                    ?>			
                </select><br><br>
        
        <label for="jours">Nombre de jours de location</label>    
        <input type="number" id="jours" name="jours" min="1"><br><br>

        <input type="submit" name="validation" value="envoyer"><br><br>

    </form>

    <?php echo $contenu;
   
    ?>
    
        
    </body>
</html>