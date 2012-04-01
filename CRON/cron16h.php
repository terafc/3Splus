<?php
    $bdd = Database3Splus::getinstance();//connexion();
    /*Première Tâche : Mise à jour des points.*/
    //Si un carrier n'a pas pris les commandes, alors il a -1 point
    $req0 = "SELECT carriers, status FROM carrier";
	$carrier=array();
	foreach ($bdd->query($req0) as $value) {
		if($value['status']!=0){
			$carrier1[]=$value['carriers'];//Désigne ceux qui ont récupérés les commandes
		}
		else{
			$carrier0[]=$value['carriers'];//Désigne ceux qui n'ont pas récupérés les commandes
		}
	}
	if(!empty($carrier1)){//
		foreach ($carrier1 as $value) {
			$tmp = explode('||',$value);
			foreach ($tmp as $value1) {
				if(empty($value1)){continue;}//On ne prend pas ne compte les éléments vide
				$updatePoint = "UPDATE users SET point=point+1 WHERE id_user='".$value1."'";
				$count = $bdd->exec($updatePoint);
				if($count==0){
					echo "Une erreur s'est produite lors la mise à jour des points. Requête : UPDATE users SET point=point+1 WHERE id_user='".$value1."'";
				}
				$info = getInfoUser($value1);
				$sujet = "3S+ : Mise à jour de vos points.";
				$mess['text']="Bonjour ! Merci d'avoir récupéré les commandes qui vous ont été attribuées chez 3S+. Un point supplémentaire vous a donc été donné.";
				$mess['html']="<p>Bonjour !</p><p>Merci d'avoir récupéré les commandes qui vous ont été attribuées chez 3S+. Un point supplémentaire vous a donc été donné.</p>";
				sendEmail($info['email'], $sujet, $mess, '');
			}
		}
	}
	if(!empty($carrier0)){
		foreach ($carrier0 as $value) {
			$tmp = explode('||',$value);
			foreach ($tmp as $value1) {
				if(empty($value1)){continue;}//On ne prend pas ne compte les éléments vide
				$updatePoint = "UPDATE users SET point=point-2 WHERE id_user='".$value1."'";
				$count = $bdd->exec($updatePoint);
				if($count==0){
					echo "Une erreur s'est produite lors la mise à jour des points. Requête : UPDATE users SET point=point-1 WHERE id_user='".$value1."'";
				}
				$info = getInfoUser($value1);
				$sujet = "3S+ : Commandes non récupérées.";
				$mess['text']="Vous n'avez pas récupérer les commandes 3S+ qui vous ont été attribuées. Vous êtes donc pénalisé de 2 points. Si vos points deviennent alors inférieur à 5 points, vous ne pourrez plus commander de sandwich sur notre application.";
				$mess['html']="<p>Vous n'avez pas récupérer les commandes 3S+ qui vous ont été attribuées. </p><p>Vous êtes donc pénalisé de 2 points. Si vos points deviennent alors inférieur à 5 points, vous ne pourrez plus commander de sandwich sur notre application.</p>";
				sendEmail($info['email'], $sujet, $mess, '');
			}
		}
	}

	//Deuxième tâche : Suppression des orders et order_details
	$req1 = "DELETE FROM orders";
	$result1 = $bdd->prepare($req1);
	$result1->execute();
	$req2 = "DELETE FROM order_details";
	$result2 = $bdd->prepare($req2);
	$result2->execute();
	
	//Troisième tâche : Suppression des carrier
	$req3 = "DELETE FROM carrier";
	$result3 = $bdd->prepare($req3);
	$result3->execute();
	
?>

<?php
	//Définition des configurations et fonctions
	define('SQL_DSN', 'mysql:dbname=3splus;host=localhost');
	define('SQL_USERNAME', 'root');
	define('SQL_PASSWORD', '');

	class Database3Splus extends PDO {
		private static $_instance;

		public function __construct() {
		}

		//Singleton
		public static function getInstance() {
			if(!isset(self::$_instance)){
				try{
					self::$_instance = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
					$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
					self::$_instance->exec('SET CHARACTER SET utf8');
				}
				catch(PDOException $e){
					die('Erreur: ' . $e->getMessage());
				}
			}
			return self::$_instance;
		}
	}
	
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
	
	//Permet de récupérer les infos d'un utilisateur
	function getInfoUser($id_user){
        $bdd = Database3Splus::getinstance();//connexion();
		$query = "SELECT u.lastname, u.firstname, u.email, g.name FROM users u, groups g WHERE u.id_user = :id_user AND u.id_group=g.id_group";
		$result = $bdd->prepare($query);
		$result->bindParam(':id_user', $id_user);
		$result->execute();
		$info = $result->fetchAll();
		if(!empty($info)){
			return $info[0];
		}
		else{
			return FALSE;
		}
	}
?>
	