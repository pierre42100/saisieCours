<?php
/**
 * Assets Helpers
 * Helps to make the assets integration easier
 * Requires the global helpers
 *
 * @author Pierre HUBERT
 **/
isset($_SESSION) OR die('unallowed !');

/**
 * Returns the full path of an assets
 *
 * @param   String   The small path of the asset
 */
function path_assets($path) {
	return getWebsiteUrl()."assets/".$path;
}

/**
 * Return the path to a CSS file in the assets
 *
 * @param   String   Name of the CSS file
 */
function path_to_css($path) {
	return path_assets("css/".$path.".css");
}

/**
 * Returns the HTML code to include a CSS File
 *
 * @param   String  Path to the CSS file
 **/
function inc_css_code($path) {
	//Depend of the mode of the mode of the website
	if(getSiteMode() == "prod")
		return '<link href="'.$path.'" rel="stylesheet" />';
	else
		return '<link href="'.$path.'?no-cache-'.time().'" rel="stylesheet" />';
}

/**
 * Return the path to a JS file in the assets
 *
 * @param   String   Name of the JS file
 */
function path_to_js($path) {
	return path_assets("js/".$path.".js");
}

/**
 * Returns the HTML code to include a JS File
 *
 * @param   String  Path to the JS file
 **/
function inc_js_code($path) {
	//Depend of the mode of the mode of the website
	if(getSiteMode() == "prod")
		return '<script src="'.$path.'"></script>';
	else
		return '<script src="'.$path.'?no-cache-'.time().'"></script>';
}
