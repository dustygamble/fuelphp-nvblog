<?php

namespace NVBlog;

class Model_Content extends \Orm\Model 
{    
    protected static $_table_name = 'nvblog_contents';
    protected static $_properties = array('id', 
                                          'user_id', 
                                          'title',  
                                          'slug',   
                                          'preview',  
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
    
    protected static $_many_many = array(
	    'categories' => array(
	        'key_from' => 'id',
	        'key_through_from' => 'content_id',
	        'key_through_to' => 'category_id',
	        'key_to' => 'id',
	        'table_through' => 'nvblog_contents_categories',
            'model_to' => '\\NVBlog\\Model_Category',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    ),
        'tags' => array(
	        'key_from' => 'id',
	        'key_through_from' => 'content_id',
	        'key_through_to' => 'tag_id',
	        'key_to' => 'id',
	        'table_through' => 'nvblog_contents_tags',
            'model_to' => '\\NVBlog\\Model_Tag',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    )
	);
}

/* End of file */
