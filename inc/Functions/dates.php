<?php
/**
 *	Fonctions de gestion des dates
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

/**
 * Fonction rendant les dates lisibles par les humains
 *
 *	@param 	String 	The string of the date.
 * 	@param 	Int 	(Optionnal) The timestamp of date
 */
function adapte_date($source, $timestamp = 0)
{
	if($timestamp == 0) 
		$timestamp = to_timestamp($source)-3600; //Exemple de date : 2013-11-16 14:30:00
		
	$now = time();
	$difference = $now-$timestamp;
	
	if($difference == 0) //Il y a moins d'une seconde
		return "Il y a quelques instants";
	elseif($difference == 1) //Il y a une seconde
		return "Il y a une seconde";
	elseif($difference <= 60) //Inférieur à une minute
		return "Il y a ".$difference." secondes";
	elseif($difference <= 3600) //Inférieur à une heure
	{
		$nb_minutes = floor($difference/60);
		if($nb_minutes == 1)
			return "Il y a une minute";
		else
			return "Il y a ".$nb_minutes." minutes";
	}
	elseif($difference <= 86400) //Inférieur à un jour
	{
		$nb_heures = floor(($difference/60)/60);
		if($nb_heures == 1)
			return "Il y a une heure";
		else
			return "Il y a ".$nb_heures." heures";
	}
	elseif($difference <= 2678400) //Inférieur à un mois
	{
		$nb_jours = floor((($difference/60)/60)/24);
		if($nb_jours == 1)
			return "Il y a un jour";
		else
			return "Il y a ".$nb_jours." jours";
	}
	elseif($source != "") //On affiche le jour précis
	{
		//On se sert du timestamp : $timestamp
		$datas_date = date( "w|j|n|Y|H|i|s" , $timestamp);
		$array_date = explode('|', $datas_date);
		
		//On vérifie que la date est correcte
		if(count($array_date) != 7)
			return $date; //Rien à faire
		
		//Définition des données
		$days = array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
		$months = array("janvier", "f&eacute;vrier", "mars", "avril", "mai", "juin", "juillet", "ao&ucirc;t", "septembre", "octobre", "novembre", "d&eacute;cembre");
		
		
		//Renvoi du résultat
		return "Le ".$days[$array_date[0]]." ".$array_date[1]." ".$months[$array_date[2]-1]." ".$array_date[3]." &agrave; ".$array_date[4].":".$array_date[5].":".$array_date[6];
	}
	else //Rien à faire, on renvoi la date
		return $source;
}