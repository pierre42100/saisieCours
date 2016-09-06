<?php
/**
 * Vue du gestionnaire d'accès au WebSSH
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Inclusion des feuilles de style
echo inc_css_code(path_to_css("webSSH/webSSH"));

// Barre de menu 
//Compléments de la barre de menu
$complementSourceMenu = $relativePath.'pages/webSSH/views/v_headerWebSSH.php';

include(path_pages_relative("utils/views/menuBar/v_menuBar.php"));

// Iframe du terminal SSH
include(path_pages_relative("webSSH/views/v_iframeSSH.php"));

//Inclusion de certains fichiers Javascript à la fin de la page
echo inc_js_code(path_to_js("webSSH/webSSH"));