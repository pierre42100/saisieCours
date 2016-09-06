<?php
/**
 *	Charm pour les documents du navigateur
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?><!-- "Charm" pour les documents -->
<div data-role="charm" data-position="right" id="docCharm">
        <h1 id="docCharmName">Nom</h1>

        <!-- Actions principales -->
		<div class="mainActionsButtons">
			<button class="button docCharmRenameButton">Renommer</button>
			<button class="button docCharmDeleteButton">Supprimer</button>
			<button class="button docCharmMoveButton">D&eacute;placer</button>
		</div>

		<!-- Déplacement du fichier -->
		

		<!-- Spécifique aux fichiers -->
		<div class="infosFile">
			<p>Informations sur le fichier :</p>

			<table class="table hovered">
				<tr>
					<td><b>Type de fichier</b></td>
					<td class="fileType">Fichier <i>FileType</i></td>
				</tr>
				<tr>
					<td><b>Taille du fichier</b></td>
					<td class="fileSize">0MO</td>
				</tr>
				<tr>
					<td><b>Derni&egrave;re modification</b></td>
					<td class="lastEditFile">Aujourd'hui</td>
				</tr>
			</table>
		</div>

		<!-- Téléchargement du document -->
		<button class="button forceDownloadLink">T&eacute;l&eacute;charger le document</button>
</div>