<?php

return array(
    'base_url'  => '/github/fuelphp-nvblog/public/',
    'profiling'  => true,

    'module_paths' => array(
        APPPATH.'modules'.DS
    ),

    'package_paths' => array(
        PKGPATH
    ),

	'always_load'  => array(
		'packages'  => array(
            'log',
            'orm',
            'auth',
            'nvutility'
		),

		'modules'  => array(
            'NVAdmin',
            'NVBlog',
        ),
	),
);
