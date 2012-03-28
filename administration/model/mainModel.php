<?php
//Liste les groupes ayant commandé
	function get_group_cmd(){
		
		$bdd = Database3Splus::getinstance();//connexion();
		$req="select id_group,name from groups"; //Un user est placé dans un group uniquement si order de user est paid donc ...
		$result = $bdd->prepare($req);
		$result->execute();
		$count = $result->rowCount();//on compte nombre de groups retourné
		$result2 = $count.''.$result;//on ajoute le nombre total à la liste
		$groups = $result2->fetchAll();//On organise le tout...
		if(!empty($groups)){
			return $groups;
		}
		else{			//Si il n'y a aucun group ayant validé
			return FALSE;
		}		
	}

//Liste utilisateurs du groupe qui ont commandé
	function get_user_cmd($id_group){

		$bdd = Database3Splus::getinstance();//connexion();
		$req = "select U.id_user from users U,orders O where id_group=:id_group and U.id_user=O.id_user and O.paid=1"; //Select id_user de la table user où id_group vaut "parametre" et id_user de user et order identiques et paid de order est "payé".
		$result = $bdd->prepare($req);
		$result->bindParam(':id_group', $id_group);
		$result->execute();
		$usr = $result->fetchAll();
		if(!empty($usr)){
			return $usr;
		}
		else{			//Si il n'y a aucun usr ayant validé
			return FALSE;
		}
	}

//Detail la commande d'un utilisateur (Nom de produit, Categorie , Sauce , Qauntité)
//Un utilisateur peut commander plusieurs produit différents =)
function get_cmd_detail($id_user){
	$bdd = Database3Splus::getinstance();//connexion();
	$req = "select P.name,C.name,OD.sauce,OD.amount from products P,category C,order_details OD,orders O where O.id_user=:id_user and OD.id_product=P.id_product and O.id_order=OD.id_order and P.id_category=C.id_category";//Renvoi nom produit,nom categorie,sauce,quantite de produit,categorie,detailcommande où id_user sont identiques et id_order identiques.
	$result = $bdd->prepare($req);
	$result->bindParam(':id_user', $id_user);
	$result->execute();
	$cmd = $result->fetchAll();
	if(!empty($cmd)){
		return $cmd;
	}
	else{			//SI aucune commande n'est retournée
		return FALSE;
	}
}
?>
