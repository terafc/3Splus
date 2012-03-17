<p>Bienvenue sur l'application 3S+ !</p>
<p>
	Veuillez entrer l'adresse mail fourni à l'IUT pour accéder à l'application. 
	Vous devrez valider l'email de confirmation qui vous a été envoyer pour utiliser l'application.
</p>
<form method="POST" action="<?php echo HTTP_INDEX."?page=login&action=sendLogin";?>">
	Email: <input type="text" name="email" placeholder="Votre Email (IUT)"/>
	<input type="submit"/>
</form>