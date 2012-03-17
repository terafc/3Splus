<?php
	switch($action){
		//Affichage simple de la vue
		case "show":
			include_once(CHEMIN_VIEW."/accueil.php");
			break;
		//Erreur 404
		default:
			include_once(CHEMIN_VIEW."/404.php");
			break;
	}
?>