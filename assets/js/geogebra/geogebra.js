/**
 *	Javascript pour l'intégration de GeoGebra au service
 *
 *	@author Pierre HUBERT
 */

/**
 *	Récupération des éléments requis
 */
var iframeElem = byId('iframeGeoGebra');

/**
 *	Redimensionnement dynamique de l'iframe
 */
//Dimensions de l'iframe
var screenDimensions = getScreenDims();
var iframeHeight = screenDimensions['height'] - 65; //
iframeElem.style.height = iframeHeight + "px";