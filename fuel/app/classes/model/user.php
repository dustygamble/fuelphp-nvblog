<?php

class Model_User extends \Orm\Model 
{    
    protected static $_table_name = 'users';
    protected static $_properties = array('id',
                                          'image_id',
                                          'username',  
                                          'password',  
                                          'group',  
                                          'email',  
                                          'last_login',  
                                          'profile_fields',  
                                          'created_at',  
                                          'updated_at');
    
    protected static $_observers = array(
        'Orm\\Observer_CreatedAt',
        'Orm\\Observer_UpdatedAt',
    );
    
    protected static $_belongs_to = array(
	    'avatar' => array(
	        'key_from' => 'image_id',
	        'model_to' => '\\NVBlog\\Model_Image',
	        'key_to' => 'id',
	        'cascade_save' => true,
	        'cascade_delete' => false,
		),
	);
    
    protected static $_has_many = array(
	    'pages' => array(
            'key_from' => 'id',
            'model_to' => '\\NVBlog\\Model_Page',
            'key_to' => 'user_id',
            'cascade_save' => true,
            'cascade_delete' => true,
        ),
        'contents' => array(
            'key_from' => 'id',
            'model_to' => '\\NVBlog\\Model_Content',
            'key_to' => 'user_id',
            'cascade_save' => true,
            'cascade_delete' => true,
        ),
	    'pictures' => array(
            'key_from' => 'id',
            'model_to' => '\\NVBlog\\Model_Image',
            'key_to' => 'user_id',
            'cascade_save' => true,
            'cascade_delete' => true,
        )
    );
}

/* End of file */