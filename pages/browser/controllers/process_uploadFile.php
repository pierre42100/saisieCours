<?php
/**
 * Upload d'un fichier si nécessaire
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

if(isset($_FILES['uploadFile'])) {
	//Extraction de la variable
	$uploadFile = $_FILES['uploadFile'];
	$tmpPath = $uploadFile['tmp_name'];
	$definitivePath = $relativePath.$path.$uploadFile['name'];

	//On vérifie si il n'y a pas eu d'erreur
	if($uploadFile['error'] != 0)
		$errorUpload = "Une erreur a survenue lors de l'envoi. Veuillez r&eacute;essayer.";

	//On vérifie la sécurié du nom
	if(!checkSafetyName($uploadFile['name']))
		$errorUpload = "Nous ne pouvons malheureusement accepter ce fichier en raison de son nom. Veuillez essayer avec un autre nom.";

	//On poursuit si il n'y a pas eu d'erreur
	if(!isset($errorUpload)) {
		//On tente de déplacer le fichier vers son emplacement définitif
		if(move_uploaded_file($tmpPath, $definitivePath))
			echo_succes_notif("Le fichier <i>".$uploadFile['name']."</i> a bien &eacute;t&eacute; mis en ligne.");
		else
			echo_erreur_notif("Une erreur a survenue lors du d&eacute;placement du fichier vers son emplacement d&eacute;finitif, qui est <i>".$definitivePath."</i>");
	}

	//On affiche les erreurs si il y en a
	if(isset($errorUpload))
		echo_erreur_notif($errorUpload);
}