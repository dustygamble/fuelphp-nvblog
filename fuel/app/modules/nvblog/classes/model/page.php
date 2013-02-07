<?php

namespace NVBlog;

class Model_Page extends \Orm\Model 
{    
    protected static $_table_name = 'nvblog_pages';
    protected static $_properties = array('id', 
                                          'user_id', 
                                          'title',  
                                          'slug',  
                                          'text', 
                                          'published', 
                                          'created_at',  
                                          'updated_at');
    
    protected static $_observers = array(
        'Orm\\Observer_CreatedAt',
        'Orm\\Observer_UpdatedAt',
    );
    
    protected static $_belongs_to = array(
        'user' => array(
            'model_to' => '\\Model_User',
        )
    );
}

/* End of file */
