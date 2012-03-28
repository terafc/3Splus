<?php
	//******************************
	//    Controler de page
	//******************************
	//Il verifie la page demandee et 
	//appel le controller de la page 
	//si elle est viable sinon il 
	//affiche une page d'erreur
	//******************************
	//Prereq: $_REQUEST['page']
	//******************************

	switch($_REQUEST['page']){
		case 'login':
			include_once (CHEMIN_CONTROLLER . '/loginController.php');
			break;
		case 'home':
			header('Location: ' . HTTP_INDEX . '?page=product&action=show');
			break;
		case 'product':
			include_once(CHEMIN_CONTROLLER . '/productController.php');
			break;
		
		default:
			include_once (CHEMIN_VIEW . '/header.php');
			include_once (CHEMIN_VIEW . '/404.php');
			include_once (CHEMIN_VIEW . '/footer.php');
			break;
	}
?>
