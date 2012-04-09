<?php
//include_once ('../global/config.inc.php');
//include_once ('../global/Database.php');

// Renvoie un tableau contenant le nom des groupes qui ont commandés,les produits associé et le porteur
function get_groups() {
	$bdd = Database3Splus::getInstance();
	$req_group = "SELECT DISTINCT groups.id_group,groups.name,orders.id_order,users.id_user,users.lastname as nom, users.firstname as prenoms,users.email,orders.paid as etat 
	FROM users,orders,groups 
	WHERE orders.paid='1' and orders.validated=0 and users.id_group=groups.id_group";
	$groups = array();
	$users = array();
	$i = 0;
	foreach ($bdd->query($req_group) as $group => $value) {
		$groups[$value['name']]['id_group'] = $value['id_group'];
		$groups[$value['name']]['users'][$value['id_user']]['nom'] = $value['nom'];
		$groups[$value['name']]['users'][$value['id_user']]['prenoms'] = $value['prenoms'];
		$groups[$value['name']]['product'] = get_cmd_groups($groups[$value['name']]['id_group']);
	}
	//Pour determiner le porteur (en se basant sur les id_order contenue dans le précédent tableau groups
	foreach ($groups as $key => $value) {
		$req_carrier = "SELECT id_user FROM carrier WHERE id_order in
						(SELECT id_order FROM orders WHERE validated=0 and id_user in
						(SELECT id_user FROM users,groups WHERE users.id_group=groups.id_group and groups.id_group=" . $value['id_group'] . ") and paid=1)";
		var_dump($key);
		foreach ($bdd->query($req_carrier) as $carrier => $id) {
			$groups[$key]['carrier']['id_user'] = $id['id_user'];
			$groups[$key]['carrier']['nom'] = $groups[$key]['users'][$id['id_user']]['nom'];
			$groups[$key]['carrier']['prenoms'] = $groups[$key]['users'][$id['id_user']]['prenoms'];
		}
	}
	return $groups;
}

//Sous fonction utile à get_groups sinon inutile
function get_cmd_groups($id_group) {
	$req_user = "SELECT id_order FROM orders WHERE validated=0 and id_user in(SELECT id_user FROM users,groups WHERE users.id_group=groups.id_group and groups.id_group=" . $id_group . ") and paid=1";
	$req_cmd = "SELECT DISTINCT products.name, category.name as categorie, order_details.amount as qtt,order_details.sauce
	FROM order_details,products,category
	WHERE products.id_product=order_details.id_product and products.id_category=category.id_category and order_details.id_order=";
	$bdd = Database3Splus::getInstance();
	$result = array();
	$i = 0;
	foreach ($bdd->query($req_user) as $key => $order) {
		$req_cmd2 = $req_cmd . $order['id_order'];
		foreach ($bdd->query($req_cmd2) as $info => $product) {
			$result[$i]['name'] = $product['name'];
			$result[$i]['category'] = $product['categorie'];
			$result[$i]['amount'] = $product['qtt'];
			$result[$i]['sauce'] = $product['sauce'];
			$i++;
		}
	}
	return $result;
}

//Renvoie un tableau contenant les utlisateurs(toutes les informations) qui ont commandés et les id_order
function get_users() {
	$result = array();
	$users = array();
	$cmd = array();
	$bdd = Database3Splus::getInstance();
	$req = "SELECT id_order,id_user FROM orders WHERE paid=1 and validated=0";
	$i = 0;
	foreach ($bdd->query($req) as $infos => $value) {
		$result[$value['id_user']]['id_order'][] = $value['id_order'];
		$req_user = 'SELECT * FROM users WHERE id_user=' . $value['id_user'];
		foreach ($bdd->query($req_user) as $user => $detail) {
			$result[$value['id_user']]['nom'] = $detail['firstname'];
			$result[$value['id_user']]['prenoms'] = $detail['lastname'];
			$result[$value['id_user']]['email'] = $detail['email'];
			$result[$value['id_user']]['id_group'] = $detail['id_group'];
			$result[$value['id_user']]['id_facebook'] = $detail['id_facebook'];
			$result[$value['id_user']]['point'] = $detail['point'];
		}
	}
	return $result;
}

//Renvoie les details des commandes selon l'id_order => le nom:name, le nom de la categorie:category, la quantité:qtt et la sauce si existant
function get_cmd($id_order) {
	$result = array();
	$bdd = Database3Splus::getInstance();
	$req = "SELECT DISTINCT products.name, category.name, order_details.amount as qtt,order_details.sauce
				FROM order_details,products,category
				WHERE products.id_product=order_details.id_product and products.id_category=category.id_category and order_details.id_order=" . $id_order;
	$i = 0;
	foreach ($bdd->query($req) as $cmd => $info) {
		$result[$i]['name'] = $info['name'];
		$result[$i]['category'] = $info['name'];
		$result[$i]['qtt'] = $info['qtt'];
		$result[$i]['sauce'] = $info['sauce'];
		$i++;
	}
	return $result;
}
//Fonction permettant de validé un commande selon l'id_order
function validate($id_order) {
	$bdd = Database3Splus::getInstance();
	$req = "UPDATE orders SET validated=1 WHERE paid=1 and id_order=" . $id_order;
	try{
		$validate=$bdd->prepare($req);
		$result=$validate->execute();
	}
	catch(PDOException $e){
		die('Erreur : '.$e->getMessage());
	}
}

// echo "<pre>";
// print_r(get_groups());
// echo "</pre>";
/*echo "<pre>";
print_r(get_users());
echo "</pre>";*/
?>
