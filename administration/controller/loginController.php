<?php
switch($_REQUEST['action']){
	case 'auth' :
		include_once ("./model/loginModel.php");
		//Fait appel à la fonction auth pour vérifier que l'utilisateur est autorisé
		$login = auth($_POST['id_admin'], $_POST['mdp_admin']);
		//Si $auth est vrai , on redirige vers la vue commande.php
		if ($login != FALSE) {
			foreach ($login as $key => $value) {
				$_SESSION['login'][$key] = $value;
			}
			$url = HTTP_INDEX . '?page=order&action=show';
			$redirect = '<script>document.location.href="' . $url . '";</script>';
		}
		else {
			$url = HTTP_INDEX . "?page=login&action=show";
			$redirect = '<script>document.location.href="' . $url . '";</script>';
		}
		include_once (CHEMIN_VIEW . '/login.php');
		break;
	case 'show' :
		include_once (CHEMIN_VIEW . '/header.php');
		include_once (CHEMIN_VIEW . '/login.php');
		include_once (CHEMIN_VIEW . '/footer.php');
		break;
	case 'logout':
		session_destroy();
		$url = HTTP_INDEX . "?page=login&action=show";
		$redirect = '<script>document.location.href="' . $url . '";</script>';
		include_once (CHEMIN_VIEW . '/login.php');
	default :
		$url = HTTP_INDEX . "?page=login&action=show";
		$redirect = '<script>document.location.href="' . $url . '";</script>';
		include_once (CHEMIN_VIEW . '/login.php');
		break;
}
?>
