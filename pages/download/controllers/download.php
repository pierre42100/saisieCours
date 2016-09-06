<?php
/**
 *	Téléchargements de documents du service
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//On vérifie si un fichier spécifique a été demandé
if(!isset($_GET['file']) OR !isset($_GET['name'])) {
	exit("Aucun fichier n'a &eacute;t&eacute; soumis dans la requ&ecirc;te !");
}

//Extraction des données
$file = $_GET['file']; //Chemin vers le fichier
$name = $_GET['name']; //Nom du fichier

//On vérifie la sûreté du chemin vers le document
if($erreur = checkErrorDocPath($file))
	exit($erreur);


//On vérifie si il s'agit d'un dossier
if(filetype($file) == "dir") {
	//On vérifie que le dossier existe
	if(!file_exists($relativePath.getZIPStoragePath()))
		mkdir($relativePath.getZIPStoragePath());

	//Il s'agit d'un dossier, on générer une archive ZIP des fichiers contenus dans ce dossier
	//Nom de l'archive
	$archiveName = getZIPStoragePath()."export_".time().".zip";

	//Génération de l'archive
	if(!generateFolderArchive($relativePath.$archiveName, $file))
		exit("Une erreur a survenue lors de la g&eacute;n&eacute;ration de l'archive !");

	//On change le fichier de destination ainsi que le nom de l'archive
	$file = $archiveName;
	$name .= ".zip";

}

//On adapte le régime du téléchargement en fonction de la demande
if(isset($_GET['forceDownload'])) {
	//Récupération du type fichier
	$fileType = mime_content_type($file);

	//On modifie le type de fichier si c'est un fichier HTML
	if(preg_match('<.html>', $file))
		$fileType = "text/html";

	//Envoi du fichier
	header('Content-Type: '.$fileType);
	header('Content-Disposition: attachment; filename="'.str_replace('"', "'", $name).'"');
	echo file_get_contents($file);
}
else
	//Redirection simple vers le fichier
	header('Location: '.getWebsiteUrl().$file);