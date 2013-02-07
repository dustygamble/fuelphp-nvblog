<?php

Autoloader::add_core_namespace('NVUtility');

Autoloader::add_classes(array(
	'NVUtility\\NVImage' 		=> __DIR__.'/classes/nvimage.php',
	'NVUtility\\NVPermission' 	=> __DIR__.'/classes/nvpermission.php',
	'NVUtility\\NVSecurity'     => __DIR__.'/classes/nvsecurity.php',
	'NVUtility\\NVString'       => __DIR__.'/classes/nvstring.php',
	'NVUtility\\NVTag' 			=> __DIR__.'/classes/nvtag.php',
));

/* End of file */