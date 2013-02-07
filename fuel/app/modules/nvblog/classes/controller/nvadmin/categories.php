<?php

namespace NVBlog;

class Controller_NVAdmin_Categories extends \NVAdmin\Controller_NVAdmin
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
            \Response::redirect('admin/blog/categories');
		}
        
        // Create a pagination 
        $pagination = \Pagination::forge('list-categories', array(
            'pagination_url' => \Uri::base(false) . 'admin/blog/categories/index/',
            'total_items' => Model_Category::find()->count(),
            'per_page' => 10,
            'uri_segment' => 5,
            'num_links' => 5,
        ));
        
        // Get pages based on pagination
        $categories = Model_Category::find()
                ->order_by('id', 'desc')
                ->offset($pagination->offset)
                ->limit($pagination->per_page)
                ->get();

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.categories.index.title');
        $this->data['partials']['pagination'] = $pagination->render();
        $this->data['page_values']['breadcrumbs'] = array(\Lang::get('nvblog.private.categories.shared.name_plural') => '');
        $this->data['page_values']['categories']= $categories;
        
        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/categories/index');
	}
	
	public function action_view($id)
	{
        // Get page
		$category = Model_Category::find($id);
        $breadcrumb = array(
			\Lang::get('nvblog.private.categories.shared.name_plural') => 'admin/blog/categories',
			$category->title => ''
		);
		
		// Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.categories.view.title').': '.$category->title;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        $this->data['page_values']['category']= $category;
        
        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/categories/view');
	}
	
    public function action_create()
	{
        $category = null;
        
		// Set validation
		$val = \Validation::forge('create-category');
		$val->add_field('title', \Lang::get('nvblog.private.shared.title'), 'required');
		
		// Run validation
		if($val->run())
		{
            // Create a new page
			$category = Model_Category::forge(array(
                'title'     =>  $val->validated('title'),
			));
            
            try
            {
                $category->save();
                        
                \Session::set_flash('success', \Lang::get('nvblog.shared.messages.add.success'));
				\Response::redirect('admin/blog/categories/view/'.$category->id);
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
			\Lang::get('nvblog.private.categories.shared.name_plural') => 'admin/blog/categories',
			\Lang::get('nvblog.private.categories.add.title') => ''
		);
        
		// Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.categories.add.title');
		$this->data['page_values']['category'] = $category;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        
        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/categories/create');
	}
	
	public function action_delete($id)
	{
		$category = Model_Category::find($id);
                
		if(!empty($category))
		{			
			$category->delete();
			\Session::set_flash('success', \Lang::get('nvblog.shared.messages.delete.success'));
		}
		else
		{
			\Session::set_flash('error', \Lang::get('nvblog.shared.messages.delete.error'));
		}
		
		\Response::redirect('admin/blog/categories/index');
	}
	
	public function action_edit($id)
	{
        $category = Model_Category::find($id);
		
		// Set validation
		$val = \Validation::forge('edit-category');
		$val->add_field('title', \Lang::get('nvblog.private.shared.title'), 'required');
		
		// Run validation
		if($val->run())
		{
			$category->title = $val->validated('title');
			
            try
            {
                $category->save();
                        
                \Session::set_flash('success', \Lang::get('nvblog.shared.messages.edit.success'));
				\Response::redirect('admin/blog/categories/view/'.$category->id);
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
			\Lang::get('nvblog.private.categories.shared.name_plural') => 'admin/blog/categories',
			$category->title => 'admin/blog/categories/view/'.$id,
			\Lang::get('nvblog.shared.edit') => ''
		);
        
		// Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvblog.private.categories.edit.title').": ".$category->title;
		$this->data['page_values']['category'] = $category;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        
        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvblog/categories/edit');
	}
    
    public function delete_all($categories_id = array())
	{
        if(isset($categories_id) && count($categories_id)>0) 
        {   
            foreach ($categories_id as $category_id) 
            {
                $category = Model_Category::find($category_id);
                
                if(!empty($category))
                {
                    $category->delete();
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