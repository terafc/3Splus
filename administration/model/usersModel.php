<?php
//Créer un utilisateur
function user_add($id_user,$lastname,$firstname,$email,$id_group,$id_facebook) {
        $bdd = Database3Splus::getinstance();//connexion();
        $point = 0;
        $req = "INSERT INTO users VALUES (:id_user, :lastname, :firstname, :email, :id_group, :id_facebook, :point)";
        $result = $bdd->prepare($req);
        $result->bindParam(':id_user', $id_user);
        $result->bindParam(':lastname', $lastname);
        $result->bindParam(':firstname', $firstname);
        $result->bindParam(':email', $email);
        $result->bindParam(':id_group', $id_group);
        $result->bindParam(':id_facebook', $id_facebook);
        $result->bindParam(':point', $point);
        $result->execute();
        //en cas d'insertion ou de suppression retourner count
        $count = $result->rowCount();
        return $count;
}

//Supprimer un utilisateur
function user_del($id_user){
	$bdd = Database3Splus::getinstance();
	$req = "DELETE FROM users WHERE id_user=:id_user";
	$result = $bdd->prepare($req);
	$result->bindParam(':id_user', $id_user);
	$result->execute();
	$count = $result->rowCount();//Nombre de lignes affectes
	return $count;
}

//Permet d'éditer un utilisateur
//WARNING = Column unsecured !!!!
function user_account_edit($id_user,$column,$new_value){
	$bdd = Database3Splus::getinstance();
    $req = 'UPDATE users SET '.$column.'=:new_value WHERE id_user=:id_user';
    $result = $bdd->prepare($req);
    //$result->bindParam(':column', $column);
	$result->bindParam(':new_value', $new_value);
	$result->bindParam(':id_user', $id_user);
    $result->execute();
	$count = $result->rowCount();//Nombre de lignes affectes
    return $count;
}

//Permet d'obtenir une authentification si il s'agit d'utilisateur autorisé
function user_auth($uid_fb){
    $bdd = Database3Splus::getinstance();//connexion();
	$req = "SELECT id_user FROM users WHERE id_facebook = :uid_fb";
	$result = $bdd->prepare($req);
	$result->bindParam(':uid_fb', $uid_fb);
	$result->execute();
	$colcount = $result->fetchColumn();//Récupère la première colonne depuis la ligne suivante d'un jeu de résultats
	if($colcount != 0){
		return TRUE;
	}
	else{
		return FALSE;
	}
}

//Permet d'obtenir les informations d'un utilisateur
function user_get_info($id_facebook){
    $bdd = Database3Splus::getinstance();  //connexion();
    $req = "SELECT users.* , groups.name FROM users,groups WHERE users.id_group = groups.id_group AND users.id_facebook = :id_facebook";
    $result = $bdd->prepare($req);
    $result->bindParam(':id_facebook', $id_facebook);
    $result->execute();
    $info = $result->fetchAll();
    return $info;
}

//Permet d'obtenir un id_group pour un nouvel utilisateur
function getNumberOfUserPerGroups() {
	$bdd = Database3Splus::getinstance();  //connexion();
	//Pour obtenir le nombre de menbre par groupe
	//L'astuce consiste ici à additionner les mêmes id entre eux, et de les diviser par l'id plus loin pour obtenir le nombre de menbre
	$req = "SELECT id_group, SUM(id_group) AS somme FROM users GROUP BY id_group";
	$result = $bdd->prepare($req);
	$result->execute();
	$a = $result->fetchAll();
	$groups = array();
	foreach ($a as $key => $value) {
		$groups[$value['id_group']]=floor($value['somme']/$value['id_group']);
	}
	return $groups;
}

?>
