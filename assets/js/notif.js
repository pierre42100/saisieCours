/**
 *	Fonctions de gestion des notifications dynamiques
 *	type "Metro"
 *
 *	@author Pierre HUBERT
 */

 /**
  * Affichage d'une erreur
  *
  * @param	String	Texte de l'erreur
  */
function notifErreur(message) {
	$.Notify({
		caption: 'Erreur',
		content: message,
		type: 'alert'
	});
}

/**
 *	Affichage d'un message de succès
 *
 *	@param	String	Texte du message de succès
 */
function notifSucces(message){
	$.Notify({
		caption: 'Bravo !',
		content: message,
		type: 'success'
	});
}