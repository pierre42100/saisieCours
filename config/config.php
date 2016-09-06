<?php
/**
 *	Configuration du site
 *	Note : cette configuration est partiellement dynamique pour s'adapter aux
 *	diff�rents supports sur lesquels le service sera install�
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
 * A modifier � chaque mise en ligne du site
 * Doit inclure �galement si le site est accessible en HTTPS ou non
 */
$config['siteURL'] = "http://".$_SERVER['HTTP_HOST']."/divers/saisieCours/";

/**
 *	Adresse d'acc�s aux API du site
 *	N�cessaire pour le fonctionnement dynamique du site
 */
$config['APIsURL'] = $config['siteURL']."API/";

/**
 * D�finit si le site est ou non en mode de production
 * "debug" pour le d�veloppement / d�bogage
 * "prod" pour la production
 */
$config['siteMode'] = "debug";

/**
 *	D�finit � quelle fr�quence effectuer les sauvegardes dans les �diteurs en ligne
 *	Indiquer le nombre de seconde entre chaques sauvegardes
 */
$config['editorsBackupFrequence'] = 60;

/**
 * Chemin d'acc�s au cours
 * Le r�pertoire doit �tre ouvert � l'�criture
 */
$config['cours_path'] = "storage/#FOLDER_USER#/";

/**
 * Chemin d'acc�s � la corbeille
 * Le r�pertoire doit �tre ouvert � l'�criture et doit �tre de pr�f�rence
 * contenu dans dans $config['cours_path']
 */
$config['trash_path'] = "Corbeille/";

/**
 * Dossier de stockage des archives ZIP disponibles au t�l�chargement
 */
$config['stockageZIP'] = "ZIP/";

/**
 *	Dossier de stockage des sauvegardes des �diteurs "live"
 */
$config['backupFolder'] = "Sauvegardes/";

/**
 *	URL d'acc�s au WebSSH (g�n�ralement ShellInABox)
 */
$config['URLwebSSH'] = "http://".$_SERVER['HTTP_HOST'].":4201/";

