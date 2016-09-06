<?php
/**
 *	Vue de la barre de menu générale du projet
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?><header class="app-bar fixed-top navy" data-role="appbar">
	<!-- Menu de gauche de la page -->
	<?php include('v_dropContainer.php'); ?>
	<span class="app-bar-divider"></span>

	<!-- Titre de la page -->
	<a href="<?php echo getWebsiteUrl().$page; ?>" class="app-bar-element branding">
		<span class="<?php echo $liste_pages[$page]['metroIcon']; ?>"></span>
		<?php echo $liste_pages[$page]['title']; ?>
	</a>
	<span class="app-bar-divider"></span>
	
	<!-- Menu de l'utilisateur -->
	<div class="app-bar-element place-right">
		<span class="dropdown-toggle"><span class="mif-user"></span> <?php echo getInfoUser("nomComplet"); ?></span>
		<div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow fg-dark bg-white" data-role="dropdown" data-no-close="true" style="width: 220px">
			<h2 class="text-light">Compte</h2>
			<ul class="unstyled-list fg-dark">
				<li><a href="<?php echo getWebsiteUrl(); ?>login?logout" class="fg-white3 fg-hover-yellow">D&eacute;connexion</a></li>
			</ul>
		</div>
	</div>

	<?php
		//Contenu spécifique de la page (seulement si il existe)
		if(isset($complementSourceMenu))
			include($complementSourceMenu);
	?>
</header>


<!-- Correctif de la barre de menu -->
<header class="app-bar navy" data-role="appbar"><a href="./" class="app-bar-element">Home</a></header>