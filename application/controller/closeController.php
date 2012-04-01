<?php
	switch($action){
		case "show":
			//On affiche une page récapitulatif du porteur lorsque le site est fermé
			require_once(CHEMIN_MODEL."/usersModel.php");
			require_once(CHEMIN_MODEL."/closeModel.php");
			$tmp = user_get_info($uid);
			$userCurrentInfo = $tmp[0];//Index 0 à cause du fetchAll()
			$tmp = getCarrierInfoOfUser($userCurrentInfo['id_user']);
			$carrierInfo = $tmp[0];
			if($carrierInfo!=FALSE){
				$id_order = implode(' - ',getIdOrderOfUser($userCurrentInfo['id_user']));
			}
			include_once(CHEMIN_VIEW."/close.php");
			break;
		case "banned":
			include_once(CHEMIN_VIEW."/banned.php");
			break;
		default :
			break;
	}
?>