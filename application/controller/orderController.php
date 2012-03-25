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
			/***************************************************************************************************
			 * On crée un array par étape, pour simplifier le code, et simplifier son utilisation dans la vue. *
			 ***************************************************************************************************/
			//On récupère les id_order de toutes les commandes validé
			$tmp = get_id_order_paid($_SESSION['user']['id_user']);
			$orders = array();//Array multidimensionnel, qui sera retourné à la vue.
			if($tmp['count'] != 0){
				//On récupère chaque id_order pour les mettre en index de $orders
				foreach($tmp['info'] as $value){
					$orders[$value['id_order']]=array();
				}
				//On ajoute à présent à chaque index, une liste de produits
				foreach ($orders as $cle => $valeur) {
					$orders[$cle] = get_info_order($cle);
					//Pour chaque produit, on ajoute son nom et son prix, puis on calcul le montant total
					$i=0;
					foreach ($orders[$cle] as $key => $value) {
						//On supprime les index inutiles de fetchAll()
						foreach($orders[$cle][$key] as $key2 => $value2){
							if(is_int($key2)){
								unset($orders[$cle][$key][$key2]);
							}
						}
						//On définit un montant par défaut
						if(!isset($orders[$cle]['total'])){
							$orders[$cle]['total']=0;
						}
						$info_product = get_info_product($value['id_product']);//On récupère le prix et le nom du produit
						$orders[$cle][$key]['name']=$info_product['name'];
						$orders[$cle][$key]['price']=$info_product['price'];
						$orders[$cle]['total']+=$info_product['price'] * $orders[$cle][$key]['amount'];
						$i++;
					}
				}
			}
			include_once(CHEMIN_VIEW."/order.php");
			break;
		case "editAmount":
			require_once(CHEMIN_MODEL."/ordersModel.php");
			if(!empty($_SESSION['currentOrder'])){
				$i=0;
				foreach ($_SESSION['currentOrder'] as $key => $value) {
					if(intval($_REQUEST['amount'.$i])==0){//Cas où l'utilisateur entre une valeur 0
						$status = del_product_of_order($_SESSION['id_order'], $value['id_product'],$value['sauce']);//Permet de supprimer un produit
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
			del_product_of_order($_SESSION['id_order'], $_REQUEST['id_product'],$_REQUEST['sauce']);//Permet de supprimer un produit
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