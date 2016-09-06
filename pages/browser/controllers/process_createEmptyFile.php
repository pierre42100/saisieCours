<?php
/**
 * Création d'un fichier vide si nécessaire
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Si nécessaire, on crée un dossier
if(isset($_POST['newFileName']))
{
	//Extraction et détertmination des informations
	$newFileName = $_POST['newFileName'];
	$pathNewFile = $path.$newFileName;
	
	//On vérifie la sécurité du fichier
	if(!checkSafetyName($newFileName))
		$createError = "Le nom choisi pour le nouveau dossier est incorrect ! Veuillez r&eacute;ssayer avec un autre nom !";
	
	//On vérifie que le dossier n'existe pas déjà
	if(file_exists($pathNewFile))
		$createError = "Un document portant le nom <i>".$newFileName."</i> existe d&eacute;j&agrave; dans ce r&eacute;pertoire. Veuillez r&eacute;essayer avec un autre nom.";

	//Si il n'y a pas d'erreur, on peut continuer
	if(!isset($createError))
	{
		if($newFile = fopen($pathNewFile, "x")) {
			//On referme le fichier
			fclose($newFile);

			//On affiche un message de succès
			echo_succes_notif("Le fichier <i>".$pathNewFile."</i> a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s !");
		}
		else
			$createError = "Une erreur inatendue a survenue lors de la cr&eacute;ation du fichier vide : ".$pathNewFile;
	}

	//Si nécessaire, on affiche une erreur
	if(isset($createError))
		echo_erreur_notif($createError);
}