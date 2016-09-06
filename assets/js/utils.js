/**
 *	Utilitaires pour le service
 *
 *	@author Pierre HUBERT
 */

/**
 *	Retourne l'élément ayant pour ID l'ID indiqué
 *
 *	@param	String	The ID of the element
 *	@return Element The element
 */
 function byId(id){
 	return document.getElementById(id);
 }

 /**
 *	Retourne le premier élément de la classe spécifiée
 *
 *	@param	Element		The container of the class
 *	@param	String		The name of the class
 *	@return Element 	The first element
 */
 function getFirstElementByClass(container, nomClasse) {
	var Elems = container.getElementsByClassName(nomClasse);
 	return Elems[0];

 }

/**
 * Fonction assurant l'ouverture d'une boîte de dialogue
 *
 * @param	String	id of the dialog to open
 */
function showDialog(id){
        var dialog = $(id).data('dialog');
        dialog.open();
}

/**
 * Fonction assurant la fermeture d'une boîte de dialogue
 *
 * @param	String	id of the dialog to open
 */
function closeDialog(id){
        var dialog = $(id).data('dialog');
        dialog.close();
}

/**
 * Fonction de gestion de l'ouverture d'un charm
 *
 * @param	String	The ID of the target Charm
 * @param	String	noClose : if set true, it will close open Charm if there is instead of opening a new one.
 */
function showCharm(id, noClose){
	if(!noClose)
		noClose = true;
	
	var  charm = $(id).data("charm");
	if (charm.element.data("opened") === true) {
		if(!noClose)
			charm.close();
	} else {
		charm.open();
	}
}

 /**
  * Fonction de génération et d'envoi automatique d'un formulaire "POST"
  *	Pratique pour envoyer des informations sans passer par l'URL
  *
  * @param	String	Location : The Target URL to send datas
  * @param	Array	Datas : Datas to send in a post form
  */
function sendAutoForm(location, datas) {
	var form = document.createElement('form');
	form.setAttribute('method', 'post');
	form.setAttribute('action', location);
	  
	//Traitement des données une par une
	for(n in datas) {
		//On vérifie que les données existes
		if(datas[n][0]) {
			var input = document.createElement('textarea');
			input.setAttribute('name', datas[n][0]);
			input.style.display = "none"; //On rend le champ de texte invisible
			input.innerHTML = datas[n][1];
			form.appendChild(input);
		}
	}
	
	//Confirmation et envoi
	document.body.appendChild(form);
	form.submit();
}


/**
 * Fonction convertissant les &amp; en &
 *
 *	@param	String	Source to convert
 */
function etampTOet(source) {

	var result = source;

	while(result.indexOf("&amp;") > 0) {
		result = result.replace("&amp;", "&");
	}

	//Renvoi du resultat
	return result;
}

/**
 *	Fonction gérant les requêtes AJAX de type "GET"
 *
 *	@param	String	 The Target URL of the request
 *	@param 	Function What to do next
 */
function getAJAX(url, nextAction){
	//Création de la requête
	GETxhr = new XMLHttpRequest();
	GETxhr.open("GET", url);
	
	GETxhr.onreadystatechange = function() {
		if (GETxhr.readyState == 4 && (GETxhr.status == 200 || GETxhr.status == 0)) {
			//Enregistrement du résultat dans une variable
			var requestResult = GETxhr.responseText;

			//Exécution de la suite du script
			nextAction(requestResult);
		}
	};
	
	GETxhr.send(null);
}

/**
 *	Fonction gérant les requêtes AJAX de type "POST"
 *
 *	@param	String	 The Target URL of the request
 *	@param 	Array 	 Informations to be sent in the POST request
 *	@param 	Function What to do next
 */
function postAJAX(url, values, nextAction){
	//Création de la requête
	POSTxhr = new XMLHttpRequest();
	POSTxhr.open("POST", url);
	
	//Préparation des données à envoyer dans la requête
	var count = 0;
	var datas = "";
	for(i in values){
		//On ne poursuit que si l'on n'a pas dépasser la taille du tableau (pour éviter les données 'non désirées')
		if(count < values.length){
			//Si il ne s'agit pas de la première fois, on rajoute "&"
			if(count != 0)
				datas += "&";

			//On vérifie que le champ existe
			if(values[i][0])
				datas += encodeURIComponent(values[i][0]) + "=" + encodeURIComponent(values[i][1]);
			
			//Incrémentaion de count
			count++;
		}
	}

	POSTxhr.onreadystatechange = function() {
		if (POSTxhr.readyState == 4 && (POSTxhr.status == 200 || POSTxhr.status == 0)) {
			//Enregistrement du résultat dans une variable
			var requestResult = POSTxhr.responseText;

			//Exécution de la suite du script
			nextAction(requestResult);
		}
	};
	POSTxhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	
	POSTxhr.send(datas);
}

/**
 *	Fonction de détermination du dossier parent d'un dossier
 *
 *	@param	String	Current URL of the folder
 */
function findFolderUp(url) { 
	//On vérifie si la chaîne est n'est constitué que d'un slash
	if(url == "/")
		return "/"; //Il n'existe pas de dossier parent

	//On vérifie si la chaîne demandée ne présente pas de slash
	if(url.indexOf("/") == -1)
		return "/";

	//Division de la chaîne en un tableau
	var arrayURL = url.split('/');
	var arrayURLlength = arrayURL.length;

	//Détermination du nombre d'entrées à enlever
	if(arrayURL[arrayURLlength-1] == "")
		var remove = 2;
	else
		var remove = 1;

	//On réassemble le tableau en ignorant les entrées nécessaires
	var retour = "";
	var stopCount = arrayURLlength - remove;
	//console.log(stopCount);
	for(n in arrayURL){
		if(n < stopCount){
			retour = retour + arrayURL[n] + "/";
		}
	}

	//Si le retour est vide, on le remplace par un slash
	if(retour == "")
		return "/";

	//On vérifie que le premier caractère est bien un slahs
	if(retour[0] != "/")
		retour =  "/" + retour;

	//Renvoi du résultat
	return retour;
}

/**
 *	Fonction permettant le changement dynamique de l'URL de la page
 *
 *	@param	String	La nouvelle URL de la page
 */
function changeURLpage(nouvelleURL){
	//Changement immédiat de l'URL
	window.history.pushState(document.title,document.title, nouvelleURL);
}

/**
 *	Fonction permettant de récupérer les dimensions de l'écran
 *
 *	@return 	Array 	Width and Height of the screen
 */
function getScreenDims(){
	var viewportwidth;
	var viewportheight;
	  
	//The more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight  
	if (typeof window.innerWidth != 'undefined')
	{
		viewportwidth = window.innerWidth,
		viewportheight = window.innerHeight
	}
	
	//IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document) 
	else if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0)
	{
		viewportwidth = document.documentElement.clientWidth,
		viewportheight = document.documentElement.clientHeight
	}
	
	//Older versions of IE
	else
	{
		viewportwidth = document.getElementsByTagName('body')[0].clientWidth,
		viewportheight = document.getElementsByTagName('body')[0].clientHeight
	}
	 
	//Préparation du renvoi du resultat
	var resultat = [];
	resultat['width'] = viewportwidth;
	resultat['height'] = viewportheight;

	//Renvoi du résultat
	return resultat;
}

/**
 *	Fonction de transformation du contenu d'un input pour les fichiers en code base64
 */
File.prototype.convertToBase64 = function(callback){
	var reader = new FileReader();
	reader.onload = function(e) {
		callback(e.target.result)
	};
	reader.onerror = function(e) {
		callback(null);
	};        
	reader.readAsDataURL(this);
};

/**
 *	Fonction appelant le serveur pour crypter un mot de passe
 *
 *	@param	String	 Le mot de passe à crypter
 *	@param 	Function What to do nexte
 *	@return String	 Le mot de passe crypté
 */
 function cryptPassword(password, nextAction){
 	//Préparation de la requête
 	var url = config['APIsURL']+"users/encodePassword";
 	var datas = [
 		["password", password],
 	];

 	//Fonction AJAX exécutant la requête
 	postAJAX(url, datas, nextAction);
 }