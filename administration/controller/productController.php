<?php
	switch($_REQUEST['action']){
		case 'show':
			include_once(CHEMIN_VIEW . '/header.php');
			include_once(CHEMIN_VIEW . '/commandes.php');
			include_once(CHEMIN_VIEW . '/footer.php');
			break;
		case 'show_indiv':
			include_once(CHEMIN_VIEW . '/header.php');
			include_once(CHEMIN_VIEW . '/individuel.php');
			include_once(CHEMIN_VIEW . '/footer.php');
			break;
		default:
			break;
	}
?>
