<?php

namespace NVBlog;

class Controller_NVAdmin_Tags extends \NVAdmin\Controller_NVAdmin 
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
            \Response::redirect('admin/blog/tags');
		}
        
        // Create a pagination 
        $pagination = \Pagination::forge('list-tags', array(
            'pagination_url' => \Uri::base(false) . 'admin/blog/tags/index/',
            'total_items' => Model_Tag::find()->count(),
            'per_page' => 10,
            'uri_segment' => 5,
            'num_links' => 5,
        ));
        
        // Get pages based on pagination
        $tags = Model_Tag::find()
                ->order_by('title', 'asc')
                ->offset($pagination->offset)
                ->limit($pagination->per_page)
                ->get();

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.tags.index.title');
        $this->data['partials']['pagination'] = $pagination->render();
        $this->data['page_values']['breadcrumbs'] = array(\Lang::get('nvblog.private.tags.shared.name_plural') => '');
        $this->data['page_values']['tags']= $tags;
        
        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/tags/index');
	}
	
	public function action_view($id)
	{
        // Get tags
		$tag = Model_Tag::find($id);
        $breadcrumb = array(
			\Lang::get('nvblog.private.tags.shared.name_plural') => 'admin/blog/tags',
			$tag->title => ''
		);
        
        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.tags.view.title').': '.$tag->title;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        $this->data['page_values']['tag']= $tag;
        
        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/tags/view');
	}
	
    public function action_create()
	{
        $tag = null;
        
		// Set validation
		$val = \Validation::forge('create-tag');
		$val->add_field('title', \Lang::get('nvblog.private.shared.title'), 'required');
		
		// Run validation
        if($val->run())
		{
            // Create a new page
			$tag = Model_Tag::forge(array(
                'title'     =>  $val->validated('title'),
			));
            
            try
            {
                $tag->save();
                        
                \Session::set_flash('success', \Lang::get('nvblog.shared.messages.add.success'));
				\Response::redirect('admin/blog/tags/view/'.$tag->id);
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
		
		$breadcrumb = array(
			\Lang::get('nvblog.private.tags.shared.name_plural') => 'admin/blog/tags',
			\Lang::get('nvblog.private.tags.add.title') => ''
		);
        
		// Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.tags.add.title');
		$this->data['page_values']['tag'] = $tag;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        
        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/tags/create');
	}
	
	public function action_delete($id)
	{
        $tag = Model_Tag::find($id);
                
		if(!empty($tag))
		{			
			$tag->delete();
			\Session::set_flash('success', \Lang::get('nvblog.shared.messages.delete.success'));
		}
		else
		{
			\Session::set_flash('error', \Lang::get('nvblog.shared.messages.delete.error'));
		}
		
		\Response::redirect('admin/blog/tags/index');
	}
    
    public function action_edit($id)
	{
		$tag = Model_Tag::find($id);
		
		// Set validation
		$val = \Validation::forge('edit-tag');
		$val->add_field('title', \Lang::get('nvblog.private.shared.title'), 'required');
		
		// Run validation
		if($val->run())
		{
			$tag->title = $val->validated('title');
			
            try
            {
                $tag->save();
                        
                \Session::set_flash('success', \Lang::get('nvblog.shared.messages.edit.success'));
				\Response::redirect('admin/blog/tags/view/'.$tag->id);
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
        
        
        $breadcrumb = array(
			\Lang::get('nvblog.private.tags.shared.name_plural') => 'admin/blog/tags',
			$tag->title => 'admin/blog/tags/view/'.$id,
			\Lang::get('nvblog.shared.edit') => ''
		);
        
		// Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.tags.edit.title').": ".$tag->title;
		$this->data['page_values']['tag'] = $tag;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        
        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/tags/edit');
	}
    
    public function delete_all($tags_id = array())
	{
        if(isset($tags_id) && count($tags_id)>0) 
        {   
            foreach ($tags_id as $tag_id) 
            {
                // Retrieve model
                $tag = Model_Tag::find($tag_id);
                
                if(!empty($tag))
                {
                    $tag->delete();
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