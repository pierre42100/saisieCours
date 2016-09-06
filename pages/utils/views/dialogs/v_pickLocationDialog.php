<?php
/**
 * Boîte de dialogue de choix d'emplacement pour un fichier
 *
 * @author Pierre HUBERT
 */

isset($_SESSION) OR die('unallowed !');

?><div data-role="dialog" id="pickLocationDialog" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark" data-width="90%" data-height="90%">
	<h5 class="messageInfo">Choisissez un emplacement :</h5>

	<div class="pickLocationArea">
		<div class="locationSelectedArea">
			Emplacement : 
			<div class="folderUP"><span class="mif-arrow-up"></span></div>
			<span class="locationSelected">/</span>
		</div>

		<div class="filesOfLocation"></div>
	</div>

	<div class="buttonsOnRight">
		<br /><br />
		<input type="button" value="Annuler" class="button buttonCancel" />
		<input type="button" value="Valider" class="button buttonConfirm" />
	</div>

</div>