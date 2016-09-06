<?php
/**
 *	Configuration dynamique du navigateur du projet
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

// Configuration dynamique de la page (JavaScript)
?><script type="text/javascript">
	var browserConfig = [];
	/**
	 *	Nom et accès au dossier actuel
	 */
	browserConfig['currentFolder'] = '<?php echo $dossier; ?>';

</script>