<div class="tableaux">	
	<div class="margecadre">
		<form method="POST", action='<?php echo $validate_url ?>'>
			<input type='hidden' name='id_order' value='<?php echo $id_order; ?>'>
			<input type='submit' name='cmdvalider' value='Valider la commande' class="floatRight">
		</form>
		<table class='groupe'>
			<tr>
				<th class='cadrehead'>Sandwichs</th>
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<th>Nom</th>
							<th>Sauce</th>
							<th>Quantite</th>
						</tr>
					<?php foreach($products as $product){
						if(!(strpos($product['category'],'sandwich')===false)){
					?>
						<tr>
							<td><?php echo $product['name'];?></td>
							<td><?php echo $product['sauce'];?></td>
							<td><?php echo $product['qtt'];?></td>
						</tr>
					<?php } 
					}
					?>
					</table>
				</td>
			<tr>
			<tr>
				<th class='cadrehead'>Autres</th>
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<th>Nom</th>
							<th>Quantite</th>
						</tr>
					<?php foreach($products as $product){
						if(strpos($product['category'],'sandwich')===false){
					?>
						<tr>
							<td><?php echo $product['name'];?></td>
							<td><?php echo $product['qtt'];?></td>
						</tr>
					<?php } 
					}
					?>
					</table>
				</td>
			<tr>
		</table>
	</div>
</div>
