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
							<span class="colorBlue">P</span>ersonel
							<span class="colorBlue">C</span>rous
						</span>
					</div>
				</div>
				<div id="headRight">
					<div id="infoShop">
						<table id="headInfoTable">
							<tr>
								<td class="headInfoTd">
									<span class="alignCenter verticalAlignM"><?php //echo $_SESSION['user']['point'];?> Points</span>
								</td>
								<td class="headInfoTd">
									<span class="toReplace">0</span> Commande
								</td>
								<td class="headInfoTd">
									Panier : <span class="toReplace">0,00 €</span>
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