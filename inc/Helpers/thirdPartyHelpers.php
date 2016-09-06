<?php
/**
 * Third Parties Helpers
 *
 * @author Pierre HUBERT
 **/
isset($_SESSION) OR die('unallowed !');

/**
 * Returns the full path to a third Party element
 *
 * @param   String   The small path of the third party element
 */
function path_3rdparty($path) {
	return getWebsiteUrl().thirdPartyFolder().$path;
}

/**
 * Returns the relative path to a third Party element
 *
 * @param   String   The small path of the third party element
 */
function path_3rdparty_relative($path) {
	return getWebsiteRelativePath().thirdPartyFolder().$path;
}
