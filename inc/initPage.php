<?php
/**
 * Fichier d'initialisation d'une page du projet
 *
 * @author Pierre HUBERT
 */

/**
 *	Préparation de l'initialisation de la page
 */	
//Démarrage de la session
session_start();

//Détermination du chemin relatif du site
$relativePath = str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']);


/**
 *	Inclusion des configurations du site
 */
$dynaConfigFolder = $relativePath."config/";
$staticConfigFolder = $relativePath."inc/static.config/";

//Configuration générale du site
include($dynaConfigFolder.'config.php');

//Configuration technique du site
include($staticConfigFolder.'autoload.php');

//Inclusion de la liste des utilisateurs
include($dynaConfigFolder.'userLogin.php');


/**
 *	Inclusion des ressources nécessaire au site
 */
//Inclusion des fonctions
foreach($config['functionsFiles'] as $functionFile)
	require_once('Functions/'.$functionFile.'.php');

//Inclusion des Helpers
foreach($config['helpers'] as $helper)
	require_once('Helpers/'.$helper.".php");

//Inclusion de la liste des types de fichier notamment pour le navigateur
include($staticConfigFolder."FileTypes.php");