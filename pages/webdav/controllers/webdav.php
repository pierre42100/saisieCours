<?php
/**
 *	Controlleur du serveur WebDAV
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

use
    Sabre\DAV;

// The autoloader
require getWebsiteRelativePath().'3rdparty/sabreDav/autoload.php';

//Détermination de l'utilisateur
$user = findLastOccurence($_SERVER['REDIRECT_URL'], "webdav/", true);
$user = findFirstOccurence($user, "/", true);
if(strlen($user) < 2)
	exit("Veuillez specifier votre nom d'utilisateur dans l'adresse !");

//Détermination de l'URI de base
$baseUri = findLastOccurence($_SERVER['REDIRECT_URL'], "webdav");
$baseUri .= "webdav/".$user."/";

//On vérifie l'existence du dossier
if(!$filesLocation = getInfoUser("filesLocation", $user))
	exit("Dossier non trouve !");

// Now we're creating a whole bunch of objects
$coursDirectory = getWebsiteRelativePath().getCoursPath($user);
$rootDirectory = new DAV\FS\Directory($coursDirectory);

// The server object is responsible for making sense out of the WebDAV protocol
$server = new DAV\Server($rootDirectory);

//Authentification du service
include('authWebDav.php');

// If your server is not on your webroot, make sure the following line has the
// correct information
$server->setBaseUri($baseUri);

// This ensures that we get a pretty index in the browser, but it is
// optional.
$server->addPlugin(new DAV\Browser\Plugin());

// All we need to do now, is to fire up the server
$server->exec();