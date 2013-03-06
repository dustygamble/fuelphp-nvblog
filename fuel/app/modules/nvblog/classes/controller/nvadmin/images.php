<?php

namespace NVBlog;

class Controller_NVAdmin_Images extends \NVAdmin\Controller_NVAdmin {

    public $upload_path = '';
    public $upload_max_width = '';

    public function before() 
    {
        parent::before();

        \Lang::load('nvblog::nvblog', 'nvblog');
        \Theme::instance()->asset->add_path('upload/');
    }

    public function action_index() 
    {
        if (\Input::post('option') == 'delete') 
        {
            $this->delete_all(\Input::post('selected'));
            \Response::redirect('admin/blog/images');
        }

        // Create a pagination 
        $pagination = \Pagination::forge('list-images', array(
            'pagination_url' => \Uri::base(false) . 'admin/blog/images/index/',
            'total_items' => Model_Image::find()->count(),
            'per_page' => 24,
            'uri_segment' => 5,
            'num_links' => 5,
            ));

        // Get values
        $images = Model_Image::find()
            ->order_by('id', 'desc')
            ->offset($pagination->offset)
            ->limit($pagination->per_page)
            ->get();

        $breadcrumb = array(\Lang::get('nvblog.private.images.shared.name_plural') => '');

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.images.index.title');
        $this->data['partials']['pagination'] = $pagination->render();
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        $this->data['page_values']['images']= $images;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/images/index');
    }

    public function action_view($id) 
    {
        // Get values
        $image = Model_Image::find($id);

        $breadcrumb = array(
            \Lang::get('nvblog.private.images.shared.name_plural') => 'admin/blog/images',
            $image->title => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.images.view.title') . ': ' . $image->title;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        $this->data['page_values']['image']= $image;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/images/view');
    }

    public function action_create() 
    {
        $image = null;

        // Set validation
        $val = \Validation::forge('create-image');
        $val->add_field('title', \Lang::get('nvblog.private.shared.title'), 'required');
        $val->add_field('tag', \Lang::get('nvblog.private.shared.tag'), 'required|min_length[3]');

        // Run validation
        if($val->run())
        {
            $tot_error = 0;

            \Upload::process();
            if (\Upload::is_valid()) 
            {
                // Upload file
                \Upload::save();
                $files = \Upload::get_files();

                // Create images thumbnails
                foreach ($files as $file) 
                {
                    $model = array(
                        'user_id' => $this->global_user['id'],
                        'title' => $val->validated('title'),
                        'text' => \Input::post('text')
                        );

                    $image = Helper_Image::upload_file($file, $model);

                    try 
                    {
                        $image->save();
                        \NVUtility\NVTag::save_tag($val->validated('tag'),$image->id, array('table' => 'nvblog_images_tags', 'id' => 'image_id', 'model' => '\\nvblog\\Model_Tag'));
                    } 
                    catch (\Database_Exception $e) 
                    {
                        $tot_error++;
                        $errors['create'] = \Lang::get('nvblog.exception.title_already_exists_exception');
                    }
                }

                if ($tot_error == 0) 
                {
                    \Session::set_flash('success', \Lang::get('nvblog.shared.messages.add.success'));
                    \Response::redirect('admin/blog/images/view/' . $image->id);
                } 
                else 
                {
                    \Session::set_flash('error', \Lang::get('nvblog.shared.messages.add.error'));
                }
            }
        }
        else 
        {
            $errors = $val->error();
        }

        $breadcrumb = array(
            \Lang::get('nvblog.private.pages.shared.name_plural') => 'admin/blog/pages',
            \Lang::get('nvblog.private.pages.add.title') => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.images.add.title');
        $this->data['page_values']['image'] = $image;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/images/create');
    }

    public function action_delete($id) 
    {
        $image = Model_Image::find($id);

        if(!empty($image))
        {    
            if (!$this->delete_files($id)) 
            {
                $image->delete();
                \Session::set_flash('success', \Lang::get('nvblog.shared.messages.delete.success'));
            } 
            else 
            {
                \Session::set_flash('error', \Lang::get('nvblog.shared.messages.delete.error'));
            }
        } 
        else 
        {
            \Session::set_flash('error', \Lang::get('nvblog.shared.messages.delete.error'));
        }

        \Response::redirect('admin/blog/images/index');
    }

    public function action_edit($id) 
    {
        $image = Model_Image::find($id);

        // Set validation
        $val = \Validation::forge('edit-image');
        $val->add_field('title', \Lang::get('nvblog.private.shared.title'), 'required');
        $val->add_field('tag', \Lang::get('nvblog.private.shared.tag'), 'required|min_length[3]');

        // Run validation
        if($val->run())
        {
            $image->title = $val->validated('title');
            $image->slug = \Inflector::friendly_title($val->validated('title'), '-', true);
            $image->text = \Input::post('text');

            try
            {
                $image->save();
                \NVUtility\NVTag::edit_tag($val->validated('tag'), $id, array('table' => 'nvblog_images_tags', 'id' => 'image_id', 'model' => '\\nvblog\\Model_Tag'));

                \Session::set_flash('success', \Lang::get('nvblog.shared.messages.edit.success'));
                \Response::redirect('admin/blog/images/view/' . $image->id);
            } 
            catch(\Database_Exception $e) 
            { 
                $errors['edit'] = \Lang::get('nvblog.exception.title_already_exists_exception');
            }
        }
        else
        {
            $errors = $val->error();
        }

        $breadcrumb = array(
            \Lang::get('nvblog.private.images.shared.name_plural') => 'admin/blog/images',
            $image->title => 'admin/blog/images/view/' . $id,
            \Lang::get('nvblog.shared.edit') => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.images.edit.title') . ": " . $image->title;
        $this->data['page_values']['image'] = $image;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/images/edit');
    }

    public function delete_all($images_id = array()) 
    {
        if (isset($images_id) && count($images_id) > 0) 
        {
            foreach ($images_id as $image_id) 
            {
                $image = Model_Image::find($image_id);

                if(!empty($image)) 
                {
                    if (!$this->delete_files($image_id)) 
                    {
                        $image->delete();
                        \Session::set_flash('success', \Lang::get('nvblog.shared.messages.delete.success'));
                    } 
                    else 
                    {
                        \Session::set_flash('error', \Lang::get('nvblog.shared.messages.delete.error'));
                    }
                }
            }
        } 
        else 
        {
            \Session::set_flash('error', \Lang::get('nvblog.shared.messages.index.error'));
        }
    }

    public function delete_files($id) 
    {
        $error = false;
        $image = Model_Image::find($id);

        if(!empty($image))
        {    
            // Delete all images
            $error = Helper_Image::delete_files($image->filename);                      
            $error = Helper_Image::delete_files($image->filename, array('original'));
        }

        return $error;
    }
}

/* End of file */
