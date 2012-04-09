<div class="tableauindiv">

	<div class="margecadre">
		<table class='groupe'>
			<tr>
				<th class='cadrehead'>Commandes</th>
			</tr>
			<?php foreach($users as $id_user => $user){ ?>
			<tr>
				<td>
					<?php echo $user['nom']; ?>	
				</td>
				<td>
					<?php echo $user['prenoms']; ?>	
				</td>
				<td>
					<?php echo $id_user; ?>	
				</td>
				<td>
					<table>
					<?php foreach($user['id_order'] as $id_order){ ?>
					<tr><td>
					<form method='POST' action='<?php echo $validate_url; ?>'>
						<input type='hidden' name='id_order' value=<?php echo $id_order; ?>>
						<input type='submit' name='showcmd' value='Afficher la commande <?php echo $id_order; ?>'>
					</form>
					</td></tr>
					<?php } ?>
					</table>
				</td>
			</tr>
			<?php } ?>
			

		</table>
	</div>

</div>
