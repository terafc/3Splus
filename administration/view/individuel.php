<?php
	
	$CMD[0]=array("Bouchon Gratine","K", "Fanta 50cl","DIJOUX", "Marc","3100263","123456");
	$CMD[1]=array("Americain Poulet","M", "Coca 50cl","NANDJAN", "Clement","3000302","123457");
	$CMD[2]=array("Americain Jambon","P", "Edena 1l","RETHORE","Sof", "3100325","123458");
	$CMD[3]=array("Americain nature","KP", "Sprite 50cl", "MARCOZ", "Francel", "3000254","123459");
	$CMD[4]=array("Crudite Jambon","KM", "Sambo 33cl", "RIVIERE", "Serge", "3000255","123460");
	
	function get_url_validate_by_gid($Gid){
		return HTTP_INDEX.'?page=product&action=validate&id='.$Iid;//Iid=Id individuel
	}
?>

<div class="tableauindiv">

	<div class="margecadre">
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
				<th class='cadrehead'>Valider Comm.</th>
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
				if(strcspn('K',$value[1])==0){
					echo " <td class='raw ketchup'></td>";
				}else{
					echo " <td class='raw'></td>";
				}
				if(strcspn('M',$value[1])==0){
					echo " <td class='raw mayo'></td>";
				}else{
					echo " <td class='raw'></td>";
				}
				if(strcspn('P',$value[1])==0){
					echo " <td class='raw piment'></td>";
				}else{
					echo " <td class='raw'></td>";
				}//*/
				echo " <td class='raw'><b>" . $value[2] . "</b></td>";
				echo " <td class='raw'><b>" . $value[4] . " " . $value[3] . "</b></td>";
				echo " <td class='raw'>" . $value[5] . "</td>";
				echo " <td class='raw'>". $value[6];
				?>
				<td>
					<form methode=POST, action='<?php echo get_url_validate_by_gid($groupe['num_cmd']) ?>'>
						<input type='submit' name='cmdvalider' value='Valider la commande' class="floatRight">
					</form>
				</td>
			</tr>
			<?php
				$i++;
			}
			?>
			

		</table>
	</div>

</div>
