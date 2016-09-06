/**
 *	Fonctions de gestion du JSON
 *	Nécessaire pour le bon fonctionnement des APIs
 *
 *	@author Pierre HUBERT
 */

/**
 *	Fonction de décodage de code JSON reçu
 *	Permet la détection de la présence d'une éventuelle erreur
 *
 *	@param	String	Le code JSON reçu
 *	@return	Array	Le code JSON décodé
 */
function decodeJSON(code){
	//On décode le JSON
	var arrayJSON = jQuery.parseJSON(code);

	//On vérifie si il y a une erreur
	if(arrayJSON['error']){
		notifErreur("Une erreur a survenue lors de la communication avec le serveur :" + arrayJSON['error']['mesage']);
	}

	//Renvoi du texte
	return arrayJSON;
}

/**
 *	Fonction de gestion de l'affichage de message de succès (si il y en a)
 *
 *	@param 	String	Le code JSON reçu
 */
function showJSONsuccessMessage(JSONstring){
	//Décodage du résultat
	arrayResult = decodeJSON(JSONstring);

	//On ne continue que si le message de succès est bien présent
	if(arrayResult['success']) {
		//Notification de succès
		notifSucces(arrayResult['success']);
	}
	else
		notifErreur(arrayResult);
}