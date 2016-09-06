<?php
/**
 * Vue principale du panneau d'affichage du gestionnaire d'utilitaires
 *
 *  @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?><div class="tabcontrol2 tabUtilities" data-role="tabControl">
	<!-- Bouton du haut -->
	<ul class="tabs">
		<li><a href="#frame_storage">Stockage</a></li>
		<li><a href="#fram_users">Utilisateurs</a></li>
	</ul>

	<!-- Contenu des cadres -->
	<div class="frames">
		<!-- Utilitaire pour le stockage de fichier -->
		<div class="frame" id="frame_storage">

			<!-- Vider la corbeille -->
			<h4>Corbeille</h4>
			<input type="button" value="Vider la corbeille maintenant" onClick="emptyTrashDialog();"/>

			<!-- Accès WebDAV -->
			<h4>Acc&egrave;s au service WebDAV</h4>
			<i><?php echo $webDAVURL; ?></i>
			<a href="<?php echo $webDAVURL; ?>" target="_blank">Ouvrir</a>

		</div>

		<!-- Utilitaire pour les utilisateurs -->
		<div class="frame" id="fram_users">

			<!-- Crypter un mot de passe -->
			<h4> Crypter un mot de passe </h4>
			<div class="input-control text">
				<input type="password" id="cryptPasswordTarget" placeholder="Saisissez ici le mot de passe &agrave; crypter..." />
			</div>
			<input type="button" value="Crypter le mot de passe" onClick="cryptPasswordsDialog();" />
			<span id="cryptPasswordResult"></span>

		</div>
	</div>
</div>