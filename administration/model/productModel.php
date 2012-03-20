<?php
	//Permet d'obtenir la liste des produits en fonction de la catégorie
	function get_product_by_cat($id_category){
		$bdd = Database3Splus::getinstance();//connexion();
		$req = "SELECT * FROM products WHERE id_category = :id_category";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_category', $id_category);
		$result->execute();
		$product = $result->fetchAll();
		if(!empty($product)){//Si il n'y a aucun produit dans la catégorie
			return $product;
		}
		else{
			return FALSE;
		}
	}
	
	//Permet de vérifier que l'id du produit existe lors de l'ajout au panier
	function verif_product($id_product){
		$bdd = Database3Splus::getinstance();//connexion();
		$req = "SELECT id_product FROM products WHERE id_product = :id_product";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_product', $id_product);
		$result->execute();
		$colcount = $result->fetchColumn();//Récupère la première colonne depuis la ligne suivante d'un jeu de résultats
		if($colcount != 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	//Permet d'obtenir la liste des infos d'un produit
	function get_all_info_product($id_product){
		
	}
?>
