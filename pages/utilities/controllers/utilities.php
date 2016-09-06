<?php
/**
 * Controlleur du gestionnaire d'utilitaires
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Détermination de l'URL d'accès au serveur WebDAV
$webDAVURL  = getWebsiteUrl()."webdav/".getInfoUser('filesLocation')."/";

//Inclusion de la vue principale du fichier
include(getWebsiteRelativePath()."pages/utilities/views/v_utilities.php");