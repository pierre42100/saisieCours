<?php
/**
 *	Vue permettant la transmission des informations sur le fichier
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?><script type="text/javascript">
	/**
	 *	Informations sur le fichier
	 */
	 var fileInfos = [];

	/**
	 *	Nom du fichier (sans le dossier conteneur)
	 */
	fileInfos['fileName'] = "<?php echo $fileName; ?>";

	/**
	 *	Chemin d'accès au dossier contenant le fichier
	 */
	fileInfos['folderContainer'] = "<?php echo $folderContainer; ?>/";

	/**
	 *	Fréquence à laquelle il faut sauvegarder le travail en cours
	 */
	fileInfos['editorsBackupFrequence'] = <?php echo $config['editorsBackupFrequence']; ?>;

	/**
	 *	URL d'accès aux templates
	 */
	fileInfos['templatesURL'] = "<?php echo getWebsiteUrl().$config['templatesURI']; ?>";
</script>