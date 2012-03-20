<?php
	//Permet d'ajouter un produit au panier
	function add_product_to_order($id_order,$id_product,$sauce){
        $bdd = Database3Splus::getinstance();//connexion();
        $amount = 1;
        $req = "INSERT INTO order_details VALUES (:id_order, :id_product, :amount, :sauce)";
        $result = $bdd->prepare($req);
        $result->bindParam(':id_order', $id_order);
        $result->bindParam(':id_product', $id_product);
        $result->bindParam(':amount', $amount);
        $result->bindParam(':sauce', $sauce);
        $result->execute();
        $count = $result->rowCount();
		if($count != 0){return TRUE;}
		else{return FALSE;}
	}
	
	//Permet de créer un id_order pour un utilisateur (Valable qu'une journée)
	function create_id_order($id_user){
        $bdd = Database3Splus::getinstance();//connexion();
        $paid = 0;
	$date = date("Y-m-d H:i:s");
        $req = "INSERT INTO orders (id_user,paid,date) VALUES (:id_user, :paid, :date)";
        $result = $bdd->prepare($req);
        $result->bindParam(':id_user', $id_user);
        $result->bindParam(':paid', $paid);
        $result->bindParam(':date', $date);
        $result->execute();
        $lastId = $bdd->lastInsertId();//Retourne le dernier ID inséré
        return $lastId;
	}
	
	//Permet de vérifier si un utilisateur a déjà une commande
	function verif_user_order($id_user){
		$bdd = Database3Splus::getinstance();//connexion();
		$req = "select id_order from orders where id_user=:id_user and id_paid=0";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_user', $id_user);
		$result->execute();
		$result2=$result->fetchAll();
		if (!empty($result2)){
			return $result2;	
		}else{
			return FALSE;
		}
	}
	
	//Permet de modifier la quantité d'un produit
	function edit_account_product($id_order,$id_product,$amount){
		$bdd = Database3Splus::getinstance();//connexion();
		$req = "update order_details set (amount) VALUES (:amount) ";
		$req .= "where	id_order=:id_order AND id_product=:id_product";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_order', $id_order);
		$result->bindParam(':id_product', $id_product);
		$result->bindParam(':amount', $amount);
		$result->execute();
	}
	
	//Permet de valider une commande (après paiement paypal)
	function confirm_order($id_order){
		$bdd = Database3Splus::getinstance();//connexion();
		$id_paid = 1;
		$req = "update order set (id_paid) VALUES (:id_paid)";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_paid', $id_paid);
		$result->execute();
	}

	//Permet de récupéré la liste id_product,amount d'une commande
	function get_info_order($id_order){
		$bdd = Database3Splus::getinstance();//connexion();
		$req = "select id_product.OD,amount.OD,sauce.OD from order_details OD,orders O  where id_order.O=id_order.OD and id_order.OD=:id_order and paid.O=0";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_order', $id_order);
		$result->execute();
		$result2=$result->fetchAll();
		if (!empty($result2)){
			return $result2;	
		}else{
			return FALSE;
		}
	}

	
?>
