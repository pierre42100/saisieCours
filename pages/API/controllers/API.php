<?php
/**
 *	API Server du service
 *
 *	@author Pierre HUBERT
 */

//Appel du restful server
require(path_3rdparty_relative("RestServer/RestServer.php"));

//Inclusion des controlleurs
$APIcontrollerList = array(
	"filesController",
	"editorsController",
	"HTMLeditorController",
	"usersController",
);
foreach($APIcontrollerList as $call)
	require_once($call.".php");

//Inclusion du controlleur principal
require_once("mainController.php");

//Appel du serveur
$serverMode = (getSiteMode() == "debug" ? "debug" : "production");
$server = new \Jacwright\RestServer\RestServer($serverMode);

//Inclusion des controlleurs
foreach($APIcontrollerList as $call)
	$server->addClass($call);

//Prise en charge par le serveur
$server->handle();