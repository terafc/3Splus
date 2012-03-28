<?php
	switch($action){
		//Si on affiche uniquement les produits
		case "show":
			if(isset($_REQUEST['what'])){//Si la variable contenant la catégorie existe
				require_once(CHEMIN_MODEL."/categoryModel.php");
				//On récupère la liste des cat�gories
				$cat = get_all_cat();
				if(!empty($cat)){//Si il n'y a aucune catégorie
					$product=array();
					if($_REQUEST['what'] == "sandwich" || in_array($_REQUEST['what'],$cat)){
						require_once(CHEMIN_MODEL."/productModel.php");
						if($_REQUEST['what'] == "sandwich"){//CAS PARTICULER POUR LES SANDWICH (CHAUD ET FROID)
							$product[]=get_product_by_cat(array_search('sandwich chaud',$cat),'sandwich chaud');//On récupère la liste des produits
							$product[0]['name_category']='sandwich chaud';//On ajoute la catégorie
							$product[]=get_product_by_cat(array_search('sandwich froid',$cat),'sandwich froid');//On récupère la liste des produits
							$product[1]['name_category']='sandwich froid';
						}
						else{//Sinon il s'agit d'une autre cat�gorie existante
							$product[]=get_product_by_cat(array_search($_REQUEST['what'],$cat),$_REQUEST['what']);//On r�cup�re la liste des produits
							$product[0]['name_category']=$_REQUEST['what'];
						}
					}else{$error = "Cette catégorie n'existe pas, ou plus.";}
				}else{$error = "Aucune catégorie n'a été crée !";}
			}else{$error = "C'est pas bien de modifier l'url...";}
			//On v�rifie si il y a eu une erreur
			if(isset($error)){
				$message = $error;
				include_once(CHEMIN_VIEW."/messRedirection.php");
			}
			//Sinon on affiche la vue
			else{
				if(isset($_REQUEST['message'])){$message = $_REQUEST['message'];}//Ajout du message si existe
				include_once(CHEMIN_VIEW."/product.php");
			}
			break;
		//Si on ajoute un produit au panier
		case "add":
			require_once(CHEMIN_MODEL."/productModel.php");
			require_once(CHEMIN_MODEL."/ordersModel.php");
			$what = $_REQUEST['what'];
			//On vérifie si il s'agit d'un cas particulier (sauces pour les sandwichs)
			if($what=='sandwich' && isset($_REQUEST['sauce'])){
				$sauce = implode(',',$_REQUEST['sauce']);//On concatène toutes les sauces avec des virgules
			}
			else{
				$sauce="";//Valeur par défaut sinon
			}
			$id_product = $_REQUEST['id_product'];
			if(verif_product($id_product)){//Si le produit existe réellement
				if(isset($_SESSION['id_order'])){//Si l'utilisateur a déjà un id_order
					$id_order = $_SESSION['id_order'];
				}
				else{//Sinon on lui en crée un
					$id_order = create_id_order($_SESSION['user']['id_user']);
					$_SESSION['id_order']=$id_order;
				}
				if(!add_product_to_order($id_order, $id_product,$sauce)){//Si le produit n'as pas pu être ajouter au panier
					$error = "Impossible d'ajouter le produit au panier !";
				}
			}else{$error = "Le produit demandé n'existe pas !";}
			$message = isset($error) ? $error : "Produit ajouté au Panier !";
			echo $message;
			header('Location: '.HTTP_INDEX.'?page='.$page.'&action=show&what='.$what.'&message='.$message); 
			exit(); 
			break;
		default:
			include_once(CHEMIN_VIEW."/404.php");
			break;
	}
?>