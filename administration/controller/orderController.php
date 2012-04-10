<?php

	require_once (CHEMIN_MODEL . '/mainModel.php');
	switch($_REQUEST['action']){
		case 'show':
			$groups = get_groups();
			$validate_url = HTTP_INDEX.'?page=order&action=validate';

			include_once(CHEMIN_VIEW . '/header.php');
			include_once(CHEMIN_VIEW . '/commandes.php');
			include_once(CHEMIN_VIEW . '/footer.php');
			break;
		case 'validate':
			header('Location: ' . HTTP_INDEX . '?page=order&action=show');
			break;
		default:
			include_once (CHEMIN_VIEW . '/header.php');
			include_once (CHEMIN_VIEW . '/404.php');
			include_once (CHEMIN_VIEW . '/footer.php');
			break;
	}
?>
