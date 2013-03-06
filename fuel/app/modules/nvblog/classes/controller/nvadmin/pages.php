<?php

namespace NVBlog;

class Controller_NVAdmin_Pages extends \NVAdmin\Controller_NVAdmin 
{
    public function before() 
    {
        parent::before();

        \Lang::load('NVBlog::nvblog', 'nvblog');
    }

    public function action_index()
    {		
        if(\Input::post('option') == 'delete')
        {
            $this->delete_all(\Input::post('selected'));   
            \Response::redirect('admin/blog/pages');
        }

        // Create a pagination 
        $pagination = \Pagination::forge('list-pages', array(
            'pagination_url' => \Uri::base(false) . 'admin/blog/pages/index/',
            'total_items' => Model_Page::find()->count(),
            'per_page' => 10,
            'uri_segment' => 5,
            'num_links' => 5,
            ));

        // Get values
        $pages = Model_Page::find()
            ->order_by('id', 'desc')
            ->offset($pagination->offset)
            ->limit($pagination->per_page)
            ->get();

        $breadcrumb = array(\Lang::get('nvblog.private.pages.shared.name_plural') => '');

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.pages.index.title');
        $this->data['partials']['pagination'] = $pagination->render();
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        $this->data['page_values']['pages']= $pages;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/pages/index');
    }

    public function action_view($id)
    {
        // Get values
        $page = Model_Page::find($id);

        $breadcrumb = array(
            \Lang::get('nvblog.private.pages.shared.name_plural') => 'admin/blog/pages',
            $page->title => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.pages.view.title').': '.$page->title;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        $this->data['page_values']['page']= $page;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/pages/view');
    }

    public function action_create()
    {    
        $page = null;

        // Set validation
        $val = \Validation::forge('create-page');
        $val->add_field('title', \Lang::get('nvblog.private.shared.title'), 'required');

        // Run validation
        if($val->run())
        {
            // Create a new page
            $page = Model_Page::forge(array(
                'user_id'   =>  $this->global_user['id'],
                'title'     =>  $val->validated('title'),
                'slug'      =>  \Inflector::friendly_title($val->validated('title'), '-', true),
                'text'      =>  \Input::post('text'),
                'published' =>  \Input::post('published'),
                ));

            try
            {
                $page->save();

                \Session::set_flash('success', \Lang::get('nvblog.shared.messages.add.success'));
                \Response::redirect('admin/blog/pages/view/'.$page->id);
            } 
            catch(\Database_Exception $e) 
            { 
                $errors['create'] = \Lang::get('nvblog.exception.title_already_exists_exception');
            }
        }
        else 
        {
            $errors = $val->error();
        }

        $images = \NVBlog\Model_Image::find()
            ->order_by('id', 'desc')
            ->limit(20)
            ->get();

        $breadcrumb = array(
            \Lang::get('nvblog.private.pages.shared.name_plural') => 'admin/blog/pages',
            \Lang::get('nvblog.private.pages.add.title') => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.pages.add.title');
        $this->data['page_values']['page'] = $page;
        $this->data['page_values']['images'] = $images;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/pages/create');
    }

    public function action_delete($id)
    {
        $page = Model_Page::find($id);

        if(!empty($page))
        {			
            $page->delete();
            \Session::set_flash('success', \Lang::get('nvblog.shared.messages.delete.success'));
        }
        else
        {
            \Session::set_flash('error', \Lang::get('nvblog.shared.messages.delete.error'));
        }

        \Response::redirect('admin/blog/pages/index');
    }

    public function action_edit($id)
    {
        $page = Model_Page::find($id);

        // Set validation
        $val = \Validation::forge('edit-page');
        $val->add_field('title', \Lang::get('nvblog.private.shared.title'), 'required');

        // Run validation
        if($val->run())
        {
            $page->title = $val->validated('title');
            $page->slug = \Inflector::friendly_title($val->validated('title'), '-', true);
            $page->text = \Input::post('text');
            $page->published = \Input::post('published');

            try
            {
                $page->save();

                \Session::set_flash('success', \Lang::get('nvblog.shared.messages.edit.success'));
                \Response::redirect('admin/blog/pages/view/'.$page->id);
            } 
            catch(\Database_Exception $e) 
            { 
                $errors['update'] = \Lang::get('nvblog.exception.title_already_exists_exception');
            }
        }
        else
        {
            $errors = $val->error();
        }

        $images = \NVBlog\Model_Image::find()
            ->order_by('id', 'desc')
            ->limit(20)
            ->get();

        $breadcrumb = array(
            \Lang::get('nvblog.private.pages.shared.name_plural') => 'admin/blog/pages',
            $page->title => 'admin/blog/pages/view/'.$id,
            \Lang::get('nvblog.shared.edit') => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.pages.edit.title').": ".$page->title;
        $this->data['page_values']['page'] = $page;
        $this->data['page_values']['images'] = $images;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/pages/edit');
    }

    public function delete_all($pages_id = array())
    {
        if(isset($pages_id) && count($pages_id)>0) 
        {   
            foreach ($pages_id as $page_id) 
            {
                $page = Model_Page::find($page_id);

                if(!empty($page))
                {
                    $page->delete();
                }
            }

            \Session::set_flash('success', \Lang::get('nvblog.shared.messages.delete.success_plural'));
        }
        else 
        {
            \Session::set_flash('error', \Lang::get('nvblog.shared.messages.index.error'));
        }
    }
}

/* End of file */
