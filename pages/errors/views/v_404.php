<?php
/**
 *	Vue de l'erreur 404 - Not Found
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?><!-- Ressources du fichier -->
<?php echo inc_css_code(path_to_css("errors/404")); ?>

<div class="Contener404">
	<h1> Erreur - Page demand&eacute;e non trouv&eacute;e</h1>

	<p>La page que vous recherchez n'est peut-&ecirc;tre plus disponible...</p>

	<a href="<?php echo getWebsiteUrl(); ?>">Retourner &agrave; la page d'acceuil</a>
</div>