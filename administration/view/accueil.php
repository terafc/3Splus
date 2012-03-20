<?php
	echo "Groupe: ";
	echo "Porteur: ";
	echo "N° d'etudiant: ";
	echo "N° Commande: ";
	echo "
		<form methode=POST, action=''>
		<input type='checkbox' name='cmdvalider'>";
	
	echo"
	<table class='groupe'>
		<tr>
		<th class='cadre'>Sandwichs</th>
		<th class='cadre'>K</th>
		<th class='cadre'>M</th>
		<th class='cadre'>P</th>
		<th class='cadre'>Boisson</th>
		<th class='cadre'>Nom et Prenom</th>
		<th class='cadre'>N°etd</th>
		<th class='cadre'>N° Comm.</th>
	";
		/*foreach ($variable as $key => $value) {
			echo "<td> </td>";
		}*/
			
		echo"
		</tr>
	</table>
	";
	
?>