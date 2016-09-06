<?php
/**
 * Création d'un dossier si nécessaire
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Si nécessaire, on crée un dossier
if(isset($_POST['newFolderName']))
{
	$newFolderName = $_POST['newFolderName'];
	
	if(!checkSafetyName($newFolderName))
		echo_erreur_notif("Le nom choisi pour le nouveau dossier est incorrect ! Veuillez r&eacute;ssayer avec un autre nom !");
	else
	{
		$pathNewFolder = $path.$newFolderName;
		if(!mkdir($pathNewFolder))
			echo_erreur_notif("Une erreur inatendue a survenue lors de la cr&eacute;ation du dossier : ".$pathNewFolder);
		else
			echo_succes_notif("Le dossier ".$pathNewFolder." a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s !");
	}
}