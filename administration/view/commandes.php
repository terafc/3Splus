<?php
	$CMD[0]=array("Bouchon Gratine","K", "Fanta 50cl","DIJOUX", "Marc","3100263");
	$CMD[1]=array("Americain Poulet","M", "Coca 50cl","NANDJAN", "Clement","3000302");
	$CMD[2]=array("Americain Jambon","P", "Edena 1l","RETHORE","Sof", "3100325");
	$CMD[3]=array("Americain nature","KP", "Sprite 50cl", "MARCOZ", "Francel", "3000254");
	$Numcmd="026256";
	$NomGroupe="Roti Porc";
	$Porteur="DIJOUX Marc";
	$NumetdPorteur="3100263"
?>

<table class="menuleft">
	<tr>
		<td class="textmenuleft"><b class="titremenuleft"><u>
			Groupes</u></b>
		<br />
		<u><?php echo $NomGroupe
			?></u></td>
	</tr>
</table>
<?php for($n=0;$n<3;$n++){
?>
<div class="margecadre">
	<b>Groupe: <span class="colorPink"><?php echo $NomGroupe
		?></span> </b>
	<b>Porteur: <span class="colorBlue"><?php echo $Porteur
		?></span> </b>
	<b>N° d'etudiant: <?php echo $NumetdPorteur?></b>
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
		foreach ($CMD as $value) {
			if ($i % 2 == 0) {
				$parite = "cadrepaire";
			}
			else {
				$parite = "cadreimpaire";
			}

			echo "
		<tr class=" . $parite . ">
			";
			echo " <td class='raw col1'><b>" . $value[0] . "</b></td>";
			echo " <td class='raw'></td>";
			echo " <td class='raw'></td>";
			echo " <td class='raw'></td>";
			echo " <td class='raw'><b>" . $value[2] . "</b></td>";
			echo " <td class='raw'><b>" . $value[4] . " " . $value[3] . "</b></td>";
			echo " <td class='raw'>" . $value[5] . "</td>";
			echo " <td class='raw'>" . $Numcmd . "-" . $value[5];
			echo "
		</tr>
		";
			$i++;
		}
		?>
		<form methode=POST, action=''>
			<input type='submit' name='cmdvalider' value='Valider la commande' class="floatRight">
		</form>
	</table>
</div>
<?php }?>