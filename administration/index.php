<?php
	/****************************************************
	 * Configuration minimum requise pour l'administration *
	 ****************************************************/
	
	//On intègre les fichiers de configuration pour la connexion à la BDD
	require_once("./global/config.inc.php");
	require_once("./global/Database.php");
	
	//On démarre la session
	session_start();
	
	
	/**************
	 * Partie WEB *
	 **************/
	
		include_once(CHEMIN_VIEW.'/header.php');//Header
		//On inclut le contrôleur si $_GET['page'], et $_GET['action'] est définit, et si le controller existe
		if (!empty($_REQUEST['page'])  && 
			!empty($_REQUEST['action']) && 
			is_file(CHEMIN_CONTROLLER.'/'.$_REQUEST['page'].'Controller.php')
		){
			$action = $_REQUEST['action'];
			include_once(CHEMIN_CONTROLLER.'/'.$_REQUEST['page'].'Controller.php');
		}
		elseif(!isset($_REQUEST['action']) && !isset($_REQUEST['page'])){//Si on affiche la page pour la première fois sans variables
			include_once(CHEMIN_VIEW.'/accueil.php');
		}
		else{
			include_once(CHEMIN_VIEW.'/404.php');//Erreur 404
		}
		include_once(CHEMIN_VIEW.'/footer.php');//Footer
?>