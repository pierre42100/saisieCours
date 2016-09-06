<?php
/**
 *	Gestion des erreurs 404 - Non trouvé
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

//On indique qu'il s'agit d'une erreur de type 404
http_response_code(404);

//Inclusion de la vue des erreurs
include($relativePath.'pages/errors/views/v_404.php');