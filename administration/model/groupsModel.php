<?php
//Créer un Groupe          
function group_create($name) {
	$bdd = Database3Splus::getinstance();  //connexion();
	$req = "INSERT INTO groups VALUES (:name)";
	$result = $bdd->prepare($req);
	$result->bindParam(':name', $name);
	$result->execute();
	//en cas d'insertion ou de suppression retourner count
	$count = $result->rowCount();
	return $count;
}

//Supprimer un groupe
function group_del($id_group)  {
	$bdd = Database3Splus::getinstance();  //connexion();
	$req = "DELETE FROM TABLE groups WHERE id_group=:id_group";
	$result = $bdd->prepare($req);
	$result->bindParam(':id_group', $id_group);
	$result->execute();
	$count = $result->rowCount();
	return $count;
}

//Permet d'obtenir la liste distincte des groupes (id)
function group_getDistinct($id='*'){
	$bdd = Database3Splus::getinstance();  //connexion();
	if($id=='*'){
		$req = "SELECT DISTINCT * from groups";
	}
	else{
		$req = "SELECT DISTINCT * FROM groups where id_group=$id";
	}
	$result = $bdd->prepare($req);
	$result->execute();
	$groups = $result->fetchAll();
	return $groups;
}
?>