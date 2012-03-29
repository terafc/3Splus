<?php
//Définition de la connexion PDO
define('SQL_DSN', 'mysql:dbname=tp3-3splus-db1;host=sql.franceserv.fr');
define('SQL_USERNAME', 'tp3-3splus');
define('SQL_PASSWORD', 'ASSASSINS');

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
?>
<?php
    $bdd = Database3Splus::getinstance();//connexion();
	//Première tâche : Calcul du porteur
	$porteur=array();
	$req_order="SELECT id_order, id_user FROM orders WHERE paid=1";
	$i=0;
	foreach ($bdd->query($req_order) as $key => $value) {
		//On récupère le nombre de point de l'utilisateur
		$req_user = "SELECT u.point, u.id_group FROM users u, orders o WHERE u.id_user=o.id_user";
		foreach ($bdd->query($req_user) as $key2 => $value2) {
			$porteur[$value2['id_group']][$value2['point']]=$value['id_user'];
		}
	}
	asort($porteur);
	foreach ($porteur as $key => $value) {
		arsort($porteur[$key]);
		//Sélection du porteur
		$req_porteur = "INSERT INTO carrier VALUES('','".$porteur[$key]."','".$value."')";
	}
	var_dump($porteur);
	//Deuxième tâche : Ajout des points pour chaque porteur et envoi de mail

	
?>