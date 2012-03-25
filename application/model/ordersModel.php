<?php
	//Permet d'ajouter un produit au panier
	function add_product_to_order($id_order,$id_product,$sauce){
        $bdd = Database3Splus::getinstance();//connexion();
        //On vérifie si le produit n'existe pas déjà dans le panier
        $req = "SELECT amount FROM order_details WHERE id_order = :id_order AND id_product = :id_product AND sauce = :sauce";
        $result = $bdd->prepare($req);
        $result->bindParam(':id_order', $id_order);
        $result->bindParam(':id_product', $id_product);
        $result->bindParam(':sauce', $sauce);
        $result->execute();
		$tab = $result->fetchAll();
		if(!empty($tab)){
			$amount = $tab[0]['amount']+1;
			$req2 = "UPDATE order_details SET amount = :amount ";
			$req2 .= "WHERE	id_order=:id_order AND id_product=:id_product AND sauce = :sauce";
			$result2 = $bdd->prepare($req2);
			$result2->bindParam(':id_order', $id_order);
			$result2->bindParam(':id_product', $id_product);
			$result2->bindParam(':amount', $amount);
			$result2->bindParam(':sauce', $sauce);
			$result2->execute();
			$count = $result2->rowCount();
			if($count != 0){return TRUE;}
			else{return FALSE;}
		}
		//Sinon on ajoute simplement le produit au panier
		else{
	        $amount = 1;
	        $req2 = "INSERT INTO order_details VALUES (:id_order, :id_product, :amount, :sauce)";
	        $result2 = $bdd->prepare($req2);
	        $result2->bindParam(':id_order', $id_order);
	        $result2->bindParam(':id_product', $id_product);
	        $result2->bindParam(':amount', $amount);
	        $result2->bindParam(':sauce', $sauce);
	        $result2->execute();
	        $count = $result2->rowCount();
			if($count != 0){return TRUE;}
			else{return FALSE;}
		}
	}
	
	//Permet de supprimer un produit du panier
	function del_product_of_order($id_order,$id_product,$sauce){
        $bdd = Database3Splus::getinstance();//connexion();
        $req = "DELETE FROM order_details WHERE id_order = :id_order AND id_product = :id_product AND sauce = :sauce";
        $result = $bdd->prepare($req);
        $result->bindParam(':id_order', $id_order);
        $result->bindParam(':id_product', $id_product);
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
		$req = "SELECT id_order FROM orders WHERE id_user=:id_user AND paid=0";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_user', $id_user);
		$result->execute();
		$result2=$result->fetchAll();
		if (!empty($result2)){
			return $result2[0];	
		}else{
			return FALSE;
		}
	}
	
	//Permet de modifier la quantité d'un produit
	function edit_account_product($id_order,$id_product,$amount,$sauce){
		$bdd = Database3Splus::getinstance();//connexion();
		$req = "UPDATE order_details SET amount = :amount ";
		$req .= "WHERE	id_order=:id_order AND id_product=:id_product AND sauce = :sauce";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_order', $id_order);
		$result->bindParam(':id_product', $id_product);
		$result->bindParam(':amount', $amount);
		$result->bindParam(':sauce', $sauce);
		$result->execute();
		$count = $result->rowCount();
		return $count;
	}
	
	//Permet de valider une commande (après paiement paypal)
	function confirm_order($id_order){
		$bdd = Database3Splus::getinstance();//connexion();
		$id_paid = 1;
		$req = "UPDATE orders SET paid=1 WHERE id_order = :id_order";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_order', $id_order);
		$result->execute();
	}

	//Permet de récupéré la liste des produits d'une commande
	function get_info_order($id_order){
		$bdd = Database3Splus::getinstance();//connexion();
		$req = "SELECT OD.id_product,OD.amount,OD.sauce FROM order_details OD,orders O  WHERE O.id_order=OD.id_order AND OD.id_order=:id_order";
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
	
	//Permet d'obtenir le nombre total de commande validé d'un utilisateur
	function get_id_order_paid($id_user){
		$bdd = Database3Splus::getinstance();//connexion();
		$req = "SELECT id_order FROM orders WHERE id_user=id_user AND paid=1";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_user', $id_user);
		$result->execute();
		$result2['info'] = $result->fetchAll();
		$result2['count'] = count($result2["info"]);
		if($result2['count']){
			return $result2;
		}
		else{
			return FALSE;
		}
	}
	
	

	
?>
