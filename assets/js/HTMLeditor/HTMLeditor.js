/**
 *	Fonctions et codes de l'editeur HTML du projet
 *
 *	@author Pierre HUBERT
 */


/**
 *	Préparation du traitement du champ de nom
 */
var fileNameId = "fileName";
var fileNameElem = document.getElementById(fileNameId);
fileNameElem.onclick = transformNameSpanToInput;

/**
 *	Initialisation de tinyMCE
 */
//Conteneur du textarea
var editorContener = document.getElementById('textareaEditorContener');

//Dimensions du textArea
var screenDimensions = getScreenDims();
var tinyWidth = screenDimensions['width'] - 2;
var tinyHeight = screenDimensions['height'] - 166;

//Appel de tinyMCE
useTinyMCE("editor", tinyWidth + "px", tinyHeight + "px");


/**
 *	Sauvegarde automatique
 */
var backupInterval = setInterval("saveCurrentWorkHMTLeditor();" , fileInfos['editorsBackupFrequence']*1000);

/**
 *	Bloquage de la page en cas de tentative de fermeture
 */
window.onbeforeunload = function(){
	//On vérifie avant que la page n'est pas vide
	if(getAllContentofTinyMCE() != ""){
		//Sauvegarde du travail
		saveCurrentWorkHMTLeditor();

		return "Assurez-vous d'avoir fait une sauvegarde avant de quitter !";
	}
}