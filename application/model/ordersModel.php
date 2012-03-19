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
	
	//Permet de vérifier si un utilisateur a déjà une commande, et si oui, si elle est validé.
	function verif_user_order($id_user){
		
	}
	
	//Permet de modifier la quantité d'un produit
	function edit_account_product($id_order,$id_produit){
		
	}
	
	//Permet de valider une commande (après paiement paypal)
	function confirm_order($id_order){
		
	}
?>