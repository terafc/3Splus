<?php

	require_once (CHEMIN_MODEL . '/mainModel.php');
	switch($_REQUEST['action']){
		case 'show':

	
			$CMD[0]=array("Bouchon Gratine","K", "Fanta 50cl","DIJOUX", "Marc","3100263");
			$CMD[1]=array("Americain Poulet","M", "Coca 50cl","NANDJAN", "Clement","3000302");
			$CMD[2]=array("Americain Jambon","P", "Edena 1l","RETHORE","Sof", "3100325");
			$CMD[3]=array("Americain nature","KP", "Sprite 50cl", "MARCOZ", "Francel", "3000254");
			$Numcmd="026256";
			$NomGroupe="Roti Porc";
			$Porteur="DIJOUX Marc";
			$NumetdPorteur="3100263";
		
			$cmds[0]['commandes'] = $CMD;
			$cmds[0]['num_cmd'] = "026256";
			$cmds[0]['nom_grp'] = "Groupe 1";
			$cmds[0]['nom_porteur'] = "RETHORE Sof";
			$cmds[0]['num_porteur'] = "3100325";
	
			$cmds[1]=$cmds[0];

			function get_url_validate_by_gid($Gid){
				return HTTP_INDEX.'?page=product&action=validate&id='.$Gid;
			}

			include_once(CHEMIN_VIEW . '/header.php');
			include_once(CHEMIN_VIEW . '/commandes.php');
			include_once(CHEMIN_VIEW . '/footer.php');
			break;
		case 'show_indiv':
			include_once(CHEMIN_VIEW . '/header.php');
			include_once(CHEMIN_VIEW . '/individuel.php');
			include_once(CHEMIN_VIEW . '/footer.php');
			break;
		case 'show_edit':
			include_once(CHEMIN_VIEW . '/header.php');
			include_once(CHEMIN_VIEW . '/editer.php');
			include_once(CHEMIN_VIEW . '/footer.php');
			break;

		case 'validate':
			
			include_once(CHEMIN_VIEW . '/header.php');
			echo $_REQUEST['id'];
			include_once(CHEMIN_VIEW . '/footer.php');
		default:
			break;
	}
?>
