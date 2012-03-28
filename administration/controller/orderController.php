<?php

	require_once (CHEMIN_MODEL . '/mainModel.php');
	switch($_REQUEST['action']){
		case 'show':
			$CMD[0]=array("Bouchon Gratine","K", "Fanta 50cl","DIJOUX", "Marc","3100263");
			$CMD[1]=array("Americain Poulet","M", "Coca 50cl","NANDJAN", "Clement","3000302");
			$CMD[2]=array("Americain Jambon","P", "Edena 1l","RETHORE","Sof", "3100325");
			$CMD[3]=array("Americain nature","KP", "Sprite 50cl", "MARCOZ", "Francel", "3000254");
		
			$cmds[0]['commandes'] = $CMD;
			$cmds[0]['num_cmd'] = "026256";
			$cmds[0]['nom_grp'] = "Groupe 1";
			$cmds[0]['nom_porteur'] = "RETHORE Sof";
			$cmds[0]['num_porteur'] = "3100325";
	
			$cmds[1]=$cmds[0];

			$validate_url = HTTP_INDEX.'?page=order&action=validate';

			include_once(CHEMIN_VIEW . '/header.php');
			include_once(CHEMIN_VIEW . '/commandes.php');
			include_once(CHEMIN_VIEW . '/footer.php');
			break;
		case 'validate':
			break;
		default:
			include_once (CHEMIN_VIEW . '/header.php');
			include_once (CHEMIN_VIEW . '/404.php');
			include_once (CHEMIN_VIEW . '/footer.php');
			break;
	}
?>
