/**
 *	Fonctions de gestion du champ de texte permettant d'éditer le nom du fichier
 *
 *	@author Pierre HUBERT
 */

/**
 *	Fonction de gestion du changement du nom du fichier
 */
function ChangeNamgeFile(){
	//On récupère le nom
	var newName = fileNameElem.value;

	//On fait une pause de trois secondes
	setTimeout((function(){
		//On vérifie qu'il n'y a pas eu d'évolution de la valeur durant ces trois secondes
		if(newName == fileNameElem.value){
			//On vérifie qu'il ne s'agit pas du nom actuel
			if(newName != fileInfos['fileName']) {

				//Préparation des données de la requête
				var datas = [
					['newFileName', newName],
					['originalFileName', fileInfos['fileName']],
					['folderContainer', fileInfos['folderContainer']],
				];

				//On envoi la modification au serveur
				postAJAX(config['APIsURL']+"files/rename", datas, (function(result){
					//Décodage du résultat
					arrayResult = decodeJSON(result);

					//On ne continue que si le message de succès est bien présent
					if(arrayResult['success']) {
						//Notification de succès
						notifSucces(arrayResult['success']);

						//On enregistre le nouveau nom dans la variable de configuration du fichier
						fileInfos['fileName'] = newName;

						//Modification de l'URL de la page
						changeURLpage(config['siteURL']+"HTMLeditor?file="+newName);

						//On change le champ de texte en span
						transformNameInputToSpan();
					}
				}))
			}
		}
	}), 3000);
}

/**
 *	Fonction de transformation du champ de nom en champ de texte
 */
function transformNameSpanToInput(){
	//On transforme l'élément en bouton
	var name = fileNameElem.innerHTML;

	//Nettoyage du parent
	var nameParent = fileNameElem.parentNode;
	nameParent.innerHTML = "";

	//Création de l'input
	var nameInput = document.createElement('input');
	nameInput.setAttribute('id', fileNameId);
	nameInput.value = name;

	//Application et enregistrement de l'élément
	nameParent.appendChild(nameInput);
	fileNameElem = document.getElementById(fileNameId);

	//Evenement dynamique
	//Changement dynamique du nom de fichier
	fileNameElem.onkeyup = ChangeNamgeFile;
}

/**
 *	Fonction de transformation de l'input de nom en champ noral
 */
function transformNameInputToSpan(){
	//On transforme l'élément en bouton
	var name = fileNameElem.value;

	//Nettoyage du parent
	var nameParent = fileNameElem.parentNode;
	nameParent.innerHTML = "";

	//Création de l'input
	var nameInput = document.createElement('span');
	nameInput.setAttribute('id', fileNameId);
	nameInput.innerHTML = name;

	//Application et enregistrement de l'élément
	nameParent.appendChild(nameInput);
	fileNameElem = document.getElementById(fileNameId);

	//Evenement dynamique
	//Changement dynamique du nom de fichier
	fileNameElem.onclick = transformNameSpanToInput;
}