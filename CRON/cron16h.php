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
	//Première tâche : Suppression des orders et order_details
	$req = "DELETE FROM orders";
	$result = $bdd->prepare($req);
	$result->execute();
	$req2 = "DELETE FROM order_details";
	$result2 = $bdd->prepare($req2);
	$result2->execute();
	//Deuxième tâche : Suppression des carrier
	$req3 = "DELETE FROM carrier";
	$result3 = $bdd->prepare($req3);
	$result3->execute();
	
?>