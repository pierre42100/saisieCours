<?php
/**
 *	Inclusion des ressources pour le navigateur WEB
 *
 *	@author Pierre HUBERT
 */

	isset($_SESSION) OR die('unallowed !');

// Inclusion des ressources pour le navigateur WEB
// Configuration du site JS 
include('v_jsConfig.php');

// Jquery
echo inc_js_code(path_3rdparty("jQuery/jquery-2.1.3.min.js"));

// Metro UI CSS
echo inc_css_code(path_3rdparty("metroui/css/metro.min.adapted.css"));
echo inc_css_code(path_3rdparty("metroui/css/metro-icons.min.css"));
echo inc_css_code(path_3rdparty("metroui/css/metro-responsive.min.css"));
echo inc_css_code(path_3rdparty("metroui/css/metro-schemes.min.css"));
echo inc_js_code(path_3rdparty("metroui/js/metro.min.js"));

// Ressources du site
echo inc_css_code(path_to_css("main"));
echo inc_js_code(path_to_js("utils"));
echo inc_js_code(path_to_js("main"));

// Traitement du code JSON côté navigateur
echo inc_js_code(path_to_js("json"));

// Notifications
echo inc_js_code(path_to_js("notif"));

// Boîtes de dialogue
echo inc_js_code(path_to_js("dialogs/dialogs"));

// Boîte de dialogue de choix d'emplacement
echo inc_js_code(path_to_js("dialogs/pickLocationDialog"));
echo inc_css_code(path_to_css("dialogs/pickLocationDialog"));