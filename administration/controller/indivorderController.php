<?php

	require_once (CHEMIN_MODEL . '/mainModel.php');
	switch($_REQUEST['action']){
		case 'show':
			$users = get_users();
			$validate_url = HTTP_INDEX.'?page=indivorder&action=detail';

			include_once(CHEMIN_VIEW . '/header.php');
			include_once(CHEMIN_VIEW . '/individuel.php');
			include_once(CHEMIN_VIEW . '/footer.php');
			break;
		case 'detail':
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
