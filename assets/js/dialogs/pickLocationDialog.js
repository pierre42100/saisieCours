/**
 *	Fonctions de la boîte de dialogue de choix d'emplacement
 *
 *	@author	Pierre HUBERT
 */


/**
 *	ID de contact de la boîte de dialogue de choix d'emplcament
 */
var idPickLocationDialog = "pickLocationDialog";

/**
 *	Récupération de la boîte de dialogue
 *
 *	@return La boîte de dialogue
 */
function getPickLocationDialog(){
	//Renvoi de l'élément "boîte de dialogue"
 	return document.getElementById(idPickLocationDialog);
}

/**
 *	Fonction de récupération de l'emplacement actuel de la boîte de dialogue
 *
 *	@return String 	Current location
 */
function getCurrentLocationPickLocationDialog(){
	//Récupération du conteneur
	var dialogueElem = getPickLocationDialog();

	return getFirstElementByClass(dialogueElem, "locationSelected").innerHTML;
}

/**
 *	Fonction de définition d'un nouvel emplacement pour la boîte de dialogue
 *
 *	@param 	String	Nouvel emplacement
 */
function setNewLocationPickLocationDialog(newLocation) {
	//Récupération du conteneur
	var dialogueElem = getPickLocationDialog();

	//Changement de l'emplacement dans la barre d'adresse
	getFirstElementByClass(dialogueElem, "locationSelected").innerHTML = newLocation;

	//Actualisation de la liste des dossiers
	showDocsinFolderforPickLocationDialog(newLocation);
}

/**
 *	Fonction de gestion de l'affichage du contenu d'un dossier dans la boîte
 *	de dialogue de choix d'emplacement d'un dossier
 *
 *	@param 	String	The path to the folder
 */
function showDocsinFolderforPickLocationDialog(folder) {
	//Récupération de l'emplcament de destination
	var filesTarget = getFirstElementByClass(getPickLocationDialog(), "filesOfLocation");

	//Nettoyage de l'élément
	filesTarget.innerHTML = "";

	//Requête AJAX de recherche
	getAJAX(config['APIsURL'] + "files/listing?folder=" + encodeURIComponent(folder), (function(datas){
		//Décodage JSON des données
		var datasArray = decodeJSON(datas);

		//Traitement des donnees une par une
		for(n in datasArray){
			//On vérifie que les données demandées existent
			if(datasArray[n].nom){
				var file = document.createElement("div");

				//Image d'illustration
				var imgDoc = document.createElement('img');
				imgDoc.setAttribute('src', datasArray[n]['fileTypeInfos'][1]);
				file.appendChild(imgDoc);

				//Nom du document
				var nomDoc = document.createElement('span');
				nomDoc.innerHTML = datasArray[n]['nom'];
				file.appendChild(nomDoc);

				//On rend la tuile dynamique si il s'agit d'un dossier
				if(datasArray[n]['fileType'] == "dir") {
					file.setAttribute('title', datasArray[n]['simplePath']);
					file.onclick = (function(){
						setNewLocationPickLocationDialog(this.title);
					});
				}

				//Application du nouvel élément au conteneur de fichiers
				filesTarget.appendChild(file);
			}
		}
	}));
}

 /**
 *	Fonction de gestion de l'ouverture d'une boîte de dialogue pour
 *	choisir un emplacement
 *
 *	@param 	String	 Titre à afficher dans la boîte de dialogue
 * 	@param 	function What to do next...
 */
function pickLocationDialog(titre, nextAction) {
	//Récupération des éléments requis
	var dialogueElem = getPickLocationDialog();

 	//Modification du texte d'information
 	getFirstElementByClass(dialogueElem, "messageInfo").innerHTML = titre;

 	//Modification de l'action de confirmation
 	getFirstElementByClass(dialogueElem, "buttonConfirm").onclick = (function(){
 		//On appelle l'action suivante avec le choix de répertoire définitif
 		nextAction(getCurrentLocationPickLocationDialog());
 	});

 	//Modification de l'action du boutton d'annulation
 	getFirstElementByClass(dialogueElem, "buttonCancel").onclick = (function(){
 		//Fermeture de la boîte de dialogue
 		closeDialog('#' + idPickLocationDialog);
 	});

 	//Modification de l'action du bouton "Folder UP"
 	getFirstElementByClass(dialogueElem, "folderUP").onclick = (function(){
 		//Recherche et affichage du dossier supérieur
 		setNewLocationPickLocationDialog(findFolderUp(getCurrentLocationPickLocationDialog()));
 	});

 	//Affichage de la racine par défaut
 	setNewLocationPickLocationDialog('/');

 	//Affichage de la boîte de dialogue
 	showDialog('#' + idPickLocationDialog);
}

