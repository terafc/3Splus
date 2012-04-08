<?php
// include_once ('../global/config.inc.php');
// include_once ('../global/Database.php');

// Renvoie un tableau contenant le nom des groupes qui ont commandés et les produits associé
function get_groups() {
	$bdd = Database3Splus::getInstance();
	$req_group = "SELECT DISTINCT groups.id_group,groups.name,orders.id_order,users.id_user,users.lastname as nom, users.firstname as prenoms,users.email,orders.paid as etat 
	FROM users,orders,groups 
	WHERE orders.paid='1' and users.id_group=groups.id_group";
	$groups = array();
	$users = array();
	$i = 0;
	foreach ($bdd->query($req_group) as $group => $value) {
		$groups[$value['name']]['id_group'] = $value['id_group'];
		$groups[$value['name']]['users'][$value['id_user']]['nom'] = $value['nom'];
		$groups[$value['name']]['users'][$value['id_user']]['prenoms'] = $value['prenoms'];
		$groups[$value['name']]['product'] = get_cmd_groups($groups[$value['name']]['id_group']);
	}
	return $groups;
}

//Sous fonction utile à get_groups sinon inutile
function get_cmd_groups($id_group) {
	$req_user = "select id_order from orders where id_user in(select id_user from users,groups where users.id_group=groups.id_group and groups.id_group=" . $id_group . ") and paid=1";
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

//Renvoie un tableau contenant les utlisateurs(toutes les informations) qui ont commandés et les produits associés avec la quantité et la sauce 
function get_users_cmd() {
	$result = array();
	$users=array();
	$cmd=array();
	$bdd = Database3Splus::getInstance();
	$req = "select id_order,id_user from orders where paid=1";
	$i = 0;
	foreach ($bdd->query($req) as $infos => $value) {
		//$result[$value['id_user']][]=$value['id_order'];
		$req_user='select * from users where id_user='.$value['id_user'];
		foreach ($bdd->query($req_user) as $user => $detail) {
			$result[$value['id_user']]['nom']=$detail['firstname'];
			$result[$value['id_user']]['prenoms']=$detail['lastname'];
			$result[$value['id_user']]['email']=$detail['email'];
			$result[$value['id_user']]['id_group']=$detail['id_group'];
			$result[$value['id_user']]['id_facebook']=$detail['id_facebook'];
			$result[$value['id_user']]['point']=$detail['point'];
		}
		$req_cmd="SELECT DISTINCT products.name, category.name as categorie, order_details.amount as qtt,order_details.sauce
				FROM order_details,products,category
				WHERE products.id_product=order_details.id_product and products.id_category=category.id_category and order_details.id_order=".$value['id_order'];
				$i=0;
		foreach ($bdd->query($req_cmd) as $product => $info) {
			$result[$value['id_user']][$value['id_order']][$i]['nom']=$info['name'];
			$result[$value['id_user']][$value['id_order']][$i]['categorie']=$info['categorie'];
			$result[$value['id_user']][$value['id_order']][$i]['qtt']=$info['qtt'];
			$result[$value['id_user']][$value['id_order']][$i]['sauce']=$info['sauce'];
			$i++;
		}
	}
	return $result;
}
// echo "<pre>";
// print_r(get_groups());
// echo "</pre>";
/*echo "<pre>";
print_r(get_groups());
echo "</pre>"*/
?>