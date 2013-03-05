<?php

return array(
    // Shared common values
    'shared' => array(
        'perform'   => 'Perform',
        'send'      => 'Send',
        'status'    => 'Status',
        'used'      => 'Used in a relation',
        'view'      => 'View',
        'preview'   => 'Preview',
        'add'       => 'Add',
        'edit'      => 'Edit',
        'delete'    => 'Delete',
        'confirm'   => 'Are you sure?',
        'messages'  => array(
            'index' => array(
                'error' => 'No contents selected',
                ),
            'add' => array(
                'success'   => 'Content created succesfully',
                'error'     => 'Error creating content',
                ),
            'edit' => array(
                'success'   => 'Content updated succesfully',
                'error'     => 'Error updating content',
                ),
            'delete' => array(
                'success'           => 'Content deleted succesfully',
                'success_plural'    => 'Contents deleted succesfully',
                'error'             => 'Error deleting content',
                ),
            ),
        'publish_status' => array(
            'draft'         => 'Draft',
            'published'     => 'Published',
            )
        ),

    // Exception values
    'exception' => array(
        'title_already_exists_exception' => 'Title already exists',
        ),

    // Values for the public section
    'public'    => array(
        ),

    // Values for the admin section
    'private'   => array(
        'shared'    => array(
            'action'        => 'Actions',
            'title'         => 'Title',
            'tag'           => 'Tag',
            'preview'       => 'Preview',
            'text'          => 'Text',
            'author'        => 'Author',
            'contents'      => 'Contents',
            'categories'    => 'Categories',
            'image'         => 'Image',
            'associations'  => 'Associations',
            'created_at'    => 'Creation date',
            'updated_at'    => 'Last edit',

            'options'       => 'Additional options',
            'addimages'     => 'Add image from blog vault'
            ),

        // Pages section
        'pages' => array(
            'shared' => array(
                'name_singular' => 'Page',
                'name_plural'   => 'Pages',
                ),
            'index' => array('title' => 'Pages list'),
            'view'  => array('title' => 'Page detail'),
            'add'   => array('title' => 'Add page'),
            'edit'  => array('title' => 'Edit page'),
            ),

        // Categories section
        'categories' => array(
            'shared' => array(
                'name_singular' => 'Category',
                'name_plural'   => 'Categories',
                ),
            'index' => array('title' => 'Categories list'),
            'view'  => array('title' => 'Category detail'),
            'add'   => array('title' => 'Add category'),
            'edit'  => array('title' => 'Edit category'),
            ),

        // Contents section
        'contents' => array(
            'shared' => array(
                'name_singular'     => 'Content',
                'name_plural'       => 'Contents',
                'tag_instruction'   => 'Tags must have the structure comma+space: "tag1, tag number 2, tag test 3, tag4"'
                ),
            'index' => array('title' => 'Contents list'),
            'view'  => array('title' => 'Content detail'),
            'add'   => array('title' => 'Add content'),
            'edit'  => array('title' => 'Edit content'),
            ),

        // Images section
        'images'     => array(
            'shared'    => array(
                'name_singular'     => 'Image',
                'name_plural'       => 'Images',
                ),
            'index'     => array('title' => 'Images list'),
            'view'      => array('title' => 'Image detail'),
            'add'       => array('title' => 'Add image'),
            'edit'      => array('title' => 'Edit image'),
            ),

        // Tags section
        'tags' => array(
            'shared' => array(
                'name_singular' => 'Tag',
                'name_plural'   => 'Tags',
                ),
            'index' => array('title' => 'Tags list'),
            'view'  => array('title' => 'Tag detail'),
            'add'   => array('title' => 'Add tag'),
            'edit'  => array('title' => 'Edit tag'),
            ),
        )
    );
