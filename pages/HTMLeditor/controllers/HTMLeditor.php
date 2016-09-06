<?php
/**
 *	Controlleur principal de l'éditeur HTML
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//On commence par déterminer quel fichier a été appelé
if(isset($_GET['file']))
	$fichier = $_GET['file']; //On prend le fichier de la requête
else
	$fichier = "newFile.html"; //On crée un fichier à partir du timestamp actuel

//Détermination du nom relatif du fichier
$RelativeFileName = getRelativeCoursPath().$fichier;

//Nom du dossier contenant le fichier
$folderContainer = findLastOccurence($fichier, "/");

//Si le fichier n'existe pas, on crée un vide
if(!file_exists($RelativeFileName))
	createEmptyFile($RelativeFileName);

//Récupération du contenu du fichier
$fileContent = file_get_contents($RelativeFileName);

//Détermination du nom simple du fichier
if(!preg_match('</>', $fichier))
	$fileName = $fichier;
else
	$fileName = findLastOccurence($fichier, "/", true);


//Inclusion de la vue principale du fichier
include(getWebsiteRelativePath()."pages/HTMLeditor/views/v_HMTLeditor.php");