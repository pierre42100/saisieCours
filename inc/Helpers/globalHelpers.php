<?php
/**
 * Helpers
 * Helps to make the developpement easier
 *
 * @author Pierre HUBERT
 **/
isset($_SESSION) OR die('unallowed !');

/**
 * Returns the relative path to a page file
 *
 * @param   String   The small path of the page file
 */
function path_pages_relative($path) {
	return getWebsiteRelativePath()."pages/".$path;
}
