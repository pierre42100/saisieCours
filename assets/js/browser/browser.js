/**
 * Fonctions du gestionnaire de fichiers du projet
 *
 * @author Pierre HUBERT
 */

/**
 *	Fonction de gestion de l'ouverture des Charms d'un document
 *
 * @param	String	idElem is the ID of the element in the list
 * @param	String	docType is the type of the current document
 */
function openCharmDocument(idElem, docType){

	//ID de la "charm"
	idCharmContainer = "docCharm";

	//Récupération des éléments nécessaires
	var elemSource = document.getElementById(idElem);
	var elemTitle = document.getElementById('docCharmName');
	var charmContainer = document.getElementById(idCharmContainer);
	var fileInfosContainer = getFirstElementByClass(charmContainer, 'infosFile');

	//Préparation de la récupération des données
	var datasElem = elemSource.getElementsByTagName('datas')[0];

	//Récupération du nom du document
	var documentTitle = getFirstElementByClass(elemSource, 'nomDoc').innerHTML;

	//Récupération de l'image illustrant le document
	var ImageDocElem = getFirstElementByClass(elemSource,'docImage');
	var docImage = ImageDocElem.src;

	//Préparation et affichage du titre
	var returnTitle = "<img src='"+docImage+"' /> " + documentTitle;
	elemTitle.innerHTML = returnTitle;

	//Préparation du bouton "Renommer"
	var docCharmRenameButton = getFirstElementByClass(charmContainer, 'docCharmRenameButton');

	docCharmRenameButton.onclick = (function(){
		openRenameDocumentDialogue(documentTitle);
	});

	//Préparation du bouton "Supprimer"
	var docCharmDeleteButton = getFirstElementByClass(charmContainer, 'docCharmDeleteButton');

	docCharmDeleteButton.onclick = (function(){
		openDeleteConfirmDialog(documentTitle);
	});

	//Préparation du bouton "Déplacer"
	var docCharmMoveButton = getFirstElementByClass(charmContainer, 'docCharmMoveButton');

	docCharmMoveButton.onclick = (function(){
		openMoveFileDialog(documentTitle);
	})

	//Téléchargement du document
	var forceDownloadLink = datasElem.getElementsByClassName('forceDownloadLink')[0].innerHTML;
	charmContainer.getElementsByClassName('forceDownloadLink')[0].onclick = (function() {
		//Redirection vers le téléchargement du fichier
		location.href = etampTOet(forceDownloadLink);
	});

	//Traitemnts spécifiques aux dossiers
	if(docType == "folder") {
		fileInfosContainer.style.display = "none";
	}

	//Traitements spécifiques aux fichiers
	if(docType == "file") {

		//Récupérations des informations
		var completeFileType = datasElem.getElementsByClassName('explainType')[0].innerHTML;
		var fileSize = datasElem.getElementsByClassName('fileSize')[0].innerHTML;
		var lastEditFile = datasElem.getElementsByClassName('lastEditFile')[0].innerHTML;

		//Ecriture des éléments
		charmContainer.getElementsByClassName('fileSize')[0].innerHTML = fileSize;
		charmContainer.getElementsByClassName('fileType')[0].innerHTML = completeFileType;
		charmContainer.getElementsByClassName('lastEditFile')[0].innerHTML = lastEditFile;

		//Panneau d'informations visible
		fileInfosContainer.style.display = "block";
	}

	//Ouverture du charm
	showCharm("#" + idCharmContainer, false);

}


/**
 *	Fonction de gestion de l'ouverture d'une boîte de dialogue
 *	pour renommer un fichier ou un dossier
 *
 *	@param	String	The name of the document
 */
function openRenameDocumentDialogue(docName){
 	//Définition de l'ID de la boîte de dialogue
 	idDialog = 'renameDocument';

 	//Récupération de l'élément source
 	var dialogueContainer = document.getElementById(idDialog);

 	//Changement de la destination de la requête
 	dialogueContainer.getElementsByTagName('form')[0].setAttribute('action', location.href);

 	//Changement du nom initial du dossier
 	getFirstElementByClass(dialogueContainer, "actualFileName").value = docName;

 	//Changement du nom du dossier dans l'input de saisie
 	getFirstElementByClass(dialogueContainer, "newName").value = docName;

 	//Affichage de la console
 	showDialog("#" + idDialog);
}

/**
 * Fonction de gestion de l'ouverture d'une boîte de dialogue de confirmation
 * de suppression d'un document
 *
 *	@param	String	The name of the document
 */
function openDeleteConfirmDialog(docName){
	confirmDialog("Voulez-vous vraiment supprimer le document <i>" + docName + "</i> ?", (function(){
		//Redirection vers la page de suppression
		sendAutoForm(location.href, [["deleteDoc", docName]]);
	}));
}

/**
 * Fonction de gestion de l'ouverture de la boîte de dialouge pour l'upload
 * de fichiers
 */
function openUploadFilesDialog(){
	uploadDialog("Mise en ligne d'un fichier", (function(){

		//Modification du formulaire
		var formUpload = inputFile.parentNode.parentNode;
		formUpload.setAttribute("action", location.href);
		inputFile.setAttribute("name", "uploadFile");

		//Envoi du fichier en ligne
		formUpload.submit();
	}));
}

/**
 *	Fonction de gestion de l'ouverture de la boîte de dialogue
 *	Pour le déplacement d'un fichier
 *
 *	@param 	String 	The name of the document
 */
function openMoveFileDialog(docName) {
	pickLocationDialog("O&ugrave; souhaitez-vous d&eacute;placer <i>"+docName+"</i> ?", (function(targetURL) {
		//Préparation des données
		var datas = [["moveFile", docName], ["targetMoveFolder", targetURL]];

		//On envoi le formulaire à la page web
		sendAutoForm(location.href, datas);
	}));
}

/**
 *	Fonction de gestion de la création d'un fichier HTML vide
 */
function createEmptyHTMLDialog(){
	inputTextDialog("Saisissez un nom pour le nouveau fichier HTML (sans extension ni caract&egrave;re sp&eacute;ciaux).", "Saisissez ici le nom du fichier...", (function(nomFichier){
		//On envoi le nom du fichier à la page
		var datas = [["newFileName", nomFichier + ".html"]];

		//Envoi du formulaire
		sendAutoForm(location.href, datas);
	}));
}

/**
 *	Fonction de gestion de la création d'un dossier
 */
function createFolderDialog(){
	inputTextDialog("Nouveau dossier", "Saisissez ici le nom du dossier...", (function(nomDossier){
		//On envoi le nom du fichier à la page
		var datas = [["newFolderName", nomDossier]];

		//Envoi du formulaire
		sendAutoForm(location.href, datas);
	}));
}

/**
 *	Fonction de changement automatique de dossier
 *
 *	@param	String	The URL of the new Folder
 */
function changeFolder(folder){
	//Récupération des éléments requis
	var listContainer = getFirstElementByClass(document, "list-type-tiles");
	var folderName = getFirstElementByClass(document, "currentFolderName");

	//Récupération du contenu du dossier
	getAJAX(config['APIsURL'] + "files/listing?folder=" + encodeURIComponent(folder), (function(datas){
		//Décodage JSON des données
		var datasArray = decodeJSON(datas);

		//On vide la liste actuelle des dossiers
		listContainer.innerHTML = "";

		//Bouton permettant de passer au dossier supérieur
		var folderUPbutton = document.createElement('a');
		folderUPbutton.setAttribute('class', "list");
		folderUPbutton.onclick = (function(){
			changeFolder(findFolderUp(folder));
		})

			//Image du bouton du dossier vers le haut
			var folderUPimg = document.createElement('img');
			folderUPimg.setAttribute('class', 'list-icon');
			folderUPimg.setAttribute('src', config['pathAssets']+"img/folder_up.png");
			folderUPbutton.appendChild(folderUPimg);

			//Titre du bouton du dossier vers le haut
			var folderUPtext = document.createElement('span');
			folderUPtext.setAttribute('class', 'list-title');
			folderUPtext.innerHTML = "Dossier sup&eacute;rieur";
			folderUPbutton.appendChild(folderUPtext);

		//Application du bouton
		listContainer.appendChild(folderUPbutton);

		//Traitment des éléments un par un
		var count = 0;
		for(i in datasArray) {
			//On vérifie que le champ existe
			if(datasArray[i]["fileTypeInfos"]){

				//Détermination de l'ID de la tuile
				idTile = "elemDyna_" + count;

				//Création de la tuile
				var docTile = document.createElement("div");

				//Attributs de la tuile principale
				docTile.setAttribute('class', "list");
				docTile.setAttribute('id', idTile);

					//Plus d'option
					var moreOptionsButton = document.createElement('span');
					moreOptionsButton.setAttribute('class', "more-option-button mif-more-vert");
					moreOptionsButton.setAttribute('title', datasArray[i]['fileTypeComplete'])
					moreOptionsButton.onclick = (function(){
						openCharmDocument(this.parentNode.id, this.title);
					})
					docTile.appendChild(moreOptionsButton);

					//Contenu de la tuile
					var tileInner = document.createElement('div');
					tileInner.setAttribute('class', 'tile-inner');

					//Définition du comportement de la tuile lorsque l'on clique dessus
					if(datasArray[i]['fileType'] == "dir") {
						tileInner.setAttribute("data-folder", datasArray[i]['simplePath']);
						tileInner.onclick = (function(){
							//On permet le changement de dossier
							changeFolder(this.getAttribute('data-folder'));
						});
					}else{
						//Si c'est un fichier, un rechargement de page s'impose
						tileInner.setAttribute("data-targetURL", datasArray[i]['linkURL']);
						tileInner.onclick = (function(){
							location.href = this.getAttribute("data-targetURL");
						});
					}

						//Image du document
						var tileImg = document.createElement('img');
						tileImg.setAttribute('class', 'list-icon docImage');
						tileImg.setAttribute('src', datasArray[i]["fileTypeInfos"][1]);
						tileInner.appendChild(tileImg);

						//Nom du document
						var docName = document.createElement('span');
						docName.setAttribute('class', 'list-title nomDoc');
						docName.innerHTML = datasArray[i]['nom'];
						tileInner.appendChild(docName);

					//Application du contenu de la tuile
					docTile.appendChild(tileInner);

					//Données associées
					var datasContainer =  document.createElement('datas');

						//Traitement récursif des données
						var datas = datasArray[i]['datas'];
						for(data in datas){
							//Création et application de l'élément (information)
							var dataInfo = document.createElement('info');
							dataInfo.setAttribute('class', data);
							dataInfo.innerHTML = datas[data];
							datasContainer.appendChild(dataInfo);
						}

					//Application des données
					docTile.appendChild(datasContainer);

				//Entrée en application de la tuile
				listContainer.appendChild(docTile);

				//Incrémentation
				count++;
			}
	}

		//On affiche le dossier courant
		folderName.innerHTML = folder;

		//On change l'URL de la page
		changeURLpage(config['siteURL'] + "browser?dossier=" + encodeURIComponent(folder));

		//Changementu du dossier actuel dans la configuration dynamique
		browserConfig['currentFolder'] = folder;
	}));
}