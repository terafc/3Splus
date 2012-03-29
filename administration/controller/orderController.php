<?php

	require_once (CHEMIN_MODEL . '/mainModel.php');
	switch($_REQUEST['action']){
		case 'show':
			/*
			//On recupere les groupe qui ont au moins une commande
			$groups = get_groups();
			$cmds = array();
			$i = 0;
			foreach ($groups as $group){
				//Recupere les infos sur le groupe
				$cmds[$i]['nom_grp'] = $group['name'];
				$cmds[$i]['num_cmd'] = $group['id_group'];
				$cmds[$i]['nom_porteur'] = "None";//Pas implemente
				$cmds[$i]['num_porteur'] = "None";//Pas implemente
				$cmds[$i]['commandes'] = array();
				//Recupere les utilisateur qui ont commande dans le groupe
				$users = get_users($group['id_group']);
				foreach ($users as $user){
					$j = 0;
					//Recupere les commande du jour non valide
					$orders = get_orders($user['id_user']);
					foreach ($orders as $order){
						$cmds[$i]['commandes'][$j] = array();
						//Recupere les produit de la commande
						$products = get_products($order['id_order']);
						//$details = get_details($order['id_user']);
						$cmds[$i]['commandes'][$j][1] = "K";//$details['name'];

						foreach ($products as $product){
							//On recupere la categorie
							$categorie = get_categorie($product['id_categorie']);
							$ind = -1;
							switch($categorie['id_categorie']){
								case 1:
									$ind = 0;
									break;
								case 5:
									$ind = 2;
									break;
								case 6:
									$ind = 0;
									break;
								default:
									break;
							}
							if($ind != -1)
								$cmds[$i]['commandes'][$j][$ind] = $product['name'];
						}
						//On ajoute les info utilisateur à la commande
						$cmds[$i]['commandes'][$j][3] = $user['lastname'];
						$cmds[$i]['commandes'][$j][4] = $user['firstname'];
						$cmds[$i]['commandes'][$j][5] = $user['id_user'];
						//$cmds[$i]['commandes'][$j][5] = $order['id_order'];
						$j++;
					}
					$i++;
				}
			}
			*/	
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
