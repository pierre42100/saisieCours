<?php
/**
 *  Classe de prise en charge de la connextion au service
 *
 *  @author Pierre HUBERT
 */

//Déclaration du nom de l'espace de travail
namespace Sabre\DAV\Auth\Backend;

//Sécurité
isset($_SESSION) OR die('unallowed !');

//Décalaration de la classe
class loginServiceDAV extends AbstractBasic {

	/**
	 * @var Array   List of the Users
	 */
	protected $users;

	/**
	 * @var String 	Name of the desired user
	 */
	protected $desiredUser;


	/**
	 *  Creates the backend.
	 *
	 *  @param  Array   List of users
	 */
	function __construct(array $users, $desiredUser) {

		$this->users = $users;
		$this->desiredUser = $desiredUser;

	}

	/**
	 * Validates a username and password
	 *
	 * This method should return true or false depending on if login
	 * succeeded.
	 *
	 * @param string $username
	 * @param string $password
	 * @return bool
	 */
	protected function validateUserPass($username, $password) {
		//On vérifie qu'il s'agit bien du bon utilisateur
		if($this->desiredUser != $username)
			return false;

		return loginUser($username, $password, $this->users, true);
	}

}
