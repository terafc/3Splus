<?php

	require_once (CHEMIN_MODEL . '/mainModel.php');
	switch($_REQUEST['action']){
		case 'show':

			$CMD = array();

			$CMD[0]=array("Bouchon Gratine","K", "Fanta 50cl","DIJOUX", "Marc","3100263","123456");
			$CMD[1]=array("Americain Poulet","M", "Coca 50cl","NANDJAN", "Clement","3000302","123457");
			$CMD[2]=array("Americain Jambon","P", "Edena 1l","RETHORE","Sof", "3100325","123458");
			$CMD[3]=array("Americain nature","KP", "Sprite 50cl", "MARCOZ", "Francel", "3000254","123459");
			$CMD[4]=array("Crudite Jambon","KM", "Sambo 33cl", "RIVIERE", "Serge", "3000255","123460");
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
