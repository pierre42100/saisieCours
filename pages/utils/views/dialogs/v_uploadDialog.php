<?php
/**
 * Boîte de dialogue permettant l'envoi d'un fichier
 *
 * @author Pierre HUBERT
 */

isset($_SESSION) OR die('unallowed !');

?><div data-role="dialog" id="uploadFileDialog" class="padding20" data-close-button="true" data-overlay="true" data-overlay-color="op-dark">
	<h5 class="messageInfoUpload">Envoi d'un fichier en ligne</h5>

	<form enctype="multipart/form-data" method="post">
		<div class="input-control file" data-role="input">
			<input type="file" class="fileUpload" />
			<button class="button"><span class="mif-folder"></span></button>
		</div>

		<div class="buttonsOnRight">
			<input type="button" value="Annuler" class="button buttonCancel" />
			<input type="button" value="Envoyer" class="button buttonConfirm" />
		</div>
	</form>

</div>