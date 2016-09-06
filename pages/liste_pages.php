<?php
/**
 * Liste des pages du service
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');
	
//Liste des pages du service
$liste_pages = array(
	//Connexion au service
	"login" => array(
		"file" => "pages/login/controllers/login.php",
		"pageIcon" => path_assets('img/loginIcon.ico'),
		"metroIcon" => "mif-key",
		"needHTML" => true,
		"needLogin" => false,
		"title" => "Connexion au service"
	),

	//Navigateur 
	"browser" => array(
		"file" => "pages/browser/controllers/browser.php",
		"pageIcon" => path_assets('img/fileBrowserIcon.ico'),
		"metroIcon" => "mif-folder-open",
		"needHTML" => true,
		"registerMenu" => true,
		"title" => "FileManager"
	),

	//Editeur de fichiers HTML
	"HTMLeditor" => array(
		"file" => "pages/HTMLeditor/controllers/HTMLeditor.php",
		"pageIcon" => path_assets('img/iconEditor.ico'),
		"metroIcon" => "mif-file-code",
		"needHTML" => true,
		"registerMenu" => true,
		"title" => "HTMLeditor"
	),

	//Géogébra
	"geogebra" => array(
		"file" => "pages/geogebra/controllers/geogebra.php",
		"pageIcon" => path_assets('img/geogebraIcon.ico'),
		"metroIcon" => "mif-superscript",
		"needHTML" => true,
		"registerMenu" => true,
		"title" => "geogebra"
	),

	//Utilitaires
	"utilities" => array(
		"file" => "pages/utilities/controllers/utilities.php",
		"pageIcon" => path_assets('img/utilitiesIcon.ico'),
		"metroIcon" => "mif-tools",
		"needHTML" => true,
		"registerMenu" => true,
		"title" => "Utilitaires"
	),

	//Console SSH d'accès au terminal de la machine
	"webSSH" => array(
		"file" => "pages/webSSH/controllers/webSSH.php",
		"pageIcon" => path_assets('img/webSSHicon.ico'),
		"metroIcon" => "mif-switch",
		"needHTML" => true,
		"registerMenu" => true,
		"title" => "webSSH"
	),

	//Téléchargement de fichier
	"download" => array(
		"file" => "pages/download/controllers/download.php",
		"needHTML" => false,
	),

	//API Server (Restfull Server)
	"API" => array(
		"file" => "pages/API/controllers/API.php",
		"needHTML" => false,
	),

	//WebDav Server
	"webdav" => array(
		"file" => "pages/webdav/controllers/webdav.php",
		"needHTML" => false,
		"needLogin" => false,
	),

	//Erreur 404 - Page non trouvée
	"404" => array(
		"file" => "pages/errors/controllers/404.php",
		"needHTML" => true,
		"title" => "Page non trouv&eacute;e !"
	),
);