<?php

	require_once (CHEMIN_MODEL . '/mainModel.php');
	switch($_REQUEST['action']){
		case 'show':

	
			$CMD[0]=array("Bouchon Gratine","K", "Fanta 50cl","DIJOUX", "Marc","3100263");
			$CMD[1]=array("Americain Poulet","M", "Coca 50cl","NANDJAN", "Clement","3000302");
			$CMD[2]=array("Americain Jambon","P", "Edena 1l","RETHORE","Sof", "3100325");
			$CMD[3]=array("Americain nature","KP", "Sprite 50cl", "MARCOZ", "Francel", "3000254");
			$validate_url = HTTP_INDEX.'?page=indivorder&action=validate';

			include_once(CHEMIN_VIEW . '/header.php');
			include_once(CHEMIN_VIEW . '/individuel.php');
			include_once(CHEMIN_VIEW . '/footer.php');
			break;
		case 'validate':
			break;
		default:
			include_once (CHEMIN_VIEW . '/header.php');
			include_once (CHEMIN_VIEW . '/404.php');
			include_once (CHEMIN_VIEW . '/footer.php');
			break;
	}
?>
