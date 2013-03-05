<?php

namespace NVBlog;

class Model_Image extends \Orm\Model 
{ 
    protected static $_table_name = 'nvblog_images';
    protected static $_properties = array(
        'id',
        'user_id',
        'filename',
        'size',
        'title',
        'slug',
        'text',
        'created_at',  
        'updated_at'
        );

    protected static $_observers = array(
        'Orm\\Observer_CreatedAt',
        'Orm\\Observer_UpdatedAt',
        );

    protected static $_belongs_to = array(
        'user' => array(
            'model_to' => '\\Model_User',
            )
        );

    protected static $_has_many = array(
        'users' => array(
            'key_from' => 'id',
            'model_to' => '\\Model_User',
            'key_to' => 'image_id',
            'cascade_save' => true,
            'cascade_delete' => false,
            )
        );

    protected static $_many_many = array(
        'tags' => array(
            'key_from' => 'id',
            'key_through_from' => 'image_id',
            'key_through_to' => 'tag_id',
            'key_to' => 'id',
            'table_through' => 'nvblog_images_tags',
            'model_to' => '\\NVBlog\\Model_Tag',
            'cascade_save' => true,
            'cascade_delete' => false,
            )
        );
}

/* End of file */
