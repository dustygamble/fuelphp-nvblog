<?php

namespace NVBlog;

class Model_Tag extends \Orm\Model 
{
    protected static $_table_name = 'nvblog_tags';
    protected static $_properties = array('id', 
                                          'title', 
                                          'created_at',  
                                          'updated_at');
    
    protected static $_observers = array(
        'Orm\\Observer_CreatedAt',
        'Orm\\Observer_UpdatedAt',
    );
	
	protected static $_many_many = array(
	    'contents' => array(
	        'key_from' => 'id',
	        'key_through_from' => 'tag_id',
	        'key_through_to' => 'content_id',
	        'key_to' => 'id',
	        'table_through' => 'nvblog_contents_tags',
            'model_to' => '\\NVBlog\\Model_Content',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    ),
        'images' => array(
	        'key_from' => 'id',
	        'key_through_from' => 'tag_id',
	        'key_through_to' => 'image_id',
	        'key_to' => 'id',
	        'table_through' => 'nvblog_images_tags',
            'model_to' => '\\NVBlog\\Model_Image',
	        'cascade_save' => true,
	        'cascade_delete' => false,
	    ),
	);
}

/* End of file */