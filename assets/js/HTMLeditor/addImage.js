/**
 *	Gestion de l'ajout d'images dans le champ de texte
 *
 *	@author Pierre HUBERT
 */

/**
 *	Fonction d'ouverture de la boite de dialogue d'envoi d'une image
 */
function openAddImageDialog(){
	//Boîte de dialogue d'envoi d'une image
	uploadDialog("Ajout d'une image", (function(){
		//Element : inputFile

		//Conversion de l'élément en base64
		var selectedFile = inputFile.files[0];
    	selectedFile.convertToBase64(function(base64){
        	//Nouveau code source
        	var newSourceCode = "<img src='" + base64 + "' title='Nouvelle image' width='750px' >";

        	//Ajout de l'image
        	addTextToCurrentSelection(newSourceCode);
    	}) 
	}))
}