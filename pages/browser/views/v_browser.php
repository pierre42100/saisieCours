<?php
/**
 *	Vue du navigateur du projet
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Inclusion de la configuration dynamique du navigateur
include('v_configJS.php');

// Ressources du navigateur
echo inc_js_code(path_to_js("browser/browser"));
echo inc_css_code(path_to_css("browser/browser"));
echo inc_css_code(path_to_css("browser/browserCharms"));

// Barre de menu du navigateur 
//Compléments de la barre de menu
$complementSourceMenu = $relativePath.'pages/browser/views/v_headerBrowser.php';

//Appel de la vue générale
include($relativePath.'pages/utils/views/menuBar/v_menuBar.php');


// Listing des fichiers du navigateur
include('v_browseFiles.php');

// "Charm" pour les documents 
include('v_charmDocs.php');

// Renommer un document
include('v_renameDoc.php');

//Inclusion de la boîte de dialogue de confirmation
include($relativePath.'pages/utils/views/dialogs/v_confirmDialog.php');

//Inclusion de la boîte de dialogue d'envoi de fichier
include($relativePath.'pages/utils/views/dialogs/v_uploadDialog.php');

//Inclusion de la boîte de dialogue de choix d'emplacement
include($relativePath.'pages/utils/views/dialogs/v_pickLocationDialog.php');

//Inclusion de la boîte de dialogue d'entrée d'une valeur
include($relativePath.'pages/utils/views/dialogs/v_inputTextDialog.php');