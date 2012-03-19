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
				</div>
			</div>
			<div id="menu" class="clearBoth">
				<table id="menuTable">
					<tr>
						<td class="menuTd" onmouseover="$(this).addClass('menuTdHover');" onmouseout="$(this).removeClass('menuTdHover');"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show&what=sandwich">Comm. en groupe</a></td>
						<td class="menuTd" onmouseover="$(this).addClass('menuTdHover');" onmouseout="$(this).removeClass('menuTdHover');"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show&what=viennoiserie Et Chocolat">Comm. individuel</a></td>
						<td class="menuTd" onmouseover="$(this).addClass('menuTdHover');" onmouseout="$(this).removeClass('menuTdHover');"><a class="menuLink" href="<?php echo HTTP_INDEX;?>?page=product&action=show&what=salade">Historique</a></td>
					</tr>
				</table>
			</div>	
		</div>
		<hr/>
	    <div id="main">