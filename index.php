<?php
/**
 *	Projet de gestion des fichiers à la façon de oneCloud
 *	Hébergement de destination : une Raspberry PI
 *	Objectif : saisie des cours sans passer par le "cloud"
 *	Projet initialisé en juillet 2016
 *
 * @author Pierre HUBERT
 */
 
/**
 * Initialisation de la page
 **/
include('inc/initPage.php');

/**
 *	Détermination de la page à ouvrir
 */
$page = str_replace("index.php", "", $_SERVER['SCRIPT_NAME']);
$page = str_replace($page, "", $_SERVER['REQUEST_URI']);
if(isInStr($page, '?'))
	$page = strstr($page, "?", true); //On élimine les paramètres supplémaentaires si il y en a
if(preg_match('</>', $page))
	$page = strstr($page, "/", true); //On ne se base pas ici sur les sous-dossiers

//Si nécessaire, on choisit la page par défaut
if($page == "")
	$page = "browser";

//Inclusion - Liste des pages
include('pages/liste_pages.php');

/**
 *	On vérifie si l'utilisateur est bien connecté
 */
if(!isUserLoggedIn()){
	//On vérifie si la page peut être ouverte sans connection de l'utilisateur
	//Pour cela, on doit vérifier que la page existe
	if(isset($liste_pages[$page])){
		if(isset($liste_pages[$page]['needLogin'])) {
			if($liste_pages[$page]['needLogin'])
				$page = "login"; //La page a bien besoin d'une connection de l'utilisateur
		}
		else
			$page = "login"; //Page de connexion sinon...
	}
	else
		$page = "login"; //Page de connexion sinon...
}


//On vérifie si la page demandée existe
if(!isset($liste_pages[$page])){
	//On vérifie si il existe une page d'erreur ou non
	if(!isset($liste_pages['404']))
		exit("404 Not Found ! <a href='./'>Home</a>");
	else
		//Changement de page...
		$page = "404";
}

//On vérifie si le fichier a besoin d'une page HTML
if(!$liste_pages[$page]['needHTML'])
{
	include($liste_pages[$page]['file']); //Inclusion du fichier
	exit(); //Sortie : le fichier est autonome.
}
	
/**
 *	Ouverture de la page
 */
?><!DOCTYPE html>
<html>
	<head>
		<title><?php echo $liste_pages[$page]['title']; ?></title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		
		<!-- Affichage des icones (si il y en a) -->
		<?php if(isset($liste_pages[$page]['pageIcon'])) {?>
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $liste_pages[$page]['pageIcon']; ?>" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $liste_pages[$page]['pageIcon']; ?>" />
		<?php } ?>

		<!-- Inclusion des ressources pour le navigateur -->
		<?php include("pages/utils/views/v_includesRessources.php"); ?>
	</head>
	<body>
		<!-- Inclusion de la page -->
		<?php include($liste_pages[$page]['file']); ?>
	</body>
</html>