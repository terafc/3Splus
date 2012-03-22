<?php
//Liste les groupes ayant commandé
	function get_group_cmd(){

	}
//Liste utilisateurs du groupe qui ont commandé
	function get_user_cmd($id_group){

		$bdd = Database3Splus::getinstance();//connexion();
		$req = "select U.id_user from users U,orders O where id_group=1 and U.id_user=O.id_user and O.paid=1";
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

function get_cmd_detail($id_user){
	
}
?>
