<?php
/**
 * Controlleur du gestionnaire d'accès au WebSSH
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Inclusion de la vue principale du fichier
include(getWebsiteRelativePath()."pages/webSSH/views/v_webSSH.php");