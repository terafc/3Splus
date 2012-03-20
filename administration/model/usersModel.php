<?php
//Contient les fonctions relative à la table user

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
//Ajoute l'utilisateur dans la liste des utilisateurs interdit

function blacklist($id_user) {
	
}
?>
