<!DOCTYPE html>
<html>
	<head>
		<title>3S+</title>
		<meta charset="UTF-8"/>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/> 
		<link rel="shortcut icon" href="<?php echo HTTP_IMG;?>/favicon.ico">
		<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS;?>/design.css"/>
		<script src="<?php echo HTTP_JS;?>/jquery-1.7.1.min.js" type="text/javascript"></script>
	</head>
	<body>
	    <div id ="header2">
			<div class="clearBoth">
				<div id="headLeft">
					<img class="inlineBlock" alt="Logo" src="<?php echo HTTP_IMG;?>/Logo.png">
					<div class="inlineBlock verticalAlignB">
						<span class="bold">
							<span class="colorBlue">B</span>outique
						</span>
					</div>
				</div>
				<div id="headRight">
					<div id="infoCarrier">
						<span class="bold">Nom : </span><span><?php echo $userCurrentInfo['lastname'];?></span>
						<br/>
						<span class="bold">Prénom : </span><span><?php echo $userCurrentInfo['firstname'];?></span>
						<br/>
						<span class="bold">Groupe : </span><span><?php echo $userCurrentInfo['name'];?></span>								
					</div>
					<div id="infoShop">
						<table id="headInfoTable">
							<tr>
								<td class="headInfoTd">
									<span class="alignCenter verticalAlignM"><?php echo $userCurrentInfo['point'];?> Points</span>
									<img class="inlineBlock alignCenter verticalAlignM" alt="Star" src="<?php echo HTTP_IMG;?>/Star.png">
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<hr/>
	    <div id="main">
			<?php if($carrierInfo==FALSE){?>
				<p class="alignCenter">Aucune commande enregistrée pour aujourd'hui...</p>
			<?php }
			else{?>
				<h2 class="alignCenter underline">Récapitulif du porteur des Commandes :</h2>
				<br/>
				<table class="alignLeft marginCenter">
					<tr>
						<th class="panierTh">ID Commandes :</th>
						<td class="panierTd"><?php echo $id_order;?></td>
					</tr>
					<tr>
						<th class="panierTh">Nom :</th>
						<td class="panierTd"><?php echo $carrierInfo['lastname'];?></td>
					</tr>
					<tr>
						<th class="panierTh">Prénom :</th>
						<td class="panierTd"><?php echo $carrierInfo['firstname'];?></td>
					</tr>
					<tr>
						<th class="panierTh">Groupe :</th>
						<td class="panierTd"><?php echo $carrierInfo['name'];?></td>
					</tr>
					<tr>
						<th class="panierTh">Email :</th>
						<td class="panierTd"><?php echo $carrierInfo['email'];?></td>
					</tr>
				</table>
				<br/>
			<?php } ?>
	    </div>
		<hr/>
		<div id="footer">
		 	<span class="italic">3SPlus vous est proposé par les étudiants de la promotion RT2 2011/2012 du TP n°3</span>
		 	<br/>
			<span class="italic">| Copyright 2012 |</span><br/>
			<a href="http://www.iut-lareunion.fr/">IUT de la Réunion</a>&nbsp;
			<a href="http://www.univ-reunion.fr/">Université de la Réunion</a> &nbsp;
		</div>  
	</body>
</html>  