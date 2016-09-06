<?php
/**
 * Suppression d'un document si nécessaire
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Si nécessaire, on supprime un document
if(isset($_POST['deleteDoc'])) {
	$deleteDoc = $_POST['deleteDoc'];
	$fullPathDeleteDoc = $relativePath.$path.$deleteDoc;
	$trashPath = $relativePath.getTrashPath().time()." - ".$deleteDoc;

	//On vérifie si le document existe
	if(!file_exists($fullPathDeleteDoc))
		$erreurDelete = "Le document &agrave; supprimer est introuvable !";

	//On vérifie la sécurité du fichier à suppirmer
	if(!checkSafetyName($deleteDoc))
		$erreurDelete = "Le nom du dossier &agrave; supprimer est incorrect !";

	//Si nécessaire, on crée la corbeille
	if(!file_exists(getTrashPath())) 
		mkdir(getTrashPath());

	//Les documents de la corbeille ne peuvent être supprimés par cette voie
	if(isInStr($fullPathDeleteDoc, getTrashPath()))
		$erreurDelete = "Les documents de la corbeille ne peuvent &ecirc;tre supprim&eacute;s !";

	//Si il n'y a pas eu d'erreur jusqu'à présent...
	if(!isset($erreurDelete)) {
	
		//On tente de déplacer le document vers la corbeille
		//exec("mv '".$fullPathDeleteDoc."' '".$trashPath."'"); //Commande UNIX
		if(rename($fullPathDeleteDoc, $trashPath))
			//Message de succès
			echo_succes_notif("Le document <i>".$deleteDoc."</i> a bien &eacute;t&eacute; supprim&eacute;.");
		else
			//En cas d'erreur
			$erreurDelete = "Une erreur a survenue lors de la tentative de suppression de ".$deleteDoc.". Veuillez r&eacute;essayer."; //Message d'erreur
	}

	//Si il y a une erreur, on l'affiche
	if(isset($erreurDelete))
		echo_erreur_notif($erreurDelete);
}