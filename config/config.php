<?php
/**
 *	Configuration du site
 *	Note : cette configuration est partiellement dynamique pour s'adapter aux
 *	différents supports sur lesquels le service sera installé
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

/**
 *	Nom du site
 */
$config['siteName'] = "saisieCours";

/**
 * URL du site
 * A modifier à chaque mise en ligne du site
 * Doit inclure également si le site est accessible en HTTPS ou non
 */
$config['siteURL'] = "http://".$_SERVER['HTTP_HOST']."/divers/saisieCours/";

/**
 *	Adresse d'accès aux API du site
 *	Nécessaire pour le fonctionnement dynamique du site
 */
$config['APIsURL'] = $config['siteURL']."API/";

/**
 * Définit si le site est ou non en mode de production
 * "debug" pour le développement / débogage
 * "prod" pour la production
 */
$config['siteMode'] = "debug";

/**
 *	Définit à quelle fréquence effectuer les sauvegardes dans les éditeurs en ligne
 *	Indiquer le nombre de seconde entre chaques sauvegardes
 */
$config['editorsBackupFrequence'] = 60;

/**
 * Chemin d'accès au cours
 * Le répertoire doit être ouvert à l'écriture
 */
$config['cours_path'] = "storage/#FOLDER_USER#/";

/**
 * Chemin d'accès à la corbeille
 * Le répertoire doit être ouvert à l'écriture et doit être de préférence
 * contenu dans dans $config['cours_path']
 */
$config['trash_path'] = "Corbeille/";

/**
 * Dossier de stockage des archives ZIP disponibles au téléchargement
 */
$config['stockageZIP'] = "ZIP/";

/**
 *	Dossier de stockage des sauvegardes des éditeurs "live"
 */
$config['backupFolder'] = "Sauvegardes/";

/**
 *	URL d'accès au WebSSH (généralement ShellInABox)
 */
$config['URLwebSSH'] = "http://".$_SERVER['HTTP_HOST'].":4201/";

