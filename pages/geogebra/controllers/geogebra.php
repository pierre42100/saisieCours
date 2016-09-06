<?php
/**
 * Controlleur du gestionnaire d'accès à GéoGebra
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Inclusion de la vue principale du fichier
include(getWebsiteRelativePath()."pages/geogebra/views/v_geogebra.php");