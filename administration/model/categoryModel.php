<?php
	//Obtenir la liste des catégories :
	function get_all_cat(){
		$bdd = Database3Splus::getinstance();//connexion();
		$req = "SELECT * FROM category";
		$result = $bdd->prepare($req);
		$result->execute();
		$cat = $result->fetchAll();//Récupère la première colonne depuis la ligne suivante d'un jeu de résultats
		if(!empty($cat)){
			$catTri = array();
			foreach($cat as $value){
				$catTri[$value['id_category']]=$value['name'];
			}
			return $catTri;
		}
		else{
			return FALSE;
		}
	}
?>