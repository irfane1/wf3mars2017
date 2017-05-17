<?php
/* 
	1- Vous réalisez un formulaire "Votre devis de travaux" qui permet de saisir le montant des travaux de votre maison en HT et de choisir la date de construction de votre maison (bouton radio) : "plus de 5 ans" ou "5 ans ou moins". Ce formulaire permettra de calculer le montant TTC de vos travaux selon la période de construction de votre maison.

	2- Vous réalisez la validation du formulaire : le montant doit être en nombre positif non nul, et la période de construction conforme aux valeurs que vous aurez choisies.

	3- Vous créez une fonction montantTTC qui calcule le montant TTC à partir du montant HT donné par l'internaute et selon la période de construction : le taux de TVA est de 10% pour plus de 5 ans, et de 20% pour 5 ans ou moins. La fonction retourne le résultat du calcul.
	
	Formule de calcul d'un montant TTC :  montant TTC = montant HT * (1 + taux / 100) où taux est par exemple égale à 20.

	4- Vous affichez le résultat calculé par la fonction au-dessus du formulaire : "Le montant de vos travaux est de X euros avec une TVA à Y% incluse."

	5- Vous diffusez des codes de remises promotionnelles, dont un est 'abc' offrant 10% de remise. Ajoutez un champ au formulaire pour saisir le code de remise. Vous validez ce champ qui ne doit pas excéder 5 caractères. Puis la fonction montantTTC applique la remise (-10%) au montant total des travaux si le code de l'internaute est correcte. Vous affichez dans ce cas "Le montant de vos travaux est de X euros avec une TVA à Y% incluse, et y compris une remise de 10%.". 

*/

$contenu = '';
$afficheResultat = '';
$resultat = '';

function montantTTC($montant, $construction) {

	

	if ($_POST['construction'] == '-'){
		$tva = 20;
	}

	if ($_POST['construction'] == '+'){
		$tva = 10;
		
	}

	$resultat = $montant * (1 + $tva / 100);
	

	return 'Le montant de vos travaux est de ' . $resultat . ' euros avec une TVA à ' . $tva . ' % incluse.';


}



if ($_POST) {

	$montant = (int)$_POST['montant'];
	$construction = $_POST['construction'];

	if (!is_numeric($_POST['montant']) || $_POST['montant'] <= 0) $contenu .= '<div>Erreur sur le montant</div>';  

	if ($_POST['construction'] != '-' && $_POST['construction'] != '+') {
        $contenu .= '<div>La date de construction est incorrecte</div>';        
    }

	if (empty($contenu)) {
			$afficheResultat = montantTTC($_POST['montant'], $_POST['construction']);	
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

		<?php echo $contenu . '<br>' ?>
		<?php echo $afficheResultat . '<br>' ?>
	
		<h1>Votre devis de travaux</h1>


		<form method="post" action="">
			<label for="montant">Montant travaux</label><br>
			<input type="text" id="montant" name="montant"><br><br>

			<label>Date de construction</label><br>
			<input type="radio" id="moins" name="construction" value="-" checked><label for="moins">5 ans ou moins</label>
			<input type="radio" id="plus" name="construction" value="+"><label for="plus">Plus de 5 ans</label><br><br>

			<input type="submit" name="validation" value="envoyer">

		</form>
		
	</body>
</html>


