<?php
/**
 *	Vue de boîte de dialogue de demande d'une informations
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?><!-- Demande d'un texte à l'utilisateur -->
<div data-role="dialog" id="inputTextDialog" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark">
	<h5 class="infoTexte">Veuillez indquer une valeur</h5>
	<div class="input-control text">
		<input type="text" placeholder="Saisissez une valeur..." class="champTexte">
	</div>

	<!-- Boutons de validation -->
	<div class="buttonsOnRight">
		<input type="button" value="Annuler" class="button buttonCancel" />
		<input type="button" value="Valider" class="button buttonConfirm" />
	</div>
</div>