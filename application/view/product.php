<?php
	//Permet de créer la balise image d'un produit
	function getImageProduct($value){
		$alt = "Image Produit";
		$title = empty($value['description']) ? "Aucune description disponible.":$value['description'];
		if(is_file(CHEMIN_IMG."/product/".$value['name'].".png")){
			$src = HTTP_IMG."/product/".$value['name'].".png";
			$img = "<img src=\"".$src."\" alt=\"".$alt."\" title=\"".$title."\"/>";
		}
		else{
			$src = HTTP_IMG."/Point_interrogation.png";
			$img = "<img src=\"".$src."\" alt=\"".$alt."\" title=\"".$title."\"/>";
		}
		return $img;
	}
?>

<?php
	if(isset($message)){echo "<div>".$message."</div>";}//Affichage du message si existe
	//On affiche chaque catégorie de produit
	foreach($product as $productListe){?>
		<div class="categoryContainer">
			<h3 class='titleCategory'><?php echo ucfirst(strtolower($productListe['name_category']));?></h3>
			<?php //On supprime cette entrée pour éviter de créer un produit inexistant à cause du foreach suivant
				unset($productListe['name_category']);
				if(!isset($productListe[0])){?><!--Si n'est pas défini, alors il n'y a pas de produits-->
				<span>Aucun produit disponible dans cette catégorie.</span>
			<?php }else{
				foreach($productListe as $key=>$value){?>
					<div class="productSelect">
						<form method="POST" action="<?php echo HTTP_INDEX;?>?page=product&action=add">
							<div class="productName bold"><?php echo ucfirst(strtolower($value['name']));?></div>
							<div class="imageProduct">
								<?php
									//On affiche l'image si elle existe, sinon on affiche une image par défaut
									$getImg = getImageProduct($value);
									echo $getImg;
								?>
							</div>
							<div class="productDetail">
								<div>Prix : <?php echo $value['price'];?> €</div>
								<?php
									//On affiche les sauces uniquement si il s'agit d'un sandwich
									if($_REQUEST['what']=='sandwich'){?>
										<div>
											Sauce : <br/>
											K<input class="inlineBlock" type="checkbox" name="sauce[]" value="k" />&nbsp;
											M<input class="inlineBlock" type="checkbox" name="sauce[]" value="m" />&nbsp;
											P<input class="inlineBlock" type="checkbox" name="sauce[]" value="p" />
										</div>
									<?php }
								?>
								<div>
									<input type="hidden" name="what" value="<?php echo $_REQUEST['what'];?>"/>
									<input type="hidden" name="id_product" value="<?php echo $value['id_product'];?>"/>
									<input class="addProduct" type="submit" value="Ajouter"/>
								</div>
							</div>
						</form>	
					</div>
				<?php } 
			} ?>
		</div>
	<?php }
?>