<!DOCTYPE html>
<html>
	<head>
		<title>3S+</title>
		<meta charset="UTF-8"/>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/> 
		<link rel="stylesheet" type="text/css" href="<?php echo HTTP_CSS;?>/design.css"/>
		<script src="<?php echo HTTP_JS;?>/jquery-1.7.1.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo HTTP_JS;?>/function.js"></script>
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
						<span class="bold">N° de la commande : </span><span class="toReplace">ID</span>
						<br/>
						<span class="bold">Porteur : </span><span class="toReplace">NOM_PRENOM_ID</span>
						<br/>
						<span class="bold">Groupe : </span><span class="toReplace">NOM</span>								
					</div>
					<div id="infoShop">
						<table id="headInfoTable">
							<tr>
								<td class="headInfoTd">
									<span class="alignCenter verticalAlignM"><?php //echo $_SESSION['user']['point'];?> Points</span>
									<img class="inlineBlock alignCenter verticalAlignM" alt="Star" src="<?php echo HTTP_IMG;?>/Star.png">
								</td>
								<td class="headInfoTd cursorPointer">
									<span class="toReplace">0</span> Commande
								</td>
								<a href="<?php echo HTTP_INDEX;?>?page=panier&action=show">
								<td class="headInfoTd cursorPointer">
									Panier : <span class="toReplace">0,00 €</span>
								</td>
								</a>
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