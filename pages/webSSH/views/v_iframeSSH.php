<?php
/**
 *	Vue contenant le terminal présent dans un iFrame
 *
 *	@author Pierre HUBERT
 */
isset($_SESSION) OR die('unallowed !');

?><iframe src="<?php echo $config['URLwebSSH']; ?>" id="iframeSSH"></iframe>