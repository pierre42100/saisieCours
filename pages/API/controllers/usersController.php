<?php
/**
 *	Controlleur pour les utilisateurs
 *
 *	@author Pierre HUBERT
 */

use \Jacwright\RestServer\RestException;

class usersController
{
	/**
	 * Permet de crypter un mot de passe
	 *
	 * @url POST /API/users/encodePassword
	 */
	public function cryptPassword()
	{
		//On vérifie la présence des informations requises
		if(!isset($_POST['password']))
			throw new RestException(401, "Certaines informations requises sont manquantes !");

		//On crypte le mot de passe
		$crypt = cryptPasswordUser($_POST['password']);

		//On retourne  le mot de passe crypté
		return array("password" => $crypt);
	}

	/**
	 *	Permet de déconnecter l'utilisateur
	 *
	 * @url GET /API/users/logout
	 */
	public function userLogout(){
		//Déconnexion de l'utilisateur
		logoutUser();

		//Message de succès
		return(array("success" => "Utilisateur d&eacute;connect&eacute; !"));
	}
}