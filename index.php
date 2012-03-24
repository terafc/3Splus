<?php
	/****************************************************
	 * Configuration minimum requise pour l'application *
	 ****************************************************/
	
	//On démarre la session
	session_start();
	
	//On intègre les fichiers de configuration pour la connexion à la BDD
	require_once("./application/global/config.inc.php");
	require_once("./application/global/Database.php");
	require_once(CHEMIN_MODEL."/usersModel.php");
	require_once(CHEMIN_MODEL."/ordersModel.php");
	require_once(CHEMIN_MODEL."/productModel.php");
	
	// On charge la config et les librairies FB
	require_once(CHEMIN_CONFIG.'/config.php');
	require_once(CHEMIN_LIB.'/facebook.php');
	
	/*******************
	 * Partie FACEBOOK *
	 *******************/
	/*
	header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"'); // Hack IE pour passer les params des POST...
	
	// On initialise le SDK Facebook PHP
	$fb = new Facebook(array(
	       'appId'  => FB_APP_ID,
	       'secret' => FB_SECRET_ID,
	       'cookie' => true,
		));
	
	// On récupère la session Facebook de l'utilisateur
	//$session = $fb->getSession();
	$user = null; //Initialisation de l'utilisateur
	
	//On vérifie que l'utilisateur a accepter les autorisations FB
	try {
		// On récupère l'UID de l'utilisateur Facebook courant
		$uid = $fb->getUser();
		// On récupère les infos de base de l'utilisateur
		$user = $fb->api('/me');
	}
	// S'il y'a un problème lors de la récup, perte de session entre temps, suppression des autorisations...
	catch (FacebookApiException $e) {
		// On récupère l'URL sur laquelle on devra rediriger l'utilisateur pour le réidentifier sur l'application
		$params = array(
			'redirect_uri' => 'http://tp3-3splus.franceserv.fr/index.php'
		);
		$loginUrl = $fb->getLoginUrl($params);
		// On le redirige en JS (header PHP pas possible)
		echo "<script type='text/javascript'>top.location.href = '".$loginUrl."';</script>";
 		exit();
	}
	
	//Si l'utilisateur a validé son email de confirmation, alors VRAI, sinon FAUX 
	$auth = user_auth($uid);
	//Si utilisateur valide, on récupère les infos de l'utilisateur et on le stocke dans une session
	if($auth){
		$userCurrentInfo = user_get_info($uid);
		$_SESSION['user'] = $userCurrentInfo[0];//On met l'index 0 à cause du fetchAll()
	 	$_SESSION['user_facebook'] = $user;
	 	$_SESSION['uid'] = $uid;
		//On récupère l'id _order non payé d'un utilisateur, sinon on en génère un nouveau
		$id_order = verif_user_order($_SESSION['user']);
		if($id_order){
			$_SESSION['id_order'] = $id_order;//Index 0 à cause du fetchAll()
		}
		else{
			$_SESSION['id_order'] = create_id_order($_SESSION['id_order']);
		}
	}
	*/
	/**************
	 * Partie WEB *
	 **************/
	//POUR LES TEST
	$_SESSION['uid']=1;
	$tmp=user_get_info(1);
	$_SESSION['user']=$tmp[0];
	$_SESSION['orders'] = get_all_info_order($_SESSION['user']['id_user']);
	$_SESSION['currentOrder'] = "";
	//On récupère l'id _order non payé d'un utilisateur, sinon on en génère un nouveau
	$test = verif_user_order($_SESSION['user']['id_user']);
	if($test){
		$_SESSION['id_order'] = $test['id_order'];
		$totalPrice = 0;//Prix par défaut du panier
		$order = get_info_order($_SESSION['id_order']);//Liste des produits et quantité des produits du panier
		if(!empty($order)){
			foreach ($order as $key => $value) {
				$info_product = get_info_product($value['id_product']);//Permet de récupéré le nom, et le prix du produit
				//On ajoute à l'array les infos du produit
				$order[$key]['name'] = $info_product['name'];
				$order[$key]['price'] = $info_product['price'];
				$totalPrice += $info_product['price'] * $order[$key]['amount'];//On ajoute le prix du produit au montant total
			}
		}
		$_SESSION['currentOrder'] = $order;
	}
	else{
		$_SESSION['id_order'] = create_id_order($_SESSION['user']['id_user']);
		$totalPrice = 0;
	}
	
	//if($auth){//Si l'utilisateur est authentifié
		include_once(CHEMIN_VIEW.'/header.php');//Header
		//On inclut le contrôleur si $_GET['page'], et $_GET['action'] est définit, et si le controller existe
		if (!empty($_REQUEST['page'])  && 
			!empty($_REQUEST['action']) && 
			is_file(CHEMIN_CONTROLLER.'/'.$_REQUEST['page'].'Controller.php')
		){
			$action = $_REQUEST['action'];
			$page = $_REQUEST['page'];
			include_once(CHEMIN_CONTROLLER.'/'.$_REQUEST['page'].'Controller.php');
		}
		elseif(!isset($_REQUEST['action']) && !isset($_REQUEST['page'])){//Si on affiche la page pour la première fois sans variables
			include_once(CHEMIN_VIEW.'/accueil.php');
		}
		else{
			include_once(CHEMIN_VIEW.'/404.php');//Erreur 404
		}
		include_once(CHEMIN_VIEW.'/footer.php');//Footer
	/*}
	else{//Si l'utilisateur n'est pas authentifié
		if(isset($_REQUEST['action'])){
			$action = $_REQUEST['action'];
		}
		else{
			$action = 'show';//Par défaut
		}
		include_once(CHEMIN_CONTROLLER.'/loginController.php');
	}*/
?>