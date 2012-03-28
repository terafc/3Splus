<?php

	require_once (CHEMIN_MODEL . '/mainModel.php');
	switch($_REQUEST['action']){
		case 'show':
			include_once(CHEMIN_VIEW . '/header.php');
			include_once(CHEMIN_VIEW . '/editer.php');
			include_once(CHEMIN_VIEW . '/footer.php');
			break;
		default:
			include_once (CHEMIN_VIEW . '/header.php');
			include_once (CHEMIN_VIEW . '/404.php');
			include_once (CHEMIN_VIEW . '/footer.php');
			break;
	}
?>
