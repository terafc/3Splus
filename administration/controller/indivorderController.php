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
			if(isset($_REQUEST['id_order'])){
				$id_order = $_REQUEST['id_order'];
				$products = get_cmd($id_order);
				$validate_url = HTTP_INDEX.'?page=indivorder&action=validate';
				include_once(CHEMIN_VIEW . '/header.php');
				include_once(CHEMIN_VIEW . '/details.php');
				include_once(CHEMIN_VIEW . '/footer.php');
			}
			else{
				header('Location: ' . HTTP_INDEX . '?page=indivorder&action=show');
			}
			break;
		case 'validate':
			if(isset($_REQUEST['id_order'])){
				validate($_REQUEST['id_order']);
			}
			header('Location: ' . HTTP_INDEX . '?page=indivorder&action=show');
			break;
		default:
			include_once (CHEMIN_VIEW . '/header.php');
			include_once (CHEMIN_VIEW . '/404.php');
			include_once (CHEMIN_VIEW . '/footer.php');
			break;
	}
?>
