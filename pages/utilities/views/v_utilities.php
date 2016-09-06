<?php
/**
 * Vue du gestionnaire d'utilitaires
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//Inclusion des feuilles de style
echo inc_css_code(path_to_css("utilities/utilities"));

// Barre de menu de l'editeur
//Barre de menu principale
include($relativePath.'pages/utils/views/menuBar/v_menuBar.php');

//Panneau principal de l'utilitaire
include($relativePath.'pages/utilities/views/v_mainTabView.php');

//Inclusion de la boîte de dialogue de confirmation
include($relativePath.'pages/utils/views/dialogs/v_confirmDialog.php');

//Inclusion de certains fichiers Javascript à la fin de la page
echo inc_js_code(path_to_js("utilities/utilities"));