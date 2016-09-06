<?php
/**
 *	Fonctions globales du service
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');
	
/**
 *	Fonction permettant l'affichage d'une erreur
 *	En code HTML
 *
 *	@param 	String 	Le message d'erreur
 *	@return Nothing	L'erreur est affichée directement
 */
function echo_erreur($message) {
	echo "<p class='message_erreur'><span class='mif-warning'></span> ".$message."</p>";
}

/**
 *	Fonction permettant l'affichage d'une erreur en notification
 *
 *	@param 	String 	Le message d'erreur
 *	@return Nothing Le message d'errreur est affiché directement
 */
function echo_erreur_notif($message) {
	// Erreur - Notification
	?><script type="text/javascript">
	$.Notify({
		caption: 'Erreur',
		content: '<?php echo str_replace("'", "\'", $message); ?>',
		type: 'alert'
	});</script><?php
}

/**
 *	Fonction permettant l'affichage d'un succès en notification
 *
 *	@param 	String 	Le message de succès
 *	@return Nothing Le message de succès est affiché directement
 */
function echo_succes_notif($message) {
	// Succes - Notification
	?><script type="text/javascript">
	$.Notify({
		caption: 'Bravo !',
		content: '<?php echo str_replace("'", "\'", $message); ?>',
		type: 'success'
	});</script><?php
}
	
	