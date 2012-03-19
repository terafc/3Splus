<?php
	switch($action){
		//Affichage simple de la vue
		case "show":
			include_once(CHEMIN_VIEW."/login.php");
			break;
		case "sendLogin":
			require_once(CHEMIN_MODEL."/loginModel.php");
			if(verifEmail($_REQUEST['email'])){
				$idConfirm = uniqid(null,TRUE);//Création d'un id pour la confirmation
				$email = $_REQUEST['email'];
				$sujet = "Vos identifiants pour l'application facebook : 3Splus.";
				$mess['html'] = "<p>Bonjour à vous ! </p><p>L'équipe 3S+ vous remercie d'utiliser notre nouvelle application Facebook. </p></br>";
				$mess['html'] .= "<p>Pour accéder à l'application, veuillez cliquer sur le lien d'activation suivant : <br/>";
				$mess['html'] .= "<a href='http://tp3-3splus.franceserv.fr/index.php?page=login&action=confirmLogin&id_confirm=".$idConfirm."'>http://www.tp3-3splus.franceserv.fr/index.php?page=login&action=confirmLogin&id_confirm=".$idConfirm."</a></p>";
				$mess['text'] = "Bonjour à vous ! L'équipe 3S+ vous remercie d'utiliser notre nouvelle application Facebook. ";
				$mess['text'] .= "Pour accéder à l'application, veuillez suivre sur le lien d'activation suivant : ";
				$mess['text'] .= "http://tp3-3splus.franceserv.fr/index.php?page=login&action=confirmLogin&id_confirm=".$idConfirm;
				$fichier = "";
				if(sendEmail($email,$sujet,$mess,$fichier) && logEmail($idConfirm,$email)){
					$message = "Un email de confirmation vous a été envoyer par email sur votre adresse de l'IUT.";
				}
				else{//Erreur
					$message = "Une erreur s'est produite. Veuillez recommencez ultérieurement.";
				}
			}
			else{
				$message = "Email invalide. Cette application est réservée au menbre de l'IUT disposant d'une adresse email valide.";
			}
			include_once(CHEMIN_VIEW."/messRedirection.php");
			break;
		case "confirmLogin":
			require_once(CHEMIN_MODEL."/loginModel.php");
			require_once(CHEMIN_MODEL."/usersModel.php");
			require_once(CHEMIN_MODEL."/groupsModel.php");
			if(isset($_REQUEST['id_confirm'])){
				//Si la confirmation est un succès
				$confirm = verifConfirm($_REQUEST['id_confirm']);
				if($confirm != FALSE){
					//Sélection du groupe d'attribution
					$group = getNumberOfUserPerGroups();//Retourne un tableau de la forme : [id_group]=>NbreDeMenbres
					$groupDistinct = group_getDistinct();//Retourne un tableau contenant tout les id_group distinct
					foreach ($groupDistinct as $value) {
						if(!isset($group[$value['id_group']])){
							$group[$value['id_group']]=0;//On associe 0 Menbres aux groups qui ne possèdent pas de menbres
						}
					}
					asort($group);//On tri l'array obtenu pour mettre celui qui possède le moins de menbres en première position
					$groupId = array_keys($group);//Permet d'obtenir les clés de l'array, cad les id_group
					$selectedGroup = $groupId[0];//On sélection celui qui a le moins de menbre
					//Mise à jour du statut
					$updatedStatus = updateStatusConfirm($confirm['id_users_authorized']);
					if($updatedStatus){
						//Création de l'utilisateur utilisateur 
						user_add($confirm['id_users_authorized'],$confirm['lastname'],$confirm['firstname'],$confirm['email'],$selectedGroup,$uid);
						//Redirection JS
						$url = "https://www.facebook.com/pages/3S/358542484156862?sk=app_311576688896685";
						$time = 2000;
						$message = "Authentification réussi ! Redirection...";
						//$script = "<script>window.setTimeout(\"location=('".$url."');\",".$time.");</script>";
					}
					else{
						$message = "Erreur : Cette email a déjà été valider sur un compte FB.";
					}
				}
				else{
					$message = "2C'est pas bien d'essayer de modifier l'url... ";
				}
			}
			else{
				$message = "C'est pas bien d'essayer de modifier l'url... ";
			}
			include_once(CHEMIN_VIEW."/messRedirection.php");
			break;
		//Erreur 404
		default:
			include_once(CHEMIN_VIEW."/404.php");
			break;
	}
?>