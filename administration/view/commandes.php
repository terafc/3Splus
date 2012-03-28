<?php
	
	$CMD[0]=array("Bouchon Gratine","K", "Fanta 50cl","DIJOUX", "Marc","3100263");
	$CMD[1]=array("Americain Poulet","M", "Coca 50cl","NANDJAN", "Clement","3000302");
	$CMD[2]=array("Americain Jambon","P", "Edena 1l","RETHORE","Sof", "3100325");
	$CMD[3]=array("Americain nature","KP", "Sprite 50cl", "MARCOZ", "Francel", "3000254");
	
	$Numcmd="026256";
	$NomGroupe="Roti Porc";
	$Porteur="DIJOUX Marc";
	$NumetdPorteur="3100263";
	
	$cmds[0]['commandes'] = $CMD;
	$cmds[0]['num_cmd'] = $Numcmd;
	$cmds[0]['nom_grp'] = $NomGroupe;
	$cmds[0]['nom_porteur'] = $Porteur;
	$cmds[0]['num_porteur'] = $NumetdPorteur;
	
	$cmds[1]=$cmds[0];
	function get_url_validate_by_gid($Gid){
		return HTTP_INDEX.'?page=product&action=validate&id='.$Gid;
	}
?>
<div class="menuleft">
	<div class="textmenuleft">
		<b class="titremenuleft"><u>
			Groupes</u></b>
		<br />
		<u><?php echo $NomGroupe; ?></u>
	</div>
</div>
<div class="tableaux">	
<?php foreach ($cmds as $groupe){ ?>
	<div class="margecadre">
		<b>Groupe: <span class="colorPink"><?php echo $groupe['nom_grp']; ?></span></b>
		<b>Porteur: <span class="colorBlue"><?php echo $groupe['nom_porteur']; ?></span></b>
		<b>N° d'etudiant: <?php echo $groupe['num_porteur']; ?></b>
		<table class='groupe'>
			<tr>
				<th class='cadrehead'>Sandwichs</th>
				<th class='cadrehead'>K</th>
				<th class='cadrehead'>M</th>
				<th class='cadrehead'>P</th>
				<th class='cadrehead'>Boisson</th>
				<th class='cadrehead'>Nom et Prenom</th>
				<th class='cadrehead'>N°etd</th>
				<th class='cadrehead'>N° Comm.</th>
			</tr>
			<?php
			$i = 0;
			foreach ($groupe['commandes'] as $value) {
				if ($i % 2 == 0) {
					$parite = "cadrepaire";
				}
				else {
					$parite = "cadreimpaire";
				}
	
			?>
			<tr class=<?php echo $parite; ?> >
				<td class='raw col1'><b> <?php echo $value[0]; ?></b></td>
				<?php if(strcspn('K',$value[1])==0){ ?>
					<td class='raw ketchup'></td>
				<?php }else{ ?>
					<td class='raw'></td>
				<?php } 
				if(strcspn('M',$value[1])==0){ ?>
					<td class='raw mayo'></td>
				<?php }else{ ?>
					<td class='raw'></td>
				<?php }
				if(strcspn('P',$value[1])==0){ ?>
					<td class='raw piment'></td>
				<?php }else{ ?>
					<td class='raw'></td>
				<?php } ?>
				<td class='raw'><b> <?php echo $value[2]; ?></b></td>
			        <td class='raw'><b> <?php echo $value[4]." ".$value[3]; ?></b></td>
				<td class='raw'> <?php echo $value[5]; ?> </td>
				<td class='raw'> <?php echo $groupe['num_cmd']. "-" . $value[5]; ?>
			</tr>
			<?php $i++; 
			}
			?>
			<form methode=POST, action='<?php echo get_url_validate_by_gid($groupe['num_cmd']) ?>'>
				<input type='submit' name='cmdvalider' value='Valider la commande' class="floatRight">
			</form>

		</table>
	</div>
<?php }?>
</div>
