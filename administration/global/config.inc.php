<?php
//Définit une liste de chemins(Chemin sur le serveur)
define('CHEMIN_GLOBAL', $_SERVER['DOCUMENT_ROOT'].'3Splus/administration/global');
define('CHEMIN_CONFIG', $_SERVER['DOCUMENT_ROOT'].'3Splus/administration/config');
define('CHEMIN_LIB', $_SERVER['DOCUMENT_ROOT'].'3Splus/administration/lib');
define('CHEMIN_IMG', $_SERVER['DOCUMENT_ROOT'].'3Splus/administration/img');
define('CHEMIN_VIEW',$_SERVER['DOCUMENT_ROOT'].'3Splus/administration/view');
define('CHEMIN_MODEL',$_SERVER['DOCUMENT_ROOT'].'3Splus/administration/model');
define('CHEMIN_CONTROLLER',$_SERVER['DOCUMENT_ROOT'].'3Splus/administration/controller');
define('CHEMIN_INDEX',$_SERVER['DOCUMENT_ROOT'].'3Splus/index.php');
//Définit une liste de lien HTTP
define('HTTP_VIEW','http://'.$_SERVER['SERVER_NAME'].'/3Splus/administration/view');
define('HTTP_MODEL','http://'.$_SERVER['SERVER_NAME'].'/3Splus/administration/model');
define('HTTP_CONTROLLER','http://'.$_SERVER['SERVER_NAME'].'/3Splus/administration/controller');
define('HTTP_JS','http://'.$_SERVER['SERVER_NAME'].'/3Splus/administration/js');
define('HTTP_CSS','http://'.$_SERVER['SERVER_NAME'].'/3Splus/administration/css');
define('HTTP_IMG','http://'.$_SERVER['SERVER_NAME'].'/3Splus/administration/img');
define('HTTP_INDEX','http://'.$_SERVER['SERVER_NAME'].'/3Splus/index.php');
?>
