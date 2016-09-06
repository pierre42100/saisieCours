<?php
/**
 *  Vue de la barre de menu du terminal WEB SSH
 *
 *  @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Téléchargement de PuTTY
?>
<a class="app-bar-element menuBarButtonUP" href="<?php echo path_assets("exe/putty.exe"); ?>">
	PuTTY
</a>