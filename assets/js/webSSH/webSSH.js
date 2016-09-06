/**
 *	Fichier Javascript du terminal webSSH
 *
 *	@author Pierre HUBERT
 */

/**
 *	Récupération des éléments requis
 */
var iframeElem = byId('iframeSSH');

/**
 *	Redimensionnement dynamique de l'iframe
 */
//Dimensions de l'iframe
var screenDimensions = getScreenDims();
var iframeHeight = screenDimensions['height'] - 65; //
iframeElem.style.height = iframeHeight + "px";