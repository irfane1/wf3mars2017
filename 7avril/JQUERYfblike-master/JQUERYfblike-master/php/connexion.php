<?php

	// Dans la vraie vie les identifiants sont vérifier dans la BDD
	if(($_POST['userName']=='admin') && ($_POST['userPass']=='root')){
		// Connexion réussie
		echo true;

	} else {
		// Connexion echouée
		echo false;
	}

?>