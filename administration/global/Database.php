<?php
define('SQL_DSN', 'mysql:dbname=3splus;host=localhost');
define('SQL_USERNAME', 'root');
define('SQL_PASSWORD', 'root');

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
