<div>
	<?php
		$Produit=array("Pain bouchon","Miam miam","Pains chaud","1.5");
	?>
	
	<div>
		<table>
			<tr>
				<td class="sousonglets sousongletsimpaires" ><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show_edit">Editer prod.</a></td>
				<td class="sousonglets sousongletspaires"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show_ajout_groupe">Modifier prod.</a></td>
				<td class="sousonglets sousongletsimpaires"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show_ajout_categorie">Editer groupe</a></td>
				<td class="sousonglets sousongletsimpaires"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show_modif_groupe">Editer categorie</a></td>
				<td class="sousonglets sousongletspaires"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show_modif_categorie">Modifier categorie</a></td>
			</tr>
		</table>
		
		<div class="margintop85">
			<form method="POST" action="">
				<table class="creer">
					<tr><td>
						Nom du produit:
					</td>
					<td>
						<br />
						<div class="choix">
							<input type="text" name="nom_produit" value="<?php echo $Produit[0]?>"/>
							<br />
						</div>
					</td></tr>
					<tr><td>
						Description du produit:
					</td>
					<td>
						<br />
						<div class="choix">
							<textarea rows="10" cols="20" name="description"><?php $Produit[1]?></textarea>
							<br />
						</div>
					</td></tr>
					<tr><td>
						Categorie du produit:
					</td>
					<td>
						<br />
						<div class="choix">
							<select name="categorie">
								<?php 
									foreach($Cat as $kt){
										echo '<option value="'.$kt.'">'.$kt.'</option>';
									}
								?>
							</select>
							<br />
						</div>
					</td></tr>
					<tr><td>
					<tr><td>
						Prix produit:
					</td>
					<td>
						<br />
						<div class="choix">
							<input type="text" name="prix" value="<?php echo $Produit[3] ?>"/>€
							<br />
						</div>
					</td></tr>
					<tr><td>
						Validez pour modifier le produit:
					</td>
					<td>
						<br />
						<div class="choix">
							<input type="submit" value="Creer"/>
							<br />
						</div>
					</td></tr>
				</table>
			</form>
		</div>
		
	</div>
</div>