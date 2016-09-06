<?php
/**
 *  Vue de la barre de menu du navigateur du projet
 *
 *  @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?>
<a class="app-bar-element menuBarButtonUP" onClick="location.href='<?php echo getWebsiteUrl().$page; ?>?dossier=' + findFolderUp(browserConfig['currentFolder']);">
	<span class="mif-arrow-up"></span>
</a>

<!-- Création ou ajout d'un document -->
<ul class="app-bar-menu small-dropdown">
	<li>
		<a href="#" class="dropdown-toggle"> Nouveau</a>
		<ul class="d-menu" data-role="dropdown" data-no-close="true">
			<li><a onClick="createEmptyHTMLDialog();"><span class="mif-file-code"></span> Fichier HTML</a></li>
			<li><a onClick="createFolderDialog();"><span class="mif-folder-plus"></span> Dossier</a></li>
		</ul>
	</li>
</ul>

<!-- Upload d'un document -->
<a class="app-bar-element" href="#" onClick="openUploadFilesDialog();"><span class="mif-file-upload"></span> Upload</a>

<!-- Actualisation de la page actuelle -->
<a class="app-bar-element" href="#" onClick="location.href = document.location;">
	<!--<span class="mif-redo"></span>-->
	Actualiser
</a>

<!-- Affichage du dossier actuel -->
<span class="app-bar-element place-right currentFolderName"><?php echo $dossier; ?></span>