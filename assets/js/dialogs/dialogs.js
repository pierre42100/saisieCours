/**
 * Fonctions globales de gestion de l'ouveture des boîtes de dialogue du service
 *
 * @author Pierre HUBERT
 */


/**
 * Fonction de gestion de l'ouverture de la boîte de dialogue de confirmation
 *
 * @param	String	 The text of the confirmation
 * @param	function What to do if yes is pressed
 */
function confirmDialog(textConfirm, action){

 	//ID de la boîte de dialogue
 	var idDialog = "confirmActionDialog";

 	//Récupération des éléments requis
 	var dialogueElem = document.getElementById(idDialog);

 	//Modification du texte de confirmation
 	getFirstElementByClass(dialogueElem, "confirmText").innerHTML = textConfirm;

 	//Modification de l'action de confirmation
 	getFirstElementByClass(dialogueElem, "buttonConfirm").onclick = (function(){
 		//Fermeture de la boîte de dialogue
 		closeDialog('#' + idDialog);

 		//Action suivante
 		action();
 	});

 	//Modification de l'action du boutton d'annulation
 	getFirstElementByClass(dialogueElem, "buttonCancel").onclick = (function(){
 		//Fermeture de la boîte de dialogue
 		closeDialog('#' + idDialog);
 	});

 	//Affichage de la boîte de dialogue
 	showDialog('#' + idDialog);
 }

 /**
  * Fonction de gestion de l'ouverture d'une boîte de dialogue d'envoi d'un
  * fichier
  *
  * @param	String	 Titre à afficher dans la boîte de dialogue
  *	@param	function What to do next	
  */
function uploadDialog(titre, nextAction) {
	//ID de la boîte de dialogue
	var idDialog = "uploadFileDialog";

	//Récupération des éléments requis
 	var dialogueElem = document.getElementById(idDialog);

 	//Modification du texte d'information
 	getFirstElementByClass(dialogueElem, "messageInfoUpload").innerHTML = titre;

	//Modification de l'action du boutton d'annulation
 	getFirstElementByClass(dialogueElem, "buttonCancel").onclick = (function(){
 		//Fermeture de la boîte de dialogue
 		closeDialog('#' + idDialog);
 	});

 	//Action à effectuer une fois le bouton de confirmation pressé
 	getFirstElementByClass(dialogueElem, "buttonConfirm").onclick = (function(){
 		//Récupération du champ d'envoi
 		inputFile = getFirstElementByClass(dialogueElem, 'fileUpload');

 		if(inputFile.value == "") {
 			notifErreur("Veuillez indiquer un fichier avant de valider.");
 		}
 		else {
 			//Fermeture de la boîte de dialogue
 			closeDialog('#' + idDialog);

 			//Le script peut continuer...
 			nextAction();
 		}
 	});

	//Affichage de la boîte de dialouge
	showDialog('#' + idDialog);
}

/**
 *	Fonction de gestion de l'ouverture d'une boîte de dialogue pour demander
 *	à l'utilisateur d'entrer un texte
 *
 *	@param	String	 Titre à afficher dans la boîte de dialogue
 *	@param	String	 Texte à afficher en fond tant qu'aucune valeur n'a été saisie.
 *	@param	function What to to next
 */
 function inputTextDialog(titre, placeHolder, nextAction) {
 	//ID de la boîte de dialogue
 	var idDialog = "inputTextDialog";

 	//Récupération des éléments requis
 	var dialogueElem = document.getElementById(idDialog);

 	//Modification du texte d'information
 	getFirstElementByClass(dialogueElem, "infoTexte").innerHTML = titre;

 	//Récupération du champ de texte
 	var textElement = getFirstElementByClass(dialogueElem, "champTexte");

 	//On vide le champ de texte
 	textElement.value = "";

 	//On champ le placeHolder du champ de texte
 	textElement.setAttribute('placeholder', placeHolder);

 	//Modification de l'action du boutton d'annulation
 	getFirstElementByClass(dialogueElem, "buttonCancel").onclick = (function(){
 		//Fermeture de la boîte de dialogue
 		closeDialog('#' + idDialog);
 	});

 	//Modification de l'action du boutton de confiramtion
 	getFirstElementByClass(dialogueElem, "buttonConfirm").onclick = (function(){
 		//Récupération de la valeur saisie
 		var valeurSaisie = textElement.value;

 		//On vérifie si la valeur est vide ou non
 		if(valeurSaisie == "")
 			notifErreur("Veuillez spc&eacute;cifier une valeur avant de continuer...");
 		else {
 			//Fermeture de la boîte de dialogue
 			closeDialog('#' + idDialog);
 			
 			//On peut continer l'exécution du script
 			nextAction(valeurSaisie);
 		}
 	});


 	//Affichage de la boîte de dialogue
 	showDialog("#" + idDialog);
 }