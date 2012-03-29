<?php
	/*******************************************************************
	 * On définit les fonctions qui se répèteront dans le controlleur. *
	 *******************************************************************/
	
	//Permet de construire le début de l'URL néccessaire pour Paypal
	function construit_url_paypal() {
		$api_paypal = 'https://api-3t.sandbox.paypal.com/nvp?'; // Site de l'API PayPal. On ajoute déjà le ? afin de concaténer directement les paramètres.
		$version = 57.0; // Version de l'API
		$user = 's.rivi_1332666193_biz_api1.rt-iut.re'; // Utilisateur API
		$pass = '1332666218'; // Mot de passe API
		$signature = 'AqfwB6lKOiNmQhTnsqVexnYxhbl1An57U3veOhNFQMZsVbLZagXwNtKF'; // Signature de l'API
		$api_paypal = $api_paypal.'VERSION='.$version.'&USER='.$user.'&PWD='.$pass.'&SIGNATURE='.$signature; // Ajoute tous les paramètres
		return 	$api_paypal; // Renvoie la chaîne contenant tous nos paramètres.
	}
	
	//Permet de mettre en forme les données renvoyer par Paypal
	function recup_param_paypal($resultat_paypal){
		$liste_parametres = explode("&",$resultat_paypal); // Crée un tableau de paramètres
		foreach($liste_parametres as $param_paypal){ // Pour chaque paramètre
			list($nom, $valeur) = explode("=", $param_paypal); // Sépare le nom et la valeur
			$liste_param_paypal[$nom]=urldecode($valeur); // Crée l'array final
		}
		return $liste_param_paypal; // Retourne l'array
	}
?>

<?php
	switch($action){
		//Cas où l'utilisateur clique pour payer la commande.
		//On effectue la première requête curl pour demander un paiement à Paypal
		case 'paypal':
			confirm_order($_SESSION['id_order']);
			$requete = construit_url_paypal();//Début dé la construction de la requête paypal
			//On défini les différents paramètres de la requête.
			$requete = $requete."&METHOD=SetExpressCheckout".
						"&CANCELURL=".urlencode(HTTP_INDEX).//URL de retour en cas d'annulation
						"&RETURNURL=".urlencode(HTTP_INDEX).//URL de retour en cas de confirmation
						"&AMT=".floatval($totalPrice).//Prix total
						"&CURRENCYCODE=EUR".//Devise
						"&DESC=".urlencode("Reservation de commande sur 3S+").//Description
						"&LOCALECODE=FR".//Code local FRANCAIS
						"&HDRIMG=".HTTP_IMG."/rt.jpg";//Image afficher dans paypal
			
			$ch = curl_init($requete);// Initialise notre session cURL. On lui donne la requête à exécuter
			
			// Modifie l'option CURLOPT_SSL_VERIFYPEER afin d'ignorer la vérification du certificat SSL. 
			// Si cette option est à 1, une erreur affichera que la vérification du certificat SSL a échoué, et rien ne sera retourné.
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			// Retourne directement le transfert sous forme de chaîne de la valeur retournée par curl_exec() au lieu de l'afficher directement.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			$resultat_paypal = curl_exec($ch);// On lance l'exécution de la requête URL et on récupère le résultat dans une variable
			
			if (!$resultat_paypal){// S'il y a une erreur, on affiche le détail de l'erreur.
				$message = "<p>Erreur</p><p>".curl_error($ch)."</p>";
			}
			else{// S'il s'est exécuté correctement, on effectue les traitements...
				$liste_param_paypal = recup_param_paypal($resultat_paypal); //Dispatche le résultat obtenu par curl en un array
				
				if ($liste_param_paypal['ACK'] == 'Success'){// Si la requête a été traitée avec succès
					// Redirige le visiteur sur le site de PayPal
					header("Location: https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=".$liste_param_paypal['TOKEN']);
			        exit();
				}
				else{ // En cas d'échec, affiche la première erreur trouvée.
					$message = "<p>Erreur de communication avec le serveur PayPal.<br />".$liste_param_paypal['L_SHORTMESSAGE0']."<br />".$liste_param_paypal['L_LONGMESSAGE0']."</p>";
				}		
			}
			// On ferme notre session cURL.
			curl_close($ch);
			include_once(CHEMIN_VIEW."/messRedirection.php");
			break;
		//Page de retour si un utilisateur annule sa commande lorsqu'il est dans paypal.
		case 'cancelPaypal':
			$message = "<h1>Paiement annulé</h1>";
			$message .= "<p>Le paiement a été annulé. En espérant que vous changerez rapidement d'avis, nous vous adressons nos salutations les plus sincères, Pov' type va !.</p>";
			include_once(CHEMIN_VIEW."/messRedirection.php");
			break;
		//Page de retour lorsqu'un utilisateur valide un paiement sur paypal
		case 'returnPaypal':
			require_once(CHEMIN_MODEL."/ordersModel.php");
			
			$requete = construit_url_paypal(); // Construit les options de base
			//On défini les différents paramètres de la requête.
			$requete = $requete."&METHOD=DoExpressCheckoutPayment".
						"&TOKEN=".htmlentities($_GET['token'], ENT_QUOTES).// Ajoute le jeton qui nous a été renvoyé
						"&AMT=".floatval($totalPrice).//Montant total
						"&CURRENCYCODE=EUR".//Devise
						"&PayerID=".htmlentities($_GET['PayerID'], ENT_QUOTES).// Ajoute l'identifiant du paiement qui nous a également été renvoyé
						"&PAYMENTACTION=sale";
			
			$ch = curl_init($requete);// Initialise notre session cURL. On lui donne la requête à exécuter.
			
			// Modifie l'option CURLOPT_SSL_VERIFYPEER afin d'ignorer la vérification du certificat SSL. 
			// Si cette option est à 1, une erreur affichera que la vérification du certificat SSL a échoué, et rien ne sera retourné. 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			// Retourne directement le transfert sous forme de chaîne de la valeur retournée par curl_exec() au lieu de l'afficher directement. 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			$resultat_paypal = curl_exec($ch);// On lance l'exécution de la requête URL et on récupère le résultat dans une variable
			
			if (!$resultat_paypal){ // S'il y a une erreur, on affiche le détail de l'erreur.
				$message = "<p>Erreur</p><p>".curl_error($ch)."</p>";
			}
			else{// S'il s'est exécuté correctement, on effectue les traitements...
				$liste_param_paypal = recup_param_paypal($resultat_paypal); //Dispatche le résultat obtenu par curl en un array

				if ($liste_param_paypal['ACK'] == 'Success'){// Si la requête a été traitée avec succès
					if(confirm_order($_SESSION['id_order'])){//On essai de sauvegarder le paiement en BDD
						header('Location: '.HTTP_INDEX.'?page=order&action=order&message=confirm'); //Redirection vers l'onglet commande
						exit();
					}
					else{
						$message = "Erreur : Impossible d'enregistrer le paiement de la commande...";
					}
				}
				else{ // En cas d'échec, affiche la première erreur trouvée.
					$message = "<p>Erreur de communication avec le serveur PayPal.<br />".$liste_param_paypal['L_SHORTMESSAGE0']."<br />".$liste_param_paypal['L_LONGMESSAGE0']."</p>";
				}
			}
			
			curl_close($ch);// On ferme notre session cURL.
			
			include_once(CHEMIN_VIEW."/messRedirection.php");//Pour affiche rle message d'erreur
			break;
		default:
			include_once(CHEMIN_VIEW."/404.php");
			break;
	}
?>