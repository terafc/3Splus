<?php
	//Permet d'envoyer un email de notification
	function sendEmail($mail,$sujet,$mess,$fichier){
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)){ // On filtre les serveurs qui présentent des bogues.
			$passage_ligne = "\r\n";
		}
		else{
			$passage_ligne = "\n";
		}
		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = $mess['text'];
		$message_html = $mess['html'];
		//==========
		 
		//=====Lecture et mise en forme de la pièce jointe si existe
		if(!empty($fichier)){
			$fichier   = fopen("rendu.zip", "r");
			$attachement = fread($fichier, filesize("rendu.zip"));
			$attachement = chunk_split(base64_encode($attachement));
			fclose($fichier);
		}
		//==========
		 
		//=====Création de la boundary.
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());
		//==========
		 
		//=====Création du header de l'e-mail.
		$header = "From: \"3Splus\"<3Splus@franceserv.com>".$passage_ligne;
		$header.= "Reply-to: \"3Splus\" <no-reply@franceserv.com>".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========
		 
		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;
		//==========
		 
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		 
		//=====Ajout du message au format HTML.
		$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;
		//==========
		 
		//=====On ferme la boundary alternative.
		$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
		//==========
		 
		$message.= $passage_ligne."--".$boundary.$passage_ligne;
		 
		//=====Ajout de la pièce jointe si existe
		if(!empty($fichier)){
			//===== On récupère les infos du fichier
			$infoPath = pathinfo(($fichier['name']));//pathinfo retourne les infos sur le chemin passer en argument, par ex : l'extension.
			$extension = strtolower (".".$infoPath['extension']);//L'extension du fichier. Ex : .rar
			$type = $fichier['type'];//Le type du fichier. Par exemple, cela peut être « image/png ».
			$size = $fichier['size'];//La taille du fichier en octets
			$tmp_name = $fichier['tmp_name'];//L'adresse vers le fichier uploadé dans le répertoire temporaire.
			//=====
			//===== Vérification
			$maxsize=20971520;//20Mo
			if($size > $maxsize){return false;}//Erreur : fichier trop gros
			//=====
			$message.= "Content-Type: ".$type."; name=\"".basename($fichier['name'])."\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
			$message.= "Content-Disposition: attachment; filename=\"".$tmp_name."\"".$passage_ligne;
			$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
			$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
		}
		//========== 
		//=====Envoi de l'e-mail.
		if(mail($mail,$sujet,$message,$header)){return TRUE;}
		else{return FALSE;}
		//==========
	}
	
	//Permet d'avoir un log des emails envoyés
	function logEmail($idConfirm,$email){
        $bdd = Database3Splus::getinstance();//connexion();
		$idMail = uniqid(null,TRUE);//Création d'un id pour l'email
		$datePost = date("Y-m-d H:i:s");
		$reqNotif = "INSERT INTO log_email VALUES (:idMail,:email,:idConfirm,:datePost)";
		$result = $bdd->prepare($reqNotif);//préparation
		$result->bindParam(':idMail', $idMail);
		$result->bindParam(':email', $email);
		$result->bindParam(':idConfirm', $idConfirm);
		$result->bindParam(':datePost', $datePost);
		$result->execute();//exécution
		$count = $result->rowCount();
	    //$count contient le nombre de ligne inséré dans la BDD.
		if($count!=1){
			return FALSE;//Erreur
		}
		else{
			return TRUE;//Succès
		}
	}
	
	//Permet de vérifier si l'email est autorisé
	function verifEmail($email){
        $bdd = Database3Splus::getinstance();//connexion();
		$req = "SELECT id_users_authorized FROM users_authorized WHERE email = :email";
		$result = $bdd->prepare($req);
		$result->bindParam(':email', $email);
		$result->execute();
		$colcount = $result->fetchColumn();//Récupère la première colonne depuis la ligne suivante d'un jeu de résultats
		if($colcount != 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	//Permet de vérifier un email de confirmation
	function verifConfirm($idConfirm){
        $bdd = Database3Splus::getinstance();//connexion();
		$req = "SELECT email FROM log_email WHERE idConfirm = :idConfirm";
		$result = $bdd->prepare($req);
		$result->bindParam(':idConfirm', $idConfirm);
		$result->execute();
		$email = $result->fetchAll();
		if(!empty($email)){
			$req2 = "SELECT id_users_authorized, lastname, firstname, email FROM users_authorized WHERE email = :email";
			$result2 = $bdd->prepare($req2);
			$result2->bindParam(':email', $email[0]['email']);
			$result2->execute();
			$info2 = $result2->fetchAll();
			if(empty($info2)){
				return FALSE;
			}
			else{
				return $info2[0];//On retourne l'index 0 à cause du fetchAll()
			}
		}
		else{
			return FALSE;
		}
	}
	
	function updateStatusConfirm($id_users_authorized){
        $bdd = Database3Splus::getinstance();//connexion();
		$req = "UPDATE users_authorized SET status = 1 WHERE id_users_authorized = :id_users_authorized";
		$result = $bdd->prepare($req);
		$result->bindParam(':id_users_authorized', $id_users_authorized);
		$result->execute();
		$count = $result->rowCount();//Récupère la première colonne depuis la ligne suivante d'un jeu de résultats
		if($count != 0){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	
?>