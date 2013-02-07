<?php

return array(
    // Shared common values
    'shared'    => array(
        'perform'   => 'Perform',
        'send'      => 'Send',
        
        'view'      => 'View',
        'add'       => 'Add',
        'edit'      => 'Edit',
        'delete'    => 'Delete',
        'confirm'   => 'Are you sure?',
        
        'messages'  => array(
            'add'    => array(
                'success'   => 'Content created succesfully',
                'error'     => 'Error creating content',
            ),
            'edit'      => array(
                'success'   => 'Content updated succesfully',
                'error'     => 'Error updating content',
            ),
            'delete'    => array(
                'success'           => 'Content deleted succesfully',
                'success_plural'    => 'Contents deleted succesfully',
                'error'             => 'Error deleting content',
            ),
        )
    ),
    
    // Exception values
    'exception' 	=> array(
        'username_already_exists_exception'     => 'Username already exists',
        'email_already_exists_exception'        => 'Email already exists',
        'old_password_invalid_exception'        => 'Old password is invalid',
    ),
    
	// Values for the public section
	'public' 	=> array(
        
    ),
    
    // Values for the admin section
	'private' 	=> array(
        'shared'    => array(
            'action'        => 'Actions',
            'title'         => 'Title',
            'tag'           => 'Tag',
            'preview'       => 'Preview',
            'text'          => 'Text',
            'username'      => 'Username',
            'password'      => 'Password',
            'password_old'  => 'Old password',
            'password_new'  => 'New password',
            'email'         => 'Email',
            'created_at'    => 'Creation date',
            'updated_at'    => 'Last edit',
            'last_login'    => 'Last login',
            'confirm'       => 'Confirm password',
        ),
        
        // Users section
        'users'     => array(
            'shared'    => array(
                'name_singular'     => 'User',
                'name_plural'       => 'Users',
            ),
            'index'     => array('title' => 'Users list'),
            'view'      => array('title' => 'User detail'),
            'add'       => array('title' => 'Add user'),
            'edit'      => array('title' => 'Edit user'),
        ),
    )
);