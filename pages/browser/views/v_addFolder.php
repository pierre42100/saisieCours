<?php
/**
 *	Ajout d'un dossier
 *
 *	@author Pierre HUBERT
 *	@deprecated
 */
isset($_SESSION) OR die('unallowed !');

/** 	Attention : 	Ce fichier n'est PLUS UTILISE !! **/

?><!-- Création d'un dossier -->
<div data-role="dialog" id="newFolder" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark">
	<h3>Nouveau dossier</h3>
	<form action="<?php echo $config['siteURL']; ?>browser?dossier=<?php echo $dossier; ?>" method="post">
		<div class="input-control text">
			<input type="text" name="newFolderName" placeholder="Nom du dossier">
		</div>
		
		<input type="submit" value="Cr&eacute;er" class="button" />
	</form>
</div>