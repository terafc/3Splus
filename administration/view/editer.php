<div>
	<?php
		$Cat=array("Sandwich chaud","Sandwich froid","Vienoiserie","Salade","Glace","Boisson");
	?>
	
	<div>
		<table class="borduressousonglets">
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
						Veuillez entrer le nom du produit:
					</td>
					<td>
						<br />
						<div class="choix">
							<input type="text" />
							<br />
						</div>
					</td></tr>
					<tr><td>
						Veuillez entrer la description du produit:
					</td>
					<td>
						<br />
						<div class="choix">
							<textarea rows="10" cols="20" name="description">Description:</textarea>
							<br />
						</div>
					</td></tr>
					<tr><td>
						Veuillez choisir la categorie du produit:
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
						Veuillez entrer le prix produit:
					</td>
					<td>
						<br />
						<div class="choix">
							<input type="text" />€
							<br />
						</div>
					</td></tr>
					<tr><td>
						Validez pour créer le produit:
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