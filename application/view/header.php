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
	    <div id ="header">
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
						<span class="bold">Nom : </span><span><?php echo $_SESSION['user']['lastname'];?></span>
						<br/>
						<span class="bold">Prénom : </span><span><?php echo $_SESSION['user']['firstname'];?></span>
						<br/>
						<span class="bold">Groupe : </span><span><?php echo $_SESSION['user']['name'];?></span>								
					</div>
					<div id="infoShop">
						<table id="headInfoTable">
							<tr>
								<td class="headInfoTd">
									<span class="alignCenter verticalAlignM"><?php echo $_SESSION['user']['point'];?> Points</span>
									<img class="inlineBlock alignCenter verticalAlignM" alt="Star" src="<?php echo HTTP_IMG;?>/Star.png">
								</td>
								<td class="headInfoTd cursorPointer">
									<a href="<?php echo HTTP_INDEX;?>?page=order&action=order"><span class="colorBlue"><?php echo $nbrOrder;?></span> Commande</a>
								</td>
								<td class="headInfoTd cursorPointer">
									<a href="<?php echo HTTP_INDEX;?>?page=order&action=panier">Panier : <span class="colorBlue"><?php echo $totalPrice;?> €</span></a>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div id="menu" class="clearBoth">
				<table id="menuTable">
					<tr>
						<td class="menuTd" onmouseover="$(this).addClass('menuTdHover');" onmouseout="$(this).removeClass('menuTdHover');"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show&what=sandwich">Sandwich</a></td>
						<td class="menuTd" onmouseover="$(this).addClass('menuTdHover');" onmouseout="$(this).removeClass('menuTdHover');"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show&what=viennoiserie Et Chocolat">Viennoiserie & Chocolat</a></td>
						<td class="menuTd" onmouseover="$(this).addClass('menuTdHover');" onmouseout="$(this).removeClass('menuTdHover');"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show&what=salade">Salade</a></td>
						<td class="menuTd" onmouseover="$(this).addClass('menuTdHover');" onmouseout="$(this).removeClass('menuTdHover');"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show&what=glace">Glace</a></td>
						<td class="menuTd" onmouseover="$(this).addClass('menuTdHover');" onmouseout="$(this).removeClass('menuTdHover');"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show&what=boisson">Boisson</a></td>
					</tr>
				</table>
			</div>	
		</div>
		<hr/>
	    <div id="main">