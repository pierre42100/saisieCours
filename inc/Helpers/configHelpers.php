<?php
/**
 * Config Helpers
 * Helps to make the access to the configuration easier
 *
 * @author Pierre HUBERT
 **/
isset($_SESSION) OR die('unallowed !');

/**
 *	Définition des constantes de la configuration
 */
define('SITE_NAME', $config['siteName']);
define('SITE_URL', $config['siteURL']);
define('SITE_MODE', $config['siteMode']);
define('RELATIVE_PATH', $relativePath);
define('COURS_PATH', $config['cours_path']);
define('TRASH_PATH', $config['trash_path']);
define('ZIP_PATH', $config['stockageZIP']);
define('BACKUP_PATH', $config['backupFolder']);
define('API_URL', $config['APIsURL']);
define('THIRD_PARTY_FOLDER', $config['3rdpartyFolder']);

/**
 * @return Return the URL of the website
 */
function getSiteName(){
	return SITE_NAME;
}

/**
 * @return Return the URL of the website
 */
function getWebsiteUrl(){
	return SITE_URL;
}

/**
 * @return Return the Mode of the website (debug/prod)
 */
function getSiteMode(){
	return SITE_MODE;
}

/**
 * @return Return the relative path to the website
 */
function getWebsiteRelativePath(){
	return RELATIVE_PATH;
}

/**
 *	@param 	String 	Optionnal, specify the user's folder
 *	@return Returns the path to the courses
 */
function getCoursPath($user = "auto"){
	//Si nécessaire, on détermine le dossier de l'utilisateur
	if($user == "auto"){
		$user = (isset($_SESSION['user']['filesLocation']) ? $_SESSION['user']['filesLocation'] : "guest");
	}

	//Renvoi du résultat
	return str_replace('#FOLDER_USER#', $user, COURS_PATH);
}

/**
 *	@return Returns the relative path to the courses
 */
function getRelativeCoursPath(){
	return getWebsiteRelativePath().getCoursPath();
}

/**
 *	@return Returns the path to the trash
 */
function getTrashPath(){
	return getCoursPath().TRASH_PATH;
}

/**
 *	@return Returns the path to the ZIP storage path
 */
function getZIPStoragePath(){
	return getCoursPath().ZIP_PATH;
}

/**
 *	@return Returns the path to the backup storage path
 */
function getBackupStoragePath(){
	return getCoursPath().BACKUP_PATH;
}

/**
 *	@return Returns the URL path to APIS
 */
function getAPIsURL(){
	return API_URL;
}

/**
 *	@return Returns the URI path to 3rdparty elements
 */
function thirdPartyFolder(){
	return THIRD_PARTY_FOLDER;
}
