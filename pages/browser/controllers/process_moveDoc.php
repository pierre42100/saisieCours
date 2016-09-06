<?php
/**
 * Déplacement d'un document si nécessaire
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//On vérifie si il faut déplacer un document
if(isset($_POST['moveFile']) AND isset($_POST['targetMoveFolder'])) {
	//Extraction des informations
	$moveFile = $_POST['moveFile'];
	$targetMoveFolder = $_POST['targetMoveFolder'];
	$targetMove = getCoursPath().$targetMoveFolder."/".$moveFile;

	//Pré-traitement du déplacement
	$targetMove = str_replace("//", "/", $targetMove);

	//On vérifie la sécurité du nom demandé
	if(!checkSafetyName($moveFile))
		$errorMove = "Le nouveau nom de document &agrave; d&eacute;placer est incorrect !";

	//On vérifie que le document source existe
	if(!file_exists($path.$moveFile))
		$errorMove = "Le document source n'existe pas !";

	//On vérifie la sécurité du dossier de destination
	if(!checkErrorDocPath($targetMoveFolder))
		$errorMove = "Le dossier de destination n'est pas s&ucirc;r !";

	//On continue si il n'y a pas d'erreur
	if(!isset($errorMove)){
		if(rename($path.$moveFile, $targetMove)) {
			echo_succes_notif("Le document <i>".$moveFile."</i> a &eacute;t&eacute; deplac&eacute; vers <i>".$targetMove."</i>");
		}
		else
			$errorMove = "Une erreur a survenue lors du d&eacute;placement de <i>".$moveFile."</i>. Veuillez r&eacute;essayer.";
	}

	//On vérifie si il y a une erreur a afficher
	if(isset($errorMove))
		//Affichage de l'erreur
		echo_erreur_notif($errorMove);
}