<?php
//Renvoye la liste des groupes ayant commandés en ce JOUR !!!
function get_groups() {

	$bdd = Database3Splus::getinstance();
	//connexion();
	$orders = get_cmd();
	$id_user = array();
	$groups = array();
	$group_final = array();
	foreach ($orders as $order) {
		$req = "select * from users where id_user='" . $order['id_user'] . "'";
		foreach ($bdd->query($req) as $key => $value) {
			$groups[] = $value['id_group'];
		}
	}
	foreach ($groups as $group) {
		$req_groups = "select * from groups where id_group='" . $group . "'";
		foreach ($bdd->query($req_groups) as $key => $value) {
			$group_final['id_group'] = $value['id_group'];
			$group_final['name'] = $value['name'];
		}
	}
	return $group_final;
}

//Liste utilisateurs  ont commandé en ce JOUR ( à un tilisé pour les commandes individuels )
function get_user_cmd() {

	$bdd = Database3Splus::getinstance();
	//connexion();
	$users_cmd = array();
	$group_user = get_group_cmd();
	foreach ($group_user as $user => $value) {
		$users_cmd = get_users($value);
	}
	return $users_cmd;
}

//Detail la commande d'un utilisateur (Nom de produit, Categorie , Sauce , Qauntité)
//Un utilisateur peut commander plusieurs produit différents =)
function get_cmd_detail($id_order) {
	$bdd = Database3Splus::getinstance();
	$req_order = "select * from order_details where id_order='" . $id_order . "'";
	$id_product = array();
	$order_detail = array();
	$i = 0;
	foreach ($bdd->query($req_order) as $key => $value) {
		$id_product[$i] = $value['id_product'];
		$order_detail[$id_order[$i]] = get_product($id_order[$i]);
		$i++;
	}
	return $order_detail;
}

//Retourne toutes les infos sur un utilisateur à partir d'un id_group
function get_users($id_group) {
	$user = array();
	$bdd = Database3Splus::getinstance();
	//connexion();
	$req = 'select * from users where id_group="' . $id_group . '"';
	foreach ($bdd->query($req) as $key => $value) {
		$user[$key] = $value;

	}
	return $user;
}

//Renvoie toutes les commandes en ce JOUR !!!! (INDISPENSABLE A get_group_cmd)
function get_cmd() {
	$order = array();
	$bdd = Database3Splus::getinstance();
	//date_default_timezone_set('Indian/Reunion');
	$date = date('Y-m-d');
	$req = "select * from orders where date='" . $date . "'";
	foreach ($bdd->query($req) as $key => $value) {
		$order[$key] = $value;
	}
	return $order;
}

function get_orders($id_user) {
	$order = array();
	$bdd = Database3Splus::getinstance();
	//date_default_timezone_set('Indian/Reunion');
	$date = date('Y-m-d');
	$req = "select * from orders where date='" . $date . "' and id_user='" . $id_user . "'";
	foreach ($bdd->query($req) as $key => $value) {
		$order[$key] = $value;
	}
	return $order;
}

//Retourne les détails des produits en fonction de l'id_order
function get_products($id_order) {
	$product = array();
	$bdd = Database3Splus::getInstance();
	$req = "select * from order_details where id_order='" . $id_order . "'";
	$i = 0;
	foreach ($bdd->query($req) as $details => $value) {
		//if(is_int($details)){continue;}
		$product[$i]['id'] = $value['id_product'];
		$name_tmp = $bdd -> query("select name from products where id_product='" . $product[$i]['id'] . "'");
		$name = $name_tmp -> fetch();
		$product[$i]['name'] = $name['name'];
		$product[$i]['count'] = $value['amount'];
		$product[$i]['sauce'] = $value['sauce'];
		$i++;
	}
	return $product;

}

//Récupere les noms des catégories en fonction de l'id_product
function get_categorie($id_product) {
	$bdd = Database3Splus::getInstance();
	$req_p = "select id_category from products where id_product='" . $id_product . "'";
	$id_cat_tmp = $bdd -> query($req_p);
	$id_cat_tmp = $id_cat_tmp -> fetch();
	$id_cat = $id_cat_tmp['id_category'];
	$req_cat = "select name from category where id_category";
	$cat_tmp = $bdd -> query($req_cat);
	$cat_tmp = $cat_tmp -> fetch();
	$category = $cat_tmp['name'];
	return $category;
}
?>

