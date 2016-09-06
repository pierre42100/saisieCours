<?php
/**
 *	Configuration statique du site
 *	Fichier de gestion de chargement automatique
 *	des fonctions nécessaires au projet
 *
 *	Ne devrait pas avoir à être changé pour un passage
 *	en mode production du site
 *
 *	@author Pierre HUBERT
 */

/**
 *	URI d'accès aux templates
 */
$config['templatesURI'] = "assets/templates/";

/**
 *	URI d'accès aux éléments extérieurs
 */
$config['3rdpartyFolder'] = "3rdparty/";

/**
 * Liste de helpers à appeler
 */
$config['helpers'] = array("globalHelpers", "configHelpers", "assetsHelpers", "thirdPartyHelpers");

/**
 * Liste des fonctions à appeler
 */
$config['functionsFiles'] = array('dates', 'files', 'global', 'strings', "PDF", "users");