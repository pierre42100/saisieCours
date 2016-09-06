<?php
	/**
	 *	Controlleur du navigateur du projet
	 *
	 * @author Pierre HUBERT
	 */


	//Sécurité
	isset($_SESSION) OR die('unallowed !');
	
	//On vérifie si un dossier est ouverte actuellement
	if(isset($_GET['dossier']))
		$dossier = $_GET['dossier'];
	else
		$dossier = "";

	//On simplifie le dossier si il est égal à "/"
	if($dossier == "/")
		$dossier = "";
	
	//Détermination du dossier final
	$path = str_replace("//", "/", getCoursPath().$dossier."/");
	
	//On vérifie si le dossier existe
	if(!is_dir($path))
		exit(echo_erreur("Le chemin indiqu&eacute; (".$path.") n'est pas un dossier !"));
	
	//On vérifie si il faut créer un dossier
	if(isset($_POST['newFolderName']))
		include('process_createFolder.php');

	//On vérifie si il faut créer un fichier vide
	if(isset($_POST['newFileName']))
		include('process_createEmptyFile.php');

	//On vérifie si il faut renommer un document
	if(isset($_POST['newName']) AND isset($_POST['actualFileName']))
		include('process_renameDoc.php');

	//On vérifie si il faut déplacer un document
	if(isset($_POST['moveFile']) AND isset($_POST['targetMoveFolder']))
		include('process_moveDoc.php');

	//On vérifie si il faut supprimer un fichier
	if(isset($_POST['deleteDoc']))
		include("process_deleteDoc.php");
	
	//On vérifie si il faut mettre en ligne un fichier
	if(isset($_FILES['uploadFile']))
		include("process_uploadFile.php");

	//Récupération de la liste des éléments du dossier
	$liste_elements = glob($path."*");
	natcasesort($liste_elements);

	//Inclusion de la vue du fichier
	include($relativePath.'pages/browser/views/v_browser.php');
?>