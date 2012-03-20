<?php
//Contient toutes les fonctions concernant la table product

//Permet d'obtenir la liste des produits en fonction de la catégorie
function get_product_by_cat($id_category) {
	$bdd = Database3Splus::getinstance();
	//connexion();
	$req = "SELECT * FROM products WHERE id_category = :id_category";
	$result = $bdd -> prepare($req);
	$result -> bindParam(':id_category', $id_category);
	$result -> execute();
	$product = $result -> fetchAll();
	if (!empty($product)) {//Si il n'y a aucun produit dans la catégorie
		return $product;
	}
	else {
		return FALSE;
	}
}
// Permet d'ajouter un produit en prenant comme arguments :
// 	-le nom du produit, la description,le prix
function add_product($name,$description,$price){
	
}
?>
