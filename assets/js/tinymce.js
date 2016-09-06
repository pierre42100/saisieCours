/**
 *	Fonctions de gestion de TinyMCE
 *
 *	@author Pierre HUBERT
 */

/**
 *	Fonction permettant l'initialisation de tinyMCE
 *
 *	@param	String	ID of the contener
 *	@param	Str/Int Width of the contener
 *	@param	Str/Int Height of the contener
 *	@return Element The editor
 */
function useTinyMCE(id, width, height){
	//Initialisation de tinyMCE
	tinymce.init({

		//Seul un ID très précis bénéficie de l'éditeur
		mode: "exact",
		elements: id,

		//Dimensions indiquées lors de l'appel de la fonction
		width: width,
		height: height,

		//Langue française
		language: 'fr_FR',

		//Barre du bas (de status) inutile
		statusbar: false,

		//Inclusion des plugins
		plugins: [
			'advlist autolink lists link image charmap print preview hr anchor pagebreak',
			'searchreplace wordcount visualblocks visualchars code fullscreen',
			'insertdatetime media nonbreaking save table contextmenu directionality',
			'emoticons template paste textcolor colorpicker textpattern imagetools'
		],

		//Barres d'outils (1 et 2)
		toolbar1: 'undo redo | alignleft aligncenter alignright alignjustify | bold italic underline | forecolor backcolor highcolor | styleselect fontselect fontsizeselect',
		toolbar2: ' table | link image preview media | bullist numlist outdent indent | subscript superscript | charmap emoticons ',
	});
}

/**
 *	Fonction permettant de remplacer texte de la sélection
 *
 *	@param	String	Nouveau texte
 */
function replaceCurrentSelectionWithText(newText){
	tinymce.activeEditor.selection.setContent(newText);
}

/**
 *	Fonction permettant d'ajouter du texte à la fin de la sélection
 *
 *	@param	String	Texte à ajouter
 */
function addTextToCurrentSelection(newText){
	var currentContent = tinymce.activeEditor.selection.getContent();
	tinymce.activeEditor.selection.setContent(currentContent + newText);
}

/**
 *	Fonction extrayant tout le contenu de l'éditeur tinyMCE
 *
 *	@return	String	The content of the editor
 */
function getAllContentofTinyMCE(){
	return tinymce.activeEditor.getContent();
}