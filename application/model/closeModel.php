<?php
	//Permet de récupérer les infos d'un carrier en fonction de l'id d'un utilisateur (client)
	function getCarrierInfoOfUser($id_user){
		$bdd=Database3Splus::getInstance();//Connexion();
		//Tout d'abord on récupère la liste des id des carrier
		$query = "SELECT carriers FROM carrier WHERE id_user = :id_user";
		$result = $bdd->prepare($query);
		$result->bindParam(':id_user', $id_user);
		$result->execute();
		$info = $result->fetchAll();
		$id_carrier = explode('||',$info[0]['carriers']);//Index 0 , car un seul résultat est utile
		//On récupère maintenant les infos de chaque carrier
		$i=0;
		$carrierInfo=array();
		foreach ($id_carrier as $value) {
			if(empty($value)){continue;}//On ne prend pas en compte les valeurs nulle, dû aux explode()
			$queryCarrier = "SELECT u.lastname, u.firstname, u.email, g.name FROM users u, groups g WHERE u.id_group=g.id_group AND id_user=:id_user";
			$result = $bdd->prepare($queryCarrier);
			$result->bindParam(':id_user', $value);
			$result->execute();
			$tmp = $result->fetchAll();
			$carrierInfo[$i]=$tmp[0];
		}
		if(isset($carrierInfo) && !empty($carrierInfo)){
			return $carrierInfo;
		}
		else{//Sinon erreur.
			return FALSE;
		}
	}

	//Permet de récupérer la liste des id_order d'un utilisateur
	function getIdOrderOfUser($id_user){
		$bdd=Database3Splus::getInstance();//Connexion();
		$query = "SELECT id_order FROM orders WHERE id_user = :id_user";
		$result = $bdd->prepare($query);
		$result->bindParam(':id_user', $id_user);
		$result->execute();
		$info = $result->fetchAll();
		if(!empty($info)){
			$infoTri = array();//Contiendra $info convertie en array à 1 dimension
			foreach ($info as $value) {
				$infoTri[]=$value['id_order'];
			}
			return $infoTri;
		}
		else{
			return FALSE;
		}
	}
?>