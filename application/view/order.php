<?php
	//On vérifie si il y a un message de confirmation
	if(isset($message)){
		echo "<div class='alignCenter bold'>".$message."</div>";
	}
?>
<div>
	<span class="bold">
		<span class="colorBlue">C</span>ommande Journalière (Payé)
	</span>
</div>
<hr/>
<br/>
<?php 
	if(!empty($orders)){
		foreach($orders as $cle => $valeur){?>
			<div class="alignCenter">
				<span class="bold"><span class="colorBlue">I</span>D <span class="colorBlue">C</span>ommande : <?php echo $cle;?></span>
				<table id="panierTable">
					<tr>
						<th class="panierTh alignCenter">Produit</th>
						<th class="panierTh alignCenter">Quantité</th>
						<th class="panierTh alignCenter">Prix</th>
					</tr>
					<?php 
						foreach ($orders[$cle] as $key => $value) {
							if(!is_int($key)){continue;}//On continue car il ne s'agit pas d'un produit
							$sauce = empty($value['sauce']) ? " - " : " ".$value['sauce']." ";?>
							<tr>
								<td class="panierTd alignLeft"><?php echo ucfirst(strtolower($value['name']))." (".$sauce.")";?></td>
								<td class="panierTd alignRight"><?php echo $value['amount'];?></td>
								<td class="panierTd alignRight"><?php echo $value['price'];?> €</td>
							</tr>
					<?php } ?>
					<tr>
						<td colspan="4" class="panierTd alignCenter bold">Montant Total : <?php echo $valeur['total'];?> €</td>
					</tr>
				</table>
			</div>
			<br/>
	<?php }
	}else{echo "<div class='alignCenter'>Vous n'avez aucune commande validé !</div>";}
?>
