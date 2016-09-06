<?php
/**
 *	Vue de renommage d'un document
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?><!-- Renommer un document -->
<div data-role="dialog" id="renameDocument" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark">
	<h5>Renommmer le dossier</h5>
	<form action="<?php echo $config['siteURL']; ?>browser?dossier=<?php echo $dossier; ?>" method="post">
		<div class="input-control text">
			<input type="text" name="newName" placeholder="Nom du dossier" class="newName">
		</div>

			<!-- Nom actuel du document -->
			<input type="hidden" name="actualFileName" class="actualFileName" />
		
		<input type="submit" value="Renommer" class="button" />
	</form>
</div>