<?php
/**
 *	Controlleur de fichiers pour les éditeurs (générique)
 *
 *	@author Pierre HUBERT
 */

use \Jacwright\RestServer\RestException;

class HTMLeditorController
{
	/**
	 * Effecue la sauvegarde d'un fichier
	 *
	 * @url GET /API/HTMLeditor/exportPDF
	 */
	public function exportPDF()
	{
		//On vérifie la présence des informations requises
		if(!isset($_GET['file']))
			throw new RestException(401, "Certaines informations requises sont manquantes !");

		//Extraction et détermination d'informations
		$fichier = $_GET['file'];
		$relativeFile = getRelativeCoursPath().$fichier;
		$fileName = findLastOccurence($fichier, "/", true);

		//On vérifie la sécuritée du nom donné
		if(isInStr($fichier, "../"))
			throw new RestException(401, "Le fichier n'est pas autoris&eacute; au t&eacute;l&eacute;chargement !");

		//Récupération du contenu du fichier
		if(!file_exists($relativeFile))
			throw new RestException(404, "Le fichier n'a pas &eacute;t&eacute; trouv&eacute; !");
		
		//On vérifie qu'il s'agit bien d'un fichier
		if(fileType($relativeFile) != "file")
			throw new RestException(401, "Le document demand&eacute; n'est pas un fichier !");

		//Récupération du contenu du fichier
		if(!$HTMLsource = file_get_contents($relativeFile))
			throw new RestException(404, "Une erreur a survenue lors de la recup&eauc;ration du fichier !");

		//Inclusion de TCPDF
		includeTCPDF();

		//Génération du PDF
		generatePDFfromHTML($HTMLsource, $fileName." - export");

		//Sortie du fichier pour éviter les problème d'encodage
		exit();
	}
}