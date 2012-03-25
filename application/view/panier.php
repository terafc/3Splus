<div>
	<span class="bold">
		<span class="colorBlue">P</span>anier
	</span>
</div>
<hr/>
<br/>
<?php if(!empty($order)){?>
	<div class="alignCenter">
		<form method="POST" action="<?php echo HTTP_INDEX."?page=order&action=editAmount";?>">
			<table id="panierTable">
				<tr>
					<th class="panierTh alignCenter">Produit</th>
					<th class="panierTh alignCenter">Quantité</th>
					<th class="panierTh alignCenter">Prix</th>
				</tr>
				<?php 
					$i=0;
					foreach ($order as $value) {
						$sauce = empty($value['sauce']) ? " - " : " ".$value['sauce']." ";
						?>
						<tr>
							<td class="panierTd alignLeft">
								<?php echo ucfirst(strtolower($value['name']))." (".$sauce.")";?>
								<input type="hidden" value="<?php echo $value['sauce'];?>" name="sauce<?php echo $i;?>"/>
							</td>
							<td class="panierTd alignCenter"><input class="inputAmountPanier alignRight" type="text" name="amount<?php echo $i;?>" value="<?php echo $value['amount'];?>"/></td>
							<td class="panierTd alignRight"><?php echo $value['price'];?> €</td>
							<td class="panierTd alignCenter cursorPointer"><a href = "<?php echo HTTP_INDEX."?page=order&action=delete&id_product=".$value['id_product']."&sauce=".$value['sauce'];?>">Supprimer</a></td>
						</tr>
					<?php 
						$i++;
					}?>
				<tr>
					<td colspan="4" class="panierTd alignCenter bold">Montant Total : <?php echo $totalPrice;?> €</td>
				</tr>
			</table>
			<br/>
			<div class="inlineBlock actualizePanier">
				<input type="submit" value="Actualiser"/>
			</div>
		</form>
		Et
		<br/>
		<div class="inlineBlock confirmPanier">
			<form method="POST" action="<?php echo HTTP_INDEX."?page=order&action=confirm";?>">
				<input type="submit" value="Payer"/>
			</form>
		</div>
	</div>
	<br/>
	<div class="infoOrder alignCenter">/!\ Veuillez actualiser votre panier avant de confirmer si vous avez modifié des quantités de produit ! /!\</div>
<?php }else{echo "<div class='alignCenter'>Panier vide !</div>";}
