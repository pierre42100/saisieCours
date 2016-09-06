<?php
/**
 *	Vue principal de l'éditeur de fichiers HMTL
 *	Permet la saisie des cours
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

// Ressources de l'editeur
echo inc_css_code(path_to_css("HTMLeditor/HTMLeditor")); 

//Inclusion de TinyMCE
echo inc_js_code(path_3rdparty("tinymce/js/tinymce/tinymce.min.js"));

//Données relatives au fichier
include($relativePath.'pages/HTMLeditor/views/v_fileDatas.php');

// Barre de menu de l'editeur 
//Compléments de la barre de menu
$complementSourceMenu = $relativePath.'pages/HTMLeditor/views/v_headerHTMLeditor.php';

//Barre de menu principale
include($relativePath.'pages/utils/views/menuBar/v_menuBar.php');

//Barre de menu de droite
// NON UTILISEE POUR LE MOMENT - include($relativePath.'pages/HTMLeditor/views/v_rightMenuBar.php');

// Editeur HTML (TinyMCE)
include($relativePath.'pages/HTMLeditor/views/v_tinyMCE.php');

//Inclusion de la boîte de dialogue d'envoi de fichier
include($relativePath.'pages/utils/views/dialogs/v_uploadDialog.php');

//Inclusion de la boîte de dialogue d'entrée d'une valeur
include($relativePath.'pages/utils/views/dialogs/v_inputTextDialog.php');

//Inclusion de certains fichiers Javascript à la fin de la page
echo inc_js_code(path_to_js("tinymce"));
echo inc_js_code(path_to_js("HTMLeditor/insertContent"));
echo inc_js_code(path_to_js("HTMLeditor/addImage"));
echo inc_js_code(path_to_js("HTMLeditor/fileName"));
echo inc_js_code(path_to_js("HTMLeditor/save"));
echo inc_js_code(path_to_js("HTMLeditor/HTMLeditor"));
