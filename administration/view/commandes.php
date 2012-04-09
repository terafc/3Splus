<div class="menuleft">
	<div class="textmenuleft">
		<b class="titremenuleft">
			<u>Groupes</u>
		</b>
		<br />
		<?php foreach ($groups as $name => $group){ ?>
		<u><?php echo $name; ?></u>
		<?php } ?>
	</div>
</div>
<div class="tableaux">	
<?php foreach ($groups as $name => $group){ ?>
	<div class="margecadre">
		<b>Groupe: <span class="colorPink"><?php echo $name; ?></span></b>
		<b>Porteur: <span class="colorBlue"><?php echo $group['carrier']['nom'].' '.$group['carrier']['prenoms']; ?></span></b>
		<b>N° d'etudiant: <?php echo $group['carrier']['id_user']; ?></b>
		
		<form method="POST", action='<?php echo $validate_url ?>'>
			<input type='hidden' name='id_grp_cmd' value='<?php echo $group['id_group']; ?>'>
			<input type='submit' name='cmdvalider' value='Valider la commande' class="floatRight">
		</form>
		<table class='groupe'>
			<tr>
				<th class='cadrehead'>Membres</th>
			</tr>
			<tr>
				<td>
					<table>
						<tr>
							<th>Nom</th>
							<th>Prenom</th>
							<th>Id</th>
						</tr>
					<?php foreach($group['users'] as $id_user => $user){?>
						<tr>
							<td><?php echo $user['nom'];?></td>
							<td><?php echo $user['prenoms'];?></td>
							<td><?php echo $id_user;?></td>
						</tr>
					<?php } ?>
					</table>
				</td>
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
					<?php foreach($group['product'] as $product){
						if(!(strpos($product['category'],'sandwich')===false)){
					?>
						<tr>
							<td><?php echo $product['name'];?></td>
							<td><?php echo $product['sauce'];?></td>
							<td><?php echo $product['amount'];?></td>
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
					<?php foreach($group['product'] as $product){
						if(strpos($product['category'],'sandwich')===false){
					?>
						<tr>
							<td><?php echo $product['name'];?></td>
							<td><?php echo $product['amount'];?></td>
						</tr>
					<?php } 
					}
					?>
					</table>
				</td>
			<tr>
		</table>
	</div>
<?php }?>
</div>
