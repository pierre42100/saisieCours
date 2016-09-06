<?php
/**
 *	Controlleur de fichiers pour le serveur d'APIs
 *
 *	@author Pierre HUBERT
 */

use \Jacwright\RestServer\RestException;

class filesController
{

	/**
	 * 	Constructeur de la classe filesController
	 */
	public function __construct() {
		//Nothing for now
	}

	/**
	 * Retourne la liste des documents d'un répertoire
	 *
	 * @url GET /API/files/listing
	 */
	public function filesListing()
	{
		//Inclusion de la liste des types de fichiers
		include(getWebsiteRelativePath().'inc/static.config/FileTypes.php');

		//On vérifie si un dossier a été indiqué
		if(isset($_GET['folder']))
			$folder = str_replace('//', '/', $_GET['folder']."/");
		else
			$folder = "";

		//Détermination du nom complet
		$fullNameFolder = str_replace('//', '/', getWebsiteRelativePath().getCoursPath().$folder);

		//On vérifie la sécurité du nom donné
		if($erreur = checkErrorDocPath($fullNameFolder))
			throw new RestException(401, $erreur);

		//On vérifie qu'il s'agit bien d'un dossier
		if(fileType($fullNameFolder) != "dir")
			throw new RestException(401, "Le document '".$folder."' n'est pas un dossier !");

		//Listing des données du dossier
		$FolderListing = scandir($fullNameFolder);
		natcasesort($FolderListing);

		//Récupération des informations pour chacun des éléments du dossier
		$FolderListingInfos = array();
		foreach($FolderListing as $file) {
			if($file != "." AND $file != "..")
				$FolderListingInfos[] = getDocInfos(getCoursPath().$folder.$file, $fullNameFolder, $fileTypesList);
		}

		//Renvoi du résultat
		return $FolderListingInfos;
	}

	/**
	 * Permet de renommer un document
	 *
	 * @url POST /API/files/rename
	 */
	public function renameFile(){
		//On vérifie la présence des informations requises
		if(!isset($_POST['newFileName']) OR !isset($_POST['originalFileName']) OR !isset($_POST['folderContainer']))
			throw new RestException(401, "Certaines informations requises sont manquantes !");

		//Extraction des informations
		$newFileName = $_POST['newFileName'];
		$originalFileName = $_POST['originalFileName'];
		$folderContainer = $_POST['folderContainer'];

		//Si le chemin vers le dossier de cours n'est pas indiqué, on l'ajoute
		if(!preg_match('<'.getCoursPath().'>', $folderContainer))
			$folderContainer = getRelativeCoursPath().$folderContainer;
		else
			//Sinon on ne rajoute que le répertoire système
			$folderContainer = getWebsiteRelativePath().$folderContainer;

		//On vérifie la sécurité du nom de dossier
		if($erreur = checkErrorDocPath($folderContainer))
			throw new RestException(401, $erreur);

		//On vérifie que le fichier de destination n'existe pas
		if(file_exists($folderContainer.$newFileName))
			throw new RestException(404, "Un document portant ce nom-l&agrave; existe d&eacute;j&agrave; !");

		//On vérifie l'existence du fichier initial
		if(!file_exists($folderContainer.$originalFileName))
			throw new RestException(404, "Le document source n'a pas ete trouve !");

		//On vérifie la sécurité des noms de fichier indiqués
		if(!checkSafetyName($newFileName))
			throw new RestException(401, "Le nouveau nom de fichier choisi a ete refuse par le systeme !");

		//On vérifie la sécurité des noms de fichier indiqués
		if(!checkSafetyName($originalFileName))
			throw new RestException(401, "Le nom de fichier initial semble incorrect !");
		
		//On peut effectuer le déplacement
		if(!rename($folderContainer.$originalFileName, $folderContainer.$newFileName))
			throw new RestException(404, "Une erreur a survenue lors de la tentative de deplacement du document !");
		else
			//Message de succès
			return array('success' => "Le fichier a bien &eacute;t&eacute; deplac&eacute; vers son emplacement d&eacute;finitif !");

	}

	/**
	 * Permet de vider la corbeille
	 *
	 * @url POST /API/files/emptyTrash
	 */
	public function emptyTrash(){
		//On vérifie que l'action est bien confirmée
		if(!isset($_POST['confirm']))
			throw new RestException(401, "Confirmation required !");

		//On effectue l'action
		delDir(getWebsiteRelativePath().getTrashPath());

		//Message de succès
		return(array("success" => "La corbeille a bien &eacute;t&eacute; vid&eacute;e !"));
	}
}