/**
 *	Fonction de gestion des insertions générales
 *
 *	@author Pierre HUBERT
 */

/**
 *	Fonction permettant l'insertion d'une en-tête
 */
function insertHTMLHeader(){
	//On commence par demander le nom du chapitre et de la matière
	inputTextDialog("Saisissez le nom du chapitre et celui de la matiere.", "(Chapitre) Matiere", (function(nomChapitre){
		inputTextDialog("Saisissez maintenant le titre complet du fichier (il sera affich&eacute; en grand)", "Titre du fichier", (function(nomFichier){
			//Génération du code source de l'en-tête
			urlTemplate = fileInfos['templatesURL'] + "parts/t_header.html";
			getAJAX(urlTemplate, (function(sourceTemplate){
				//Remplissage du template
				sourceTemplate = sourceTemplate.replace('#CHAP_NUMBER#', nomChapitre);
				sourceTemplate = sourceTemplate.replace('#CHAP_TITLE#', nomFichier);

				//Ajout du template
				addTextToCurrentSelection(sourceTemplate);
			}));
		}));
	}));
}

/**
 *	Fonction permettant l'ajout d'un tableau
 */
function insertHTMLtable(){
	//Génération du code source du tableau
	urlTemplate = fileInfos['templatesURL'] + "parts/t_table.html";
	getAJAX(urlTemplate, (function(sourceTable){
		//Ajout du template
		addTextToCurrentSelection(sourceTable);
	}));
}