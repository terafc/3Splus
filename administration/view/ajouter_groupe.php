<div>

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
					Veuillez entrer le nom du groupe:
				</td>
				<td>
					<br />
					<div class="choix">
						<input type="text" name="nom_grp"/>
						<br />
					</div>
				</td></tr>
				<tr><td>
					Validez pour créer le groupe:
				</td>
				<td>
					<br />
					<div class="choix">
						<input type="submit" value="Creer_groupe"/>
						<br />
					</div>
				</td></tr>
			</table>
		</form>
	</div>
	
</div>
</div>