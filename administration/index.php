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

//Si le client n'est pas authentifie
if (!isset($_SESSION['login'])){
	//Si il n'a pas deja ete redirige vers le login
	if(!isset($_REQUEST['page']) || $_REQUEST['page']!='login'){
		//On le redirige vers le login
		header('Location: ' . HTTP_INDEX . '?page=login&action=show');
	}
} 

//Le client est authentifie ou il demande à se loguer
//Par defaut on le redirige vers l'accueil
if(!isset($_REQUEST['page']))
	header('Location: ' . HTTP_INDEX . '?page=home');

//Le client demande une page particuliere
//On passe la main au controller de page
include_once (CHEMIN_CONTROLLER . '/pageController.php');

//Le client est authentifie ou il demande à se loguer
?>
