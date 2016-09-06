/**
 *	Fichier de gestion des sauvegardes du travail en cours
 *
 *	@author Pierre HUBERT
 */

/**
 *	Fonction de sauvegarde du contenu de l'éditeur
 */
function saveCurrentWorkHMTLeditor(){
	//Récupération du contenu de l'éditeur
	var contentEditor = getAllContentofTinyMCE();

	//On envoi ce contenu en ligne UNIQUEMENT si la source N'EST PAS vide !!!
	if(contentEditor != "") {
		//Préparation des données de la requête
		var datas = [
			['fichier', fileInfos['folderContainer'] + fileInfos['fileName']],
			['source', contentEditor],
		];



		//On envoi la modification au serveur
		postAJAX(config['APIsURL']+"editors/backup", datas, (function(result){
			//Affichage du résultat
			showJSONsuccessMessage(result);

			//Information dans la console
			console.log("Sauvegarde du fichier : " + fileInfos['fileName'] + " effectuee.")
		}));
	}
}

/**
 *	Fonction permettant d'accéder à l'export en PDF du document
 */
function exportHTMLeditorToPDF(){
	//Génération de l'URL de destination (dans les APIs)
	var urlPDF = config['APIsURL'] + "HTMLeditor/exportPDF?file=" + encodeURIComponent(fileInfos['folderContainer'] + fileInfos['fileName']);

	//Ouverture de la page
	window.open(urlPDF);
}