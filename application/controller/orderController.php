<?php
	switch($action){
		//Affichage du panier
		case "panier":
			require_once(CHEMIN_MODEL."/ordersModel.php");
			require_once(CHEMIN_MODEL."/productModel.php");
			$order = $_SESSION['currentOrder'];//On récupère le panier
			//Calcul du montant total
			$totalPrice = 0;
			if(empty($order)){$message = "Votre panier est vide !";}//Cas panier vide
			else{
				foreach ($order as $key => $value) {
					$totalPrice += $order[$key]['amount']*$order[$key]['price'];
				}
			}
			include_once(CHEMIN_VIEW."/panier.php");
			break;
		case "order":
			require_once(CHEMIN_MODEL."/ordersModel.php");		
			include_once(CHEMIN_VIEW."/order.php");
			break;
		case "editAmount":
			require_once(CHEMIN_MODEL."/ordersModel.php");
			if(!empty($_SESSION['currentOrder'])){
				foreach ($_SESSION['currentOrder'] as $key => $value) {
					if(!is_array($value)){continue;}//On continue si il ne s'agit pas d'un produit
					$status = edit_account_product($_SESSION['id_order'],$value['id_product'],$value['amount']);//Permet d'éditer la quantité d'un produit
					if($status){//Si l'édition s'est bien passé on confirme l'édition dans l'array
						$_SESSION['currentOrder'][$key]['amount'] = $value['amount'.$value['id_product']];
					}
				}
			}
			include_once(CHEMIN_VIEW."/panier.php");
			header('Location: '.HTTP_INDEX.'?page='.$page.'&action=panier');
			break;
		case "confirm":
			require_once(CHEMIN_MODEL."/ordersModel.php");
			//CODE A FR VERIF PAYPAL
			confirm_order($_SESSION['id_order']);
			break;
	}
?>