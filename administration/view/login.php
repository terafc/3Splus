<?php
//Permet de rediriger vers la bonne vue (non autorisée) selon le contenu de la variable redirect
if(!empty($redirect)){
	echo $redirect;
}
else{?>
<p><h1>Bienvenue sur l'application 3S+ !</h1></p>
<p>
	<form method='POST' action="<?php echo HTTP_INDEX;?>?page=login&action=auth" method="post">
		Veuillez entrer votre login: 
		<br />
		<input type='text' name='id_admin'/>
		<br/>
		Et votre mot de passe: 
		<br />
		<input type='password' name='mdp_admin'/>	
		<br />
		<input type="submit" value="Se connecter" />	
	</form>
	
</p>
</form>
<?php }?>