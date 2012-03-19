<?php
	switch($action){
		//Affichage du panier
		case "show":
			require_once(CHEMIN_MODEL."/ordersModel.php");
			require_once(CHEMIN_MODEL."/productModel.php");
			$tmp = verif_user_order($_SESSION['user']['id_user']);//On Récupère l'id_user
			$id_order = $tmp[0]; //Index 0 a cause du fetchAll()
			if($id_order){
				$tmp = get_info_order($_SESSION['id_order']);
				$order = $tmp['0'];//Index 0 à cause du fetchAll()
				$product = array();//Contiendra les valeurs du panier
				$i=0;
				foreach ($order as $value) {
					$product[] = get_all_info_product($value['id_product']);
				}
				
			}
			else{$error = "Vous n'avez aucun produit dans votre panier.";}
			break;
		case "editAccount":
			break;
		case "confirm":
			break;
	}
?>