<?php
/**
 * Vue du gestionnaire d'accès au WebSSH
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Inclusion des feuilles de style
echo inc_css_code(path_to_css("geogebra/geogebra"));

// Barre de menu de l'editeur
//Barre de menu principale
include($relativePath.'pages/utils/views/menuBar/v_menuBar.php');

//Iframe contenant géogébra
?><iframe src="<?php echo path_3rdparty('geogebra/geogebraLive.html'); ?>" id="iframeGeoGebra"></iframe><?php

//Inclusion de certains fichiers Javascript à la fin de la page
echo inc_js_code(path_to_js("geogebra/geogebra"));