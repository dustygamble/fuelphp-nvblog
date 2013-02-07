<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(

	/**
	 * DB connection, leave null to use default
	 */
	'db_connection' => null,

	/**
	 * DB table name for the user table
	 */
	'table_name' => 'users',

	/**
	 * Choose which columns are selected, must include: username, password, email, last_login,
	 * login_hash, group & profile_fields
	 */
	'table_columns' => array('*'),

	/**
	 * This will allow you to use the group & acl driver for non-logged in users
	 */
	'guest_login' => true,

	/**
	 * Groups as id => array(name => <string>, roles => <array>)
	 */
    'groups' => array(
		-1	=> array('name' => 'Banned', 'roles' => array('banned')),
		0	=> array('name' => 'Guest', 'roles' => array()),
		1	=> array('name' => 'User', 'roles' => array()),
		60	=> array('name' => 'Moderator', 
			'roles' => array(
				'access', 
				'multimedia', 'multimedia_all',
			)
		),
		//70	=> array('name' => 'Editor', 'roles' => array('access')),
		//80	=> array('name' => 'Publisher', 'roles' => array('access')),
		90	=> array('name' => 'Manager', 
			'roles' => array(
				'access', 
				'user', 
				'multimedia'
			)
		),
		100	=> array('name' => 'Administrator', 'roles' => array('admin')),
	),

	/**
	 * Roles as name => array(controller => action). If a user has this role it 
     * can access all the controllers/actions tuple defined there.
	 */
	'roles' => array(
		// Can't access
		'banned'     	=> false,
		
		// Private section details
		'access'		=> array(
			'main'			=> array('index', 'dashboard'),
		),
		
		'multimedia'   		=> array(
			'albums'  		=> array('index', 'view', 'create', 'edit', 'update'),
			'images'  		=> array('index', 'view', 'create', 'edit'),
		),
		'multimedia_all'   		=> array(
			'albums'  		=> array('delete', 'all'),
			'images'  		=> array('delete', 'all'),
		),
		
		'user'   		=> array(
			'users'  		=> array('index', 'view', 'create', 'edit'),
		),
		'user_all' 		=> array(
			'users'  		=> array('delete', 'all'),
		),
		
		// Every access
		'admin'      	=> true,
	),

	/**
	 * Salt for the login hash
	 */
	'login_hash_salt' => 'o87x43ynto87qnc96',

	/**
	 * $_POST key for login username
	 */
	'username_post_key' => 'username',

	/**
	 * $_POST key for login password
	 */
	'password_post_key' => 'password',
);
