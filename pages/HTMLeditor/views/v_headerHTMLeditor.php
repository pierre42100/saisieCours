<?php
/**
 *	Complément pour la barre de menu de l'éditeur
 *	de fichiers HTML du projet
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?>
<!-- Sauvegarde du fichier -->
<a class="app-bar-element" onClick="saveCurrentWorkHMTLeditor();" href="#">
	<span class="mif-floppy-disk"> Enregistrer</span>
</a>

<!-- Export du fichier au format PDF -->
<a class="app-bar-element" onClick="exportHTMLeditorToPDF();" href="#">
	<span class="mif-file-pdf"> PDF</span>
</a>

<!-- Séparateur -->
<span class="app-bar-divider"></span>

<!-- Menu d'insertion -->
<ul class="app-bar-menu small-dropdown">
	<li>
		<a href="#" class="dropdown-toggle"> Ins&eacute;rer</a>
		<ul class="d-menu" data-role="dropdown" data-no-close="true">
			<!-- Ajout d'une image -->
			<li>
				<a onClick="openAddImageDialog();" href="#">
					<span class="mif-file-image"></span> Image
				</a>
			</li>

			<!-- Insérer une en-tête -->
			<li>
				<a onClick="insertHTMLHeader();" href="#">
					<span class="mif-move-up"></span> En-t&ecirc;te
				</a>
			</li>

			<!-- Insérer un tableau -->
			<li>
				<a onClick="insertHTMLtable();" href="#">
					<span class="mif-table"></span> Tableau
				</a>
			</li>
		</ul>
	</li>
</ul>


<!-- Nom du fichier -->
<div class="app-bar-element place-center">
	<span id="fileName"><?php echo $fileName; ?></span>
</div>