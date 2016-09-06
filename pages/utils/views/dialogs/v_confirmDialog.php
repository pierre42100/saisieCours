<?php
/**
 * Boîte de dialogue de confirmation avant une action
 *
 * @author Pierre HUBERT
 */

isset($_SESSION) OR die('unallowed !');

?><div data-role="dialog" id="confirmActionDialog" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark">
	<h5 class="confirmText">Voulez-vous vraiment effectuer cette action ?</h5>

	<div class="buttonsOnRight">
		<input type="button" value="Oui" class="button buttonConfirm" />
		<input type="button" value="Non" class="button buttonCancel" />
	</div>

</div>