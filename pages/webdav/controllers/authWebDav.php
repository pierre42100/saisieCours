<?php
/**
 *	Controlleur du service d'authentification WebDAV
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Inclusion de la classe d'authentification
require getWebsiteRelativePath().'pages/webdav/classes/loginServiceDAV.php';

/**
 *	Connexion au service
 */
use Sabre\DAV\Auth;
$authBackend = new Auth\Backend\loginServiceDAV($users, $user);
$authPlugin = new Auth\Plugin($authBackend);

//Ajout du plugin
$server->addPlugin($authPlugin);