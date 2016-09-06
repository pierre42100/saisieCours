<?php
/**
 *	Configuration JavaScript du site
 *
 *	@author Pierre HUBERT
 */

	isset($_SESSION) OR die('unallowed !');
?><!-- Configuration Javascript du site -->
<script type="text/javascript">
	/**
	 *	Configuration (dynamique) du javascript du site WEB
	 */
	var config = [];

	/**
	 *	Adresse du site WEB
	 */
	config['siteURL'] = "<?php echo getWebsiteUrl(); ?>";

	/**
	 *	Acces aux APIs du site
	 */
	config['APIsURL'] = "<?php echo getAPIsURL(); ?>";

	/**
	 *	Acces aux ressources du site
	 */
	config['pathAssets'] = "<?php echo path_assets(""); ?>";
</script>