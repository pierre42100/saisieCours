<?php
/**
 * Fonctions de gestion des fichiers
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

 /**
  *	Fonction permettant de vérifier la sécurité du nom du fichier ou dossier à créer
  *
  *	@param 	String 	Name of the doc to check
  */
function checkSafetyName($name) {
		
	//Un nom vide est dangeureux
	if($name == "")
		return false;

	//Les noms de dossier ou de fichier . .. sont interdits.
	if($name == "." OR $name == "..")
		return false;

	//Le nom de document  ne doit pas commencer par un point
	if($name[0] == ".")
		return false;

	//Définition des interditions
	$array_problems = array(
		"/",
		"\\",
		"'",
		'"',
		'*',
		'|',
		'~',
		')',
		'(',
		"&",
		'#',
		'	',
		"²",
		'[',
		"]",
		"<",
		">",
		"é",
		"è",
		"à",
		"@",
		"ê",
		".php", //Pas de fichier PHP ! 
	);
	
	if(str_ireplace($array_problems, "", $name) != $name)
		return false; //Il y a un ou plusieurs problèmes
	
	//Tout est OK
	return true;
}

/**
 *	Fonction permettant de vérifier la sécurité du chemin d'un document donné
 *
 *	@param 	String 	Name of the folder
 */
function checkErrorDocPath($file){
//On vérifie l'existence du fichier
	if(!file_exists($file)) {
		$erreur = "Le fichier demand&eacute; n'a pas &eacute;t&eacute; trouv&eacute; !";
	}

	//On vérifie que le fichier (ou le dossier demandé) est bien situé dans le répertoire de cours
	if(!isInStr($file, getCoursPath()))
		$erreur = "Le fichier n'est pas autoris&eacute; au t&eacute;l&eacute;chargement !";

	//On vérifie deux trois points de sécurité...
	if(preg_match("<.php>", $file))
		$erreur = "Mais quel fichier avez-vous donc choisit de t&eacute;l&eacute;charger ????";

	//Protection de l'OS
	if(isInStr($file, ".."))
		$erreur = "Notre syst&egrave;me d'exploitation n'est malheureusement pas disponible au t&eacute;l&eacute;chargement...";

	//On renvoi l'erreur si il y en a une sinon tout est OK
	if(isset($erreur))
		return $erreur;
	else
		return false;
}

/**
 * Fonction renvoyant des informations sur un fichier
 *
 * @param 	String 	Path to the file
 * @param 	Array 	File Infos list
 * @return 	Array 	Datas about the file
 */
function getFileInfos($file, $fileTypesList) {
	$fileType = mime_content_type($file);

	//Le format de fichier est inconnu
	$retour = $fileTypesList['generic'];

	//Fichier de la liste
	if(isset($fileTypesList[$fileType]))
		$retour = $fileTypesList[$fileType];

	//Traitement des cas avancés
	//Archives spécifiques
	if($fileType == 'application/zip') {
		foreach($fileTypesList['specArchives'] as $nom=>$traiter) {
			if(preg_match('<.'.$nom.'>', $file))
				$retour = $fileTypesList['specArchives'][$nom];
		}
	}

	//Fichiers textes (text/plain ou inode/x-empty)
	if($fileType == 'text/plain' OR $fileType == "inode/x-empty") {
		foreach($fileTypesList['specTextFiles'] as $nom=>$traiter) {
			if(preg_match('<.'.$nom.'>', $file))
				$retour = $fileTypesList['specTextFiles'][$nom];
		}
	}

	//Ajout du mime-type
	$retour[] = $fileType;

	//Renvoi du résultat
	return $retour;
}

/**
 *	Fonction de récupération des informations sur un document
 *
 *	@param 	String 	Path to doc
 *	@param 	String 	Root path of doc
 *	@param 	Array 	File Infos list
 *	@return Array 	Datas about the document
 */
function getDocInfos($file, $path, $fileTypesList) {
	//On commence par supprimer les doubles slash dans le nom du fichier
	$file = str_replace("//", "/", $file);

	//Préparation du retour
	$return = array();

	//On détermine si le document est un fichier ou un dossier
	$return['fileType'] = filetype($file);

	//Chemin relatif de l'élément
	$return['sysPath'] = getWebsiteRelativePath().$file;

	//Chemin "simple" de l'élément
	$return['simplePath'] = str_replace(getWebsiteRelativePath().getCoursPath(), '', $return['sysPath']);

	//Détermination des adresses de téléchargment
	$return['datas']['downloadLink'] = getWebsiteUrl()."download?file=".urlencode($file)."&name=".urlencode(removepath($file, $path));
	$return['datas']['forceDownloadLink'] = $return['datas']['downloadLink']."&forceDownload";

	//Détermination du nom de l'élément
	$return['nom'] = findLastOccurence($file, "/", true);

	//Le traitement dépend maintenant de si il s'agit d'un fichier ou d'un dossier
	if($return['fileType'] == "dir") {
		//Traitement des dossiers

		//Icône du dossier
		//Pour le dossier de l'image coresspondante, on vérifie si il s'agit de la corbeille
		if(getTrashPath() == getCoursPath().$return['nom']."/")
			$return['fileTypeInfos'][1] = path_assets("img/trash.png");
		//On vérifie si il s'agit du dossier de téléchargement...
		elseif(getZIPStoragePath() == getCoursPath().$return['nom']."/")
			$return['fileTypeInfos'][1] = path_assets("img/downloadDir.png");
		//On vérifie si il s'agit du dossier de sauvegarde... 
		elseif(getBackupStoragePath() == getCoursPath().$return['nom']."/")
			$return['fileTypeInfos'][1] = path_assets("img/backupFolder.png");
		//Sinon on affiche l'image de dossier par défaut
		else
			$return['fileTypeInfos'][1] = path_assets("img/folder-documents.png");

		//On prépare le lien pour l'ouverture du dossier
		$return['linkURL'] = getWebsiteUrl().'?dossier='.removepath($file, getCoursPath());

		//On affiche le nom complet du type de fichier
		$return['fileTypeComplete'] = "folder";

	}
	else {
		//Traitement des fichiers
		//Récupération des informations sur le type de fichier
		$return['fileTypeInfos'] = getFileInfos($return['sysPath'], $fileTypesList);

		//Récupération des informations sur le fichier
		$fileInfos = lstat($return['sysPath']);

		//Extraction des données
		$return['datas']["explainType"] = $return['fileTypeInfos'][0];
		$return['datas']["fileSize"] = convertis_octets_vers_mo($fileInfos['size'])." Mo";
		$return['datas']["lastEditFile"] = adapte_date("", $fileInfos['mtime']);

		//On change le lien si l'éditeur est acessible
		if(isset($return['fileTypeInfos']['editor']))
			$return['linkURL'] = getWebsiteUrl().$return['fileTypeInfos']['editor']."?file=".urlencode($return['simplePath']);
		else
			$return['linkURL'] =  $return['datas']['downloadLink'];

		//On affiche le nom complet du type de fichier
		$return['fileTypeComplete'] = "file";
	}

	//Renvoi du résultat
	return $return;
}

/**
 * Conversion d'un nombre de bytes en MO
 *
 *	@param 	Int 	The weight of the file
 * 	@return String 	Human readable size
 */
function convertis_octets_vers_mo($valeur)
{
	//Conversion de la valeur
	$valeur = $valeur/1024; //Convertion en KO
	$valeur = $valeur/1024; //Convertion en MO
	$valeur = round($valeur, 4); //Arrondis de la valeur à deux chiffres après la virgule

	//Renvoi du résultat
	return $valeur;
}

/**
 *	Génération d'un archive à partir d'un nom de dossier
 *
 *	@param 	String 	Le nom de l'archive
 * 	@param 	String 	Le dossier source
 *	@return Boolean True or false depending of the success of the operation
 */
function generateFolderArchive($nomArchive, $dossierSource) {
	//On commence par vérifier que le document concerné est bien un dossier
	if(!is_dir($dossierSource))
		return false;

	//Nouvelle archive ZIP
	$zip = new ZipArchive;

	//Ouverture de l'archive
	if(!$zip->open($nomArchive,ZipArchive::CREATE|ZipArchive::OVERWRITE))
		return false;

	//Traitement récursif du dossier (fonction de hunter666 issue de la document de PHP)
	/************************************************************************************/
	$dir = preg_replace('/[\/]{2,}/', '/', $dossierSource."/"); 

	$dirs = array($dir); 
	while (count($dirs)) 
	{ 
		$dir = current($dirs);
		$zip -> addEmptyDir($dir);

		$dh = opendir($dir);
		while($file = readdir($dh))
		{
			if ($file != '.' && $file != '..')
			{
				if (is_file($dir.$file)){
					$zip -> addFile($dir.$file, $dir.$file);
				}
				elseif (is_dir($dir.$file)) 
					$dirs[] = $dir.$file."/"; 
			} 
		} 
		closedir($dh); 
		array_shift($dirs); 
	}
	/************************************************************************************/

	//Fermeture de l'archive
	$zip->close();
	
	//Opération effectuée avec succès
	return true;
}

/**
 *	Fonction de création d'un fichier vide
 *
 *	@param 	String 	Adresse du fichier a créer
 *	@return Boolean True or false depending of the success of the operation
 */
function createEmptyFile($pathNewFile){
	//On tente de créer le nouveau fichier
	if($newFile = fopen($pathNewFile, "x")) {
		//On referme le fichier
		fclose($newFile);

		//Succès
		return true;
	}
	else
		return false; //Echec
}

/**
 *	Fonction de suppression d'un dossier et de son contenu
 */
function delDir($path){
	if(is_dir($path) == TRUE){
		$rootFolder = scandir($path);
		if(sizeof($rootFolder) > 2){
			foreach($rootFolder as $folder){
				if($folder != "." && $folder != ".."){
					//Pass the subfolder to function
					delDir($path."/".$folder);
				}
			}

			//On the end of foreach the directory will be cleaned, and you will can use rmdir, to remove it
			rmdir($path);
		}
	}
	else {
		if(file_exists($path) == TRUE){
			//Suppression du fichier
			unlink($path);
		}
	}
}