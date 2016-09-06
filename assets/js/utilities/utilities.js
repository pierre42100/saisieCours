/**
 *	Gestionnaire d'utilitaires du service
 *
 *	@author	Pierre HUBERT
 */


/**
 *	Fonction de gestion du cryptage d'un mot de passe
 */
function cryptPasswordsDialog(){

	// Récupération des éléments requis
	var cryptPasswordElem = byId("cryptPasswordTarget");
	var	cryptPasswordResult = byId('cryptPasswordResult');

	//Appel de la fonction de cryptage
	cryptPassword(cryptPasswordElem.value, (function(requestResult){
		//Décodage du résultat
		arrayResult = decodeJSON(requestResult);

		//Ecriture du résultat
		cryptPasswordResult.innerHTML = arrayResult['password'];

		//Nettoyage du champ source
		cryptPasswordElem.value = "";
	}));
}

/**
 *	Fonction de gestion de l'affichage d'une boîte de dialogue pour vider la corbeille
 */
function emptyTrashDialog() {
	confirmDialog("Voulez-vous vraiment vider la corbeille ?", (function(){
		//Préparation de la requête
		var url = config['APIsURL']+"files/emptyTrash";
 		var datas = [
 			["confirm", confirm],
 		];

 		//Envoi de la requête
 		postAJAX(url, datas, (function(result){
 			//Affichage d'un message de succès
 			showJSONsuccessMessage(result);
 		}));
	}));
}