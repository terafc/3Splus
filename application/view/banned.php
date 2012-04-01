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
	    	<h2>Bienvenue <?php echo $userCurrentInfo['lastname']." ".$userCurrentInfo['firstname'];?>,</h2>
	    	<h3>Nous avons le regret de vous informer que vous avez été banni du site</h3>
	    	<p>Pour avoir manquer trop souvent à l'appel, lors de la réception des commandes qui vous ont été attribuées, vous ne pourrez plus utiliser notre application.</p>
	   		<p>Si vous souhaitez lever ce bannissement pour des raisons valables, veuillez contacter l'administrateur.</p>
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