<?php

namespace NVBlog;

class Controller_NVAdmin_Contents extends \NVAdmin\Controller_NVAdmin 
{
    public function before() 
    {
        parent::before();

        \Lang::load('NVBlog::nvblog', 'nvblog');
    }

    public function action_index() 
    {
        if (\Input::post('option') == 'delete') 
        {
            $this->delete_all(\Input::post('selected'));
            \Response::redirect('admin/blog/contents');
        }

        // Create a pagination 
        $pagination = \Pagination::forge('list-contents', array(
            'pagination_url' => \Uri::base(false) . 'admin/blog/contents/index/',
            'total_items' => Model_Content::find()->count(),
            'per_page' => 5,
            'uri_segment' => 5,
            'num_links' => 5,
            ));

        // Get values
        $contents = Model_Content::find()
            ->order_by('id', 'desc')
            ->offset($pagination->offset)
            ->limit($pagination->per_page)
            ->get();

        $breadcrumb = array(\Lang::get('nvblog.private.contents.shared.name_plural') => '');

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.contents.index.title');
        $this->data['partials']['pagination'] = $pagination->render();
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        $this->data['page_values']['contents']= $contents;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/contents/index');
    }

    public function action_view($id) 
    {
        // Get values
        $content = Model_Content::find($id);

        $breadcrumb = array(
            \Lang::get('nvblog.private.contents.shared.name_plural') => 'admin/blog/contents',
            $content->title => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.contents.view.title').': '.$content->title;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        $this->data['page_values']['content']= $content;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/contents/view');
    }

    public function action_create() 
    {
        $content = null;

        // Set validation
        $val = \Validation::forge('create-content');
        $val->add_field('title', \Lang::get('nvblog.private.shared.title'), 'required');
        $val->add_field('tag', \Lang::get('nvblog.private.shared.tag'), 'required|min_length[3]');
        $val->add_field('preview', \Lang::get('nvblog.private.shared.preview'), 'required|min_length[15]');

        // Run validation
        if($val->run())
        {
            // Create a new page
            $content = Model_Content::forge(array(
                'user_id' => $this->global_user['id'],
                'title' => $val->validated('title'),
                'slug' => \Inflector::friendly_title($val->validated('title'), '-', true),
                'preview' => $val->validated('preview'),
                'text' => \Input::post('text'),
                'published' => \Input::post('published'),
                ));

            try
            {
                $content->save();
                \NVUtility\NVTag::save_tag($val->validated('tag'), $content->id, array('table' => 'nvblog_contents_tags', 'id' => 'content_id', 'model' => '\\NVBlog\\Model_Tag'));

                \Session::set_flash('success', \Lang::get('nvblog.shared.messages.add.success'));
                \Response::redirect('admin/blog/contents/view/'.$content->id);
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

        // Get values
        $categories = Model_Category::find()
            ->order_by('title', 'asc')
            ->get();

        $images = \NVBlog\Model_Image::find()
            ->order_by('id', 'desc')
            ->limit(20)
            ->get();

        $breadcrumb = array(
            \Lang::get('nvblog.private.contents.shared.name_plural') => 'admin/blog/contents',
            \Lang::get('nvblog.private.contents.add.title') => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.contents.add.title');
        $this->data['page_values']['content'] = $content;
        $this->data['page_values']['images'] = $images;
        $this->data['page_values']['categories'] = $categories;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/contents/create');
    }

    public function action_delete($id) 
    {
        $content = Model_Content::find($id);

        if(!empty($content))
        {
            $content->delete();
            \Session::set_flash('success', \Lang::get('nvblog.shared.messages.delete.success'));
        } 
        else 
        {
            \Session::set_flash('error', \Lang::get('nvblog.shared.messages.delete.error'));
        }

        \Response::redirect('admin/blog/contents/index');
    }

    public function action_edit($id) 
    {
        $content = Model_Content::find($id);

        // Set validation
        $val = \Validation::forge('edit-content');
        $val->add_field('title', \Lang::get('nvblog.private.shared.title'), 'required');
        $val->add_field('tag', \Lang::get('nvblog.private.shared.tag'), 'required|min_length[3]');
        $val->add_field('preview', \Lang::get('nvblog.private.shared.preview'), 'required|min_length[15]');

        // Run validation
        if($val->run())
        {
            $content->title = $val->validated('title');
            $content->slug = \Inflector::friendly_title($val->validated('title'), '-', true);
            $content->preview = $val->validated('preview');
            $content->text = \Input::post('text');
            $content->published = \Input::post('published');
            $content->categories = $this->update_categories();

            try
            {
                $content->save();
                \NVUtility\NVTag::edit_tag($val->validated('tag'), $id, array('table' => 'nvblog_contents_tags', 'id' => 'content_id', 'model' => '\\NVBlog\\Model_Tag'));

                \Session::set_flash('success', \Lang::get('nvblog.shared.messages.edit.success'));
                \Response::redirect('admin/blog/contents/view/'.$content->id);
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

        // Get values
        $categories = Model_Category::find()
            ->order_by('title', 'asc')
            ->get();

        $images = \NVBlog\Model_Image::find()
            ->order_by('id', 'desc')
            ->limit(20)
            ->get();        

        $breadcrumb = array(
            \Lang::get('nvblog.private.contents.shared.name_plural') => 'admin/blog/contents',
            $content->title => 'admin/blog/contents/view/'.$id,
            \Lang::get('nvblog.shared.edit') => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.contents.edit.title').": ".$content->title;
        $this->data['page_values']['content'] = $content;
        $this->data['page_values']['images'] = $images;
        $this->data['page_values']['categories'] = $categories;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/contents/edit');
    }

    public function delete_all($contents_id = array()) 
    {
        if (isset($contents_id) && count($contents_id) > 0) 
        {
            foreach ($contents_id as $content_id) 
            {
                $content = Model_Content::find($content_id);

                if(!empty($content))
                {
                    $content->delete();
                }
            }

            \Session::set_flash('success', \Lang::get('nvblog.shared.messages.delete.success_plural'));
        } 
        else 
        {
            \Session::set_flash('error', \Lang::get('nvblog.shared.messages.index.error'));
        }
    }

    public function update_categories() 
    {
        $categories = array();
        $categories_id = \Input::post('selected');

        if (count($categories_id)) 
        {
            foreach ($categories_id as $category_id) 
            {
                $categories[] = Model_Category::find($category_id);
            }
        }

        return $categories;
    }

}

/* End of file */
