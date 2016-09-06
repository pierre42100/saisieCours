<?php
/**
 * Fonctions sur les chaînes de caractères
 *
 *	@author	Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

/**
 *	Détermine si une chaîne de caractère est contenue dans une autre
 *
 *	@param 	String 	La chaîne de caractère principale
 * 	@param 	String 	La chaîne de caractère à rechercher dans la principale
 */
function isInStr($main, $search) {
	if(str_replace($search, "", $main) != $main)
		return true; //Elle est présente
	else
		return false; //Elle n'est pas présente
}

/**
 *	Réduit une chaîne de caractère en fonction de la dernière
 * 	occurence d'un caractère
 *
 *	@param 	String 	La chaîne de caractère principale
 * 	@param 	String 	La chaîne de recherche
 * 	@param 	Boolean Optionnel, il permet de choisir si il faut 
 *	prendre ce qu'il y a avant ou après le caractère (par défaut derrière)
 * 	@return String 	Le résultat de la fonction
 */
function findLastOccurence($chaine, $recherche, $after = false){
	$array_chaine = explode($recherche, $chaine);

	//Si il ne faut renvoyer que la fin ($after)...
	if($after)
		return $array_chaine[count($array_chaine) - 1]; //Renvoi de la dernière occurence
	else
		unset($array_chaine[count($array_chaine) - 1]); //Suppression de la dernière occurence

	//Rassemblement du tableau en une chaîne et renvoi du résultat
	return implode($recherche, $array_chaine);
}

/**
 *	Réduit une chaîne de caractère en fonction de la première
 * 	occurence d'un caractère
 *
 *	@param 	String 	La chaîne de caractère principale
 * 	@param 	String 	La chaîne de recherche
 * 	@param 	Boolean Optionnel, il permet de choisir si il faut 
 *	prendre ce qu'il y a avant ou après le caractère (par défaut avant)
 * 	@return String 	Le résultat de la fonction
 */
function findFirstOccurence($chaine, $recherche, $before = false){
	$array_chaine = explode($recherche, $chaine);

	//Si il ne faut renvoyer que la fin ($before)...
	if($before)
		return $array_chaine[0]; //Renvoi de la dernière occurence
	else
		unset($array_chaine[0]); //Suppression de la première occurence

	//Rassemblement du tableau en une chaîne et renvoi du résultat
	return implode($recherche, $array_chaine);
}

/**
 *	Fonction de suppression du chemin pour rendre le fichier plus lisible
 *
 *	@param 	String 	The name of the file with the path
 * 	@param 	String 	The path to remove to the file
 *	@return String 	The function result
 */
function removepath($file, $path){
	return str_replace($path, "", $file);
}

/**
 *	Fonction de recherche du dossier supérieur
 *
 *	@param 	String 	The current path
 * 	@return String 	The function result
 */
function find_folder_up($path) {
	//On vérifie si l'on est à la racine ou passthru
	if($path == "" OR $path == "/")
		return $path;
	
	//Si il n'y a qu'un dossier
	if(!preg_match('</>', $path))
		return "/";
	
	//Découpage dans un tableau
	$array_path = explode("/", $path);
	$count = count($array_path);
	
	//On supprime la dernière entrée si elle est vide
	if($array_path[$count-1] == "")
		unset($array_path[$count-1]);
	
	//On recalcule...
	$count = count($array_path);
	
	//On supprime un niveau
	unset($array_path[$count-1]);
	
	//On renvoi le tableau décomposé
	return implode("/", $array_path);
}
