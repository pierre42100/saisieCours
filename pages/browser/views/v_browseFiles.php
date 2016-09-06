<?php
/**
 *	Parcours de fichiers du navigateur du projet
 *
 * @author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?><!-- Parcours des fichiers -->
<div class="listview list-type-tiles">
	<!-- Dossier supérieur -->
	<a class="list" href="./?dossier=<?php echo find_folder_up($dossier); ?>">
        <img src="<?php echo path_assets('img/folder_up.png'); ?>" class="list-icon">
        <span class="list-title">Dossier sup&eacute;rieur</span>
    </a>

	<!-- Affichage des éléments du dossier -->
	<?php
		$elem = 0;
		foreach($liste_elements as $file)
		{
			//Définition de l'ID de l'éléments
			$elem_id = "elem_".$elem;

			//Définition du chemin système de l'élément
			$sysPath = getWebsiteRelativePath().$file;
			
			//Récupération des informations sur le document
			$infosDoc = getDocInfos($file, $path, $fileTypesList);
			
			//Affichage de l'élément
			?><div class="list" id="<?php echo $elem_id; ?>">
				<!-- Plus d'options -->
				<span class="more-option-button mif-more-vert" onClick="openCharmDocument('<?php echo $elem_id; ?>', '<?php echo $infosDoc['fileTypeComplete']; ?>');"></span>

				<!-- Contenu de la tuile -->
				<div class="tile-inner" onClick="<?php
					//Si c'est un fichier et que l'on clique dessus, on doit changer la page
					if($infosDoc['fileType'] == "file")
						echo "window.location='".$infosDoc['linkURL']."'";
					//Si c'est un dossier, on peut utiliser l'affichage dynamique
					else
						echo "changeFolder('".$infosDoc['simplePath']."')";
				?>">
					<img src="<?php echo $infosDoc['fileTypeInfos'][1]; ?>" class="list-icon docImage"/>
					<span class="list-title nomDoc"><?php 
						//Nom de l'élément
						echo  $infosDoc['nom'] 
					?></span>
				</div>

				<!-- Données associées -->
				<datas>
					<?php foreach($infosDoc['datas'] as $nom=>$showData)
						echo '<info class="'.$nom.'">'.$showData.'</info>'; ?>
				</datas>
			</div><?php

			$elem++; //Incrémentation
		}
	?>
</div>