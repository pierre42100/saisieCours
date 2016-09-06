<?php
/**
 *	Vue principale du gestionnaire de connexion au service
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Inclusion des feuilles de style
echo inc_css_code(path_to_css("login/login"));

//On vérifie si il faut afficher une erreur
if(isset($loginError)){
	echo_erreur_notif($loginError);
}

//On vérifie si il faut afficher un message de succès
if(isset($loginSuccess)){
	echo_succes_notif($loginSuccess);
}

//Formulaire de connexion
?><div class="login-form padding20 block-shadow">
	<form action="<?php getWebsiteUrl(); ?>login?redirect_url=<?php echo $redirect_url; ?>" method="post">

		<h1 class="text-light"><?php echo getSiteName(); ?></h1>
		<hr class="thin"/>
		<br />
		<div class="input-control text full-size" data-role="input">
			<label for="user_login">Nom d'utilisateur :</label>
			<input type="text" name="user" id="user_login" placeholder="Nom d'utilisateur" />
			<button class="button helper-button clear"><span class="mif-cross"></span></button>
		</div>
		<br />
		<br />
		<div class="input-control password full-size" data-role="input">
			<label for="user_password">Mot de passe :</label>
			<input type="password" name="password" id="user_password" placeholder="Mot de passe" />
			<button class="button helper-button reveal"><span class="mif-looks"></span></button>
		</div>
		<br />
		<br />
		<div class="form-actions">
			<button type="submit" class="button primary">Connexion</button>
		</div>
	</form>
</div><?php

//Inclusion de certains fichiers Javascript à la fin de la page
echo inc_js_code(path_to_js("login/login"));