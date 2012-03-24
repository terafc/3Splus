<?php
	switch($action){
		//Affichage du panier
		case "panier":
			$order = $_SESSION['currentOrder'];//On récupère le panier
			//Le montant total du panier ayant déjà été calculé dans l'index, on ne le recalcule pas ici.
			include_once(CHEMIN_VIEW."/panier.php");
			break;
		case "order":
			require_once(CHEMIN_MODEL."/ordersModel.php");		
			include_once(CHEMIN_VIEW."/order.php");
			break;
		case "editAmount":
			require_once(CHEMIN_MODEL."/ordersModel.php");
			if(!empty($_SESSION['currentOrder'])){
				$i=0;
				foreach ($_SESSION['currentOrder'] as $key => $value) {
					if(intval($_REQUEST['amount'.$i])==0){//Cas où l'utilisateur entre une valeur 0
						$status = del_product_of_order($_SESSION['id_order'], $value['id_product']);//Permet de supprimer un produit
					}
					else{
						$status = edit_account_product($_SESSION['id_order'],$value['id_product'],$_REQUEST['amount'.$i],$_REQUEST['sauce'.$i]);//Permet d'éditer la quantité d'un produit
					}
					$i++;
				}
			}
			header('Location: '.HTTP_INDEX.'?page='.$page.'&action=panier');
			break;
		case "delete":
			require_once(CHEMIN_MODEL."/ordersModel.php");
			del_product_of_order($_SESSION['id_order'], $_REQUEST['id_product']);//Permet de supprimer un produit
			header('Location: '.HTTP_INDEX.'?page=order&action=panier'); 
			break;
		case "confirm":
			require_once(CHEMIN_MODEL."/ordersModel.php");
			//CODE A FR VERIF PAYPAL
			//Faire cas panier vide
			confirm_order($_SESSION['id_order']);
			header('Location: '.HTTP_INDEX.'?page=order&action=order'); 
			break;
		default:
			include_once(CHEMIN_VIEW."/404.php");
			break;
	}
?>