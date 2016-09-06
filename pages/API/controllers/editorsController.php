<?php
/**
 *	Controlleur de fichiers pour les éditeurs (générique)
 *
 *	@author Pierre HUBERT
 */

use \Jacwright\RestServer\RestException;

class editorsController
{
	/**
	 * Effecue la sauvegarde d'un fichier
	 *
	 * @url POST /API/editors/backup
	 */
	public function filesListing()
	{
		//On vérifie la présence des informations requises
		if(!isset($_POST['fichier']) OR !isset($_POST['source']))
			throw new RestException(401, "Certaines informations requises sont manquantes !");

		//Extraction et détermination d'informations
		$fichier = $_POST['fichier'];
		$source = $_POST['source'];
		$relativeFile = getRelativeCoursPath().$fichier;
		$nomFichier = findLastOccurence($fichier, "/", true);
		$dossierConteneur = getCourspath().findLastOccurence($fichier, "/");

		//On vérifie que la source n'est pas vied
		if($source == "")
			throw new RestException(401, "L'enregistrement des fichiers vide est interdit !");

		//On vérifie l'existence du fichier
		if(!file_exists($relativeFile))
			throw new RestException(404, "Le fichier demand&eacute; n'a pas &eacute;t&eacute; trouv&eacute; !");

		//On vérifie la sécurité du nom du fihicer
		if(!checkSafetyName($nomFichier))
			throw new RestException(401, "L'enregistrement a &eacute;t&eacute; bloqu&eacute; en reaison du nom du fichier !");

		//On vérifie la sécurité du nom de dossier contenant le fichier
		if($erreur = checkErrorDocPath($dossierConteneur))
			throw new RestException(401, $erreur);

		//On détermine le nom de la sauvegarde
		$backupDirectory = getWebsiteRelativePath().getBackupStoragePath();
		$backupPath = $backupDirectory.time()." - ".$nomFichier;

		//On vérifie l'existence du répertoire de sauvegarde
		if(!file_exists($backupDirectory)) {
			if(!mkdir($backupDirectory))
				throw new RestException(401, "Un erreur a survenue lors de la cr&eacute;ation du r&eacute;pertoire de sauvegarde !");
		}

		//On enregistre la sauvegarde
		if(!file_put_contents($backupPath, $source))
			throw new RestException(401, "Un erreur a survenue lors de l'enregistrement de la sauvegarde du fichier !");

		//On enregistre le fichier
		if(!file_put_contents($relativeFile, $source))
			throw new RestException(401, "Un erreur a survenue lors de l'enregistrement du fichier !");

		//Si le script accède à cette ligne, c'est que la sauvegarde est réussie
		return array('success' => "Le fichier a bien &eacute;t&eacute; enregistr&eacute; !");
	}
}
