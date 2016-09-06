<?php
/**
 *	Vue du conteneur de tuile pour le menu à gauche
 *
 *	@author Pierre HUBERT
 */

	isset($_SESSION) OR die('unallowed !');
?><!-- Conteneur permettant l'accès aux différentes pages du site -->
<a class="app-bar-element" style="cursor: default;">
	<span id="toggle-tiles-dropdown" class="mif-apps mif-2x"></span>
	<div class="app-bar-drop-container"
			data-role="dropdown"
			data-toggle-element="#toggle-tiles-dropdown"
			data-no-close="false" >
		<div class="tile-container bg-white" style="width: 240px;">
			
			<?php 
			foreach($liste_pages as $nom=>$afficher_page) {
				//On affiche la tuile si son icône est renseignée
				if(isset($afficher_page['registerMenu']) AND isset($afficher_page['metroIcon'])){
					//On vérifie qu'elle doit faire partie de celles affichées dans le menu
					if($afficher_page['registerMenu']) {
						//Affichage de la tuile
						?><div class="tile-small bg-cyan" onClick="location.href='<?php echo getWebsiteUrl().$nom; ?>';">
							<div class="tile-content iconic">
								<span class="icon <?php echo $afficher_page['metroIcon']; ?>"></span>
							</div>
						</div><?php
					}
				}
			}
			?>	
		</div>
	</div>
</a>