<?php
//Contient les fonctions relative à l'authentification de/des administrateurs

//Fonction d'authentification de l'admin, renvoye un tableau avec ses infos si autorisé , FALSE sinon
function auth($id_admin,$mdp_admin){
	$bdd = Database3Splus::getinstance();
	$auth=array();
	if(!empty($id_admin) && !empty($mdp_admin)){
		$req= $bdd -> prepare("select * from admin_users where name_admin=:name ");
		$req -> bindParam(':name',$id_admin);
		$req->execute();
		$user=$req->fetch();
		if($user){
			if($user['mdp_admin']==md5($mdp_admin)){
				$auth['id']=$user['id_admin'];
				$auth['name']=$user['name_admin'];
				return $auth;
			}
		}
		else{
			return FALSE;
		}
	}
}
?>