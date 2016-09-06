<?php
/**
 * Renommage d'un document si nécessaire
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Si nécessaire, on renomme un document
if(isset($_POST['newName']) AND isset($_POST['actualFileName'])) {
	//Extraction des données
	$newFileName = $_POST['newName'];
	$actualFileName = $_POST['actualFileName'];

	//On vérifie si le nouveau nom de dossier est disponible
	if(file_exists(getWebsiteRelativePath().$path.$newFileName))
		$erreurRename = "Le nouveau nom demand&eacute; n'est pas disponible !";

	//On vérifie si les noms de dossier sont identiques
	if($newFileName == $actualFileName)
		$erreurRename = "L'ancien et le nouveau nom pour le document sont identiques !";

	//On vérifie la sécurité du nom demandé
	if(!checkSafetyName($newFileName))
		$erreurRename = "Le nouveau nom de document demand&eacute; est incorrect !";

	//On vérifie si il n'y a pas eu d'erreur jusqu'à présent
	if(!isset($erreurRename)) {
		//La sécurité est assurée, on peut renommer le fichier
		if(rename(getWebsiteRelativePath().$path.$actualFileName, getWebsiteRelativePath().$path.$newFileName))
			//Message de succes
			echo_succes_notif("Le document <i>".$actualFileName."</i> a &eacute;t&eacute; renomm&eacute; en <i>".$newFileName."</i>");
		else
			$erreurRename = "Une erreur a survenue lors du renommage du document. Veuillez r&eacute;essayer...";
	}
	
	//On vérifie si il y a une erreur a afficher
	if(isset($erreurRename))
		//Affichage de l'erreur
		echo_erreur_notif($erreurRename);
}
