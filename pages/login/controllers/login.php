<?php
/**
 *	Controlleur de la page de connexion au service
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

/**
 *	On vérifie si l'utilisateur demande à être déconnecté
 */
if(isset($_GET['logout'])) {
	//Déconnexion de l'utilisateur
	logoutUser();

	//Message de succès
	$loginSuccess = "Vous &ecirc;tes bien d&eacute;connect&eacute;. Au revoir !";
}


/**
 *	Si l'utilisateur est connecté, on le redirige vers la page d'acceuil du site
 */
if(isUserLoggedIn())
	header('Location: '.getWebsiteUrl());


/**
 *	Détermination de l'adresse de redirection à utiliser une fois l'utilisateur connecté
 */
if(isset($_GET['redirect_url']))
	$redirect_url = urlencode($_GET['redirect_url']);
else
	$redirect_url = urlencode($_SERVER['REQUEST_URI']);
//On vérifie qu'il n'y ait pas "logout" dans l'URL
$redirect_url = str_replace('logout', '', $redirect_url);


/**
 *	On vérifie si une demande de connexion a été formulée
 */
if(isset($_POST['user']) AND isset($_POST['password'])) {
	//Extraction des informations
	$user = $_POST['user'];
	$password = $_POST['password'];

	if($user == "" OR $password == "")
		$loginError = "Il est n&eacute;cessaire de sp&eacute;cifier un identifiant et un mot de passe avant de continuer !";

	//On tente de connecter l'utilisateur
	if(!loginUser($user, $password, $users))
		$loginError = "L'identifiant ou le mot de passe est/sont incorrects !";
	else
		//Redirection vers la page d'acceuil du site
		header('Location: '.urldecode($redirect_url));
}


/**
 *	Inclusion de la vue principale du fichier
 */
include(getWebsiteRelativePath()."pages/login/views/v_login.php");