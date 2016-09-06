<?php
/**
 *	Fonction de gestion des utilisateurs
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

/**
 *	Fonction permettant de déterminer si l'utilisateur est connecté
 *	au service ou non
 *
 *	@return 	Boolean 	True or False
 */
function isUserLoggedIn(){
	return (isset($_SESSION['user']) ? true : false);
}

/**
 *	Fonction permettant de crypter le mot de passe d'un utilisateur
 *
 *	@param 	String 	Le mot de passe à crypter
 *	@return String 	Le mot de passe crypté
 */
function cryptPasswordUser($password){
	//On hache tout d'abord le mot de passe
	$hash = sha1($password);

	//Enfin on le crypte
	return crypt($hash, $hash);
}

/**
 *	Fonction permettant de tenter de connecter un utilisateur
 *
 *	@param 	String 	User Login
 *	@param 	String 	User Password
 *	@param 	Array 	Users List
 *	@param 	Boolean Optionnel, permet de spécifier si il faut jute vérifier la connexion
 *	et non pas connecter l'utilisateur
 *	@return Boolean Depending of the result of the operation
 */
function loginUser($user, $password, array $users, $justCheck = false) {
	//Vérification de l'existence de l'utilisateur
	if(!isset($users[$user]))
		return false;

	//On vérifie le mot de passe de l'utilisateur
	if($users[$user]["password"] != cryptPasswordUser($password))
		return false;

	//Les informations données sont  correctes, on peut connecter l'utilisateur
	if(!$justCheck)
		$_SESSION['user'] = $users[$user];
	
	//Authentification correcte
	return true;
}

/**
 *	Fonction permettant de déconnecter un utilisateur
 */
function logoutUser(){
	//Suppression des informations de connexion
	unset($_SESSION['user']);
}

/**
 *	Fonction permettant de récupérer des informations sur l'utilisateur
 *
 *	@param 	String 	Le nom de l'information à récupérer
 *	@param 	String 	Optionnel, permet de spécifier un nom d'utilisateur précis
 *	@return String 	L'information demandée
 */
function getInfoUser($nomInfo, $user = "current"){
	//On vérifie si il s'agit de l'utilisateur connecté
	if($user == "current"){
		if(!isset($_SESSION['user'][$nomInfo]))
			return false;
			return $_SESSION['user'][$nomInfo];
	}

	//Sinon on parcours la liste des utilisateurs pour récupérer le bon
	//Inclusion de la liste d'utilisateurs
	include(getWebsiteRelativePath()."config/userLogin.php");

	//On vérifie si l'on a l'information
	if(!isset($users[$user][$nomInfo]))
		return false;

	//On renvoi l'information
	return $users[$user][$nomInfo];
}
