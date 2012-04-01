<?php
    $bdd = Database3Splus::getinstance();//connexion();
    
	/*
	 * Première tâche : Calcul et détermination du(des) porteur(s)
	 */
	
	//Tout d'abord, on récupère les points de chaque utilisateur pour les classer.
	$query1 = "SELECT u.id_group, u.point, u.id_user, o.id_order FROM users u, orders o WHERE o.paid = 1";
	$tmp1 = array();//Vaudra : [id_group][point]=id_user
	//$orders vaudra : [id_group]['id_order']=id_order
	//et : [id_group]['id_user']=id_user
	$orders = array();
	foreach ($bdd->query($query1) as $value) {
		$tmp1[$value['id_group']][$value['point']]=$value['id_user'];
		$orders[$value['id_group']]['id_order']=$value['id_order'];
		$orders[$value['id_group']]['id_user']=$value['id_user'];
	}
	//A présent on va trié l'array
	$tmp2 = array();//Contiendra l'array $tmp1 classé, mais sans ajouter les points : [id_group][0]=>id_user
	foreach ($tmp1 as $key => $value) {
		asort($tmp1[$key]);//On tri l'array par ordre croissant des points pour chaque groupe
		$i=0;
		foreach ($tmp1[$key] as $value2) {
			$tmp2[$key][$i]=$value2;
			$i++;
		}
	}
	//On détermine les porteurs et leurs nombres
	foreach ($tmp2 as $key => $value) {
		$tmp3 = array();//Contiendra la liste des carriers pour un groupe : [id_group]=carriers
		$number = ceil(count($value)/4);//4 commandes par porteur
		for ($i=0; $i<$number; $i++){//$i<$number car on commence à l'index 0
			//On concatène l'id des différents carriers.
			if(!isset($tmp3[$key])){
				$tmp3[$key]="||".$value[$i]."||";
			}
			else{
				$tmp3[$key].=$value[$i]."||";
			}
		}
	}
	$idAlreadySend=array();//Servira plus tard lors de l'envoi de mail
	//On défini maintenant un carrier pour chaque commande, on ajoute les points au porteur, et on envoi un mail de notification
	foreach ($orders as $key => $value) {
		$queryInsert = "INSERT INTO carrier VALUES ('".$tmp3[$key]."','".$value['id_user']."','".$value['id_order']."',0)";
		$count = $bdd->exec($queryInsert);
		if($count == 0){//Si il y a une erreur
			echo "Une erreur s'est produite lors de l'ajout du carrier. Requête exécuté : INSERT INTO carrier VALUES ('".$tmp3[$key]."','".$value['id_user']."','".$value['id_order']."')";
		}
		/******************************************
		 * 2ème Tache : Envoi de mail aux clients *
		 ******************************************/
		
		//Envoi de mail
		//Si il s'agit du porteur et qu'un mail lui a déjà été envoyé, on continue
		if(in_array($value['id_user'],$idAlreadySend)){
			continue;
		}
		//Si il s'agit du porteur
		elseif(in_array($value['id_user'],$idAlreadySend) && $value['id_user']==$tmp3[$key]){
			$idAlreadySend[]=$value['id_user'];
			$info = getInfoUser($value['id_user']);
			$sujet = "Porteur de la Commande chez 3S+";
			$mess['text']="Vous avez été désigné comme Porteur des commandes chez 3S+ pour votre groupe ('".$info['name']."'). Veuillez vous rendre à midi à la cafétéria pour récupérer les commandes.";
			$mess['html']="Vous avez été désigné comme Porteur des commandes chez 3S+ pour votre groupe ('".$info['name']."'). Veuillez vous rendre à midi à la cafétéria pour récupérer les commandes.";
			if($info!=FALSE){
				sendEmail($info['email'], $sujet, $mess, '');
			}
		}
		//Si il ne s'agit pas d'un porteur
		else{
			$info = getInfoUser($value['id_user']);
			$sujet = "Porteur de la Commande chez 3S+";
			$mess['text']="Le porteur de votre Commande (ID : ".$value['id_order'].") est '".$info['lastname']." ".$info['firstname']."'";
			$mess['html']="Le porteur de votre Commande (ID : ".$value['id_order'].") est '".$info['lastname']." ".$info['firstname']."'";
			if($info!=FALSE){
				sendEmail($info['email'], $sujet, $mess, '');
			}
		}
	}	
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