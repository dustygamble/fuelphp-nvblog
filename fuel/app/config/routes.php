<?php
return array(
	'_root_'  => 'nvblog/index',  		// The default route
	'_404_'   => 'public/main/404',    	// The main 404 route
	
	'blog'                              => 'nvblog/index', 
    'blog/(:num)/(:num)/(:segment)'     => 'nvblog/content/$3',
    'blog/(:any)'                       => 'nvblog/$1',
    
    /* 
     * Private routes 
     */
    'admin'                             => 'nvadmin/nvadmin/login/login',
	'admin/login'                       => 'nvadmin/nvadmin/login/login',
	'admin/logout'                      => 'nvadmin/nvadmin/login/logout',
	'admin/dashboard'                   => 'nvadmin/nvadmin/main/dashboard',
    
    'admin/blog/(:any)'                 => 'nvblog/nvadmin/$1',
    'admin/(:any)'                      => 'nvadmin/nvadmin/$1'
);