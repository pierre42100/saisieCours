<?php
/**
 *	Vue de l'éditeur TinyMCE
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Le TextArea et son conteneur
?><div id="textareaEditorContener">
	<textarea id="editor"><?php
		//Affichage du contenu actuel du fichier
		echo $fileContent;
	?></textarea>
</div>