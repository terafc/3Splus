<?php
	$CMD[0]=array("Bouchon Gratine", "Fanta 50cl","DIJOUX", "Marc","3100263");
	$CMD[1]=array("Americain Poulet", "Coca 50cl","NANDJAN", "Clement","3000302");
	$CMD[2]=array("Americain Jambon", "Edena 1l","RETHORE","Sof", "3100325");
	$CMD[3]=array("Americain nature", "Sprite 50cl", "MARCOZ", "Francel", "3000254");
	$Alaphabet=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$Numcmd="026256";
?>
	<b>Groupe: <span class="colorPink">Roti Porc</span> </b>
	<b>Porteur: <span class="colorBlue">DIJOUX Marc</span> </b>
	<b>N° d'etudiant: 3100263 </b>

		
	
	
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
	$i=0;
	foreach ($CMD as $value) {
		if($i%2==0){
			$parite="cadrepaire";
		}else{
			$parite="cadreimpaire";
		}
		echo "<tr class=".$parite.">";
		echo "	<td class='raw'>".$value[0]."</td>";
		echo "	<td class='raw'></td>";
		echo "	<td class='raw'></td>";
		echo "	<td class='raw'></td>";
		echo "	<td class='raw'>".$value[1]."</td>";
		echo "	<td class='raw'>".$value[3]." ".$value[2]."</td>";
		echo "	<td class='raw'>".$value[4]."</td>";
		echo "	<td class='raw'>".$Numcmd."-".$value[4];
		echo "</tr>";
		$i++;
	}
?>

	<form methode=POST, action=''>
		<input type='submit' name='cmdvalider' value='Valider la commande'>
		</form>
	</table>