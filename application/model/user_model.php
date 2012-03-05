<?php
//Supprimer user
require_once('Database.php');

function user_del($id_user){
	
	$bdd = Database::getinstance();
	$req = "delete from users where id_user=:id_user";
	$result = $bdd->prepare($req);
	$result->bindParam(':id_user', $id_user);
	$result->execute();

	$count = $result->rowCount();//Nombre de lignes affectes
	return $count;
}
//WARNING = Column unsecured !!!!
function user_account_edit($id_user,$column,$new_value){
	$bdd = Database::getinstance();
        $req = 'update users set '.$column.'=:new_value where id_user=:id_user';
        $result = $bdd->prepare($req);
        //$result->bindParam(':column', $column);
	$result->bindParam(':new_value', $new_value);
	$result->bindParam(':id_user', $id_user);
        $result->execute();
	
	$count = $result->rowCount();//Nombre de lignes affectes
        return $count;
}

function add_user($id_user,$firstname,$lastname,$email,$id_group) {

        $bdd = Database::getinstance();//connexion();
        $req = "INSERT INTO users VALUES (:id_user, :firstname, :lastname, :email, :id_group)";
        $result = $bdd->prepare($req);
        $result->bindParam(':id_user', $id_user);
        $result->bindParam(':firstname', $firstname);
        $result->bindParam(':lastname', $lastname);
        $result->bindParam(':email', $email);
        $result->bindParam(':id_group', $id_group);

        $result->execute();
        //en cas d'insertion ou de suppression retourner count
        $count = $result->rowCount();
        return $count;
}

//*******authentification de l'user au sein du groupe
//Créer Groupe          
function create_group($name) {

        $bdd = Database::getinstance();  //connexion();
        $req = "INSERT INTO groups VALUES (:name)";
        $result = $bdd->prepare($req);
        $result->bindParam(':name', $name);

        $result->execute();
        //en cas d'insertion ou de suppression retourner count
        $count = $result->rowCount();
        return $count;
}

//suppression d'un groupe
function del_group($id_group)  {
        $bdd = Database::getinstance();  //connexion();
        $req = "DELETE FROM TABLE groups WHERE id_group=:id_group";
        $result = $bdd->prepare($req);
        $result->bindParam(':id_group', $id_group);
        $result->execute();


        $count = $result->rowCount();
        return $count;
}

//ajouter user a groupe
function add_UTG($id_group,$id_user) {

        $bdd = Database::getinstance();  //connexion();
        $req = "INSERT INTO group_user VALUES (:id_group,:id_user)";
        $result = $bdd->prepare($req);
        $result->bindParam(':id_group', $id_group);
        $result->bindParam(':id_user', $id_user);
        $result->execute();
        //en cas d'insertion ou de suppression retourner count
        $count = $result->rowCount();
        return $count;
}

//supprimer user
function del_UOG($id_group, $id_user) {
        $bdd = Database::getinstance();  //connexion();
        $req = "DELETE FROM TABLE group_user WHERE id_user=:id_user";
        $result = $bdd->prepare($req);
        $result->bindParam(':id_user', $id_user);
        $result->execute();


        $count = $result->rowCount();
        return $count;
}


?>
