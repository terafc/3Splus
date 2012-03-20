<?php
/****************************************************
 * Configuration minimum requise pour l'administration *
 ****************************************************/

//On intègre les fichiers de configuration pour la connexion à la BDD
require_once ("./global/config.inc.php");
require_once ("./global/Database.php");

//On démarre la session
session_start();

/**************
 * Partie ADMINISTRATION *
 **************/

if (isset($_SESSION['login'])) {
	include_once (CHEMIN_VIEW . '/header.php');
}
//Header
//On inclut le contrôleur si $_GET['page'], et $_GET['action'] est définit, et si le controller existe

if (!isset($_SESSION['login']) && empty($_REQUEST['page'])) {
	header("Location: " . HTTP_INDEX . "?page=login&action=show");
}
else {
	if (!empty($_REQUEST['page']) && !empty($_REQUEST['action'])) {
		$action = $_REQUEST['action'];
		include_once (CHEMIN_CONTROLLER . '/' . $_REQUEST['page'] . 'Controller.php');
	}
	//Sinon si l'utilisateur est logé on indique une erreur 404
	elseif (isset($_SESSION['login'])) {
		header('Location:'.HTTP_INDEX.'?page=commande&action=show');
	}
	//Sinon on le redirige vers la page de login
	else {
		$action = "show";
		include_once (CHEMIN_CONTROLLER . '/loginController.php');
	}
}
if (isset($_SESSION['login'])) {
	include_once (CHEMIN_VIEW . '/footer.php');
}
?>