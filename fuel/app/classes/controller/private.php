<?php

use \Model_User as Model_User;

class Controller_Private extends \Controller
{
	public $template = 'private/default';
    public $data = array();
	
	public function before()
    {
		if (\Input::is_ajax())
		{
			return parent::before();
		}
        
        // Set empty values to avoid errors
        $this->data['site_values'] = array();
        $this->data['template_values'] = array();
        $this->data['page_values'] = array();
		
        // Initial configuration
		\Package::load('nvutility');
        \Theme::instance()->set_template($this->template);
        \Theme::instance()->asset->add_path('upload/');
        
        // Setting authorization
		$permission = array($this->request->controller, $this->request->action);
        $roles = \Config::get('simpleauth.roles', array());
        // Session::set_flash('error', $this->request->controller . ' / ' . $this->request->action);
		
		$auth_id = \Auth::instance()->get_user_id();
		$this->global_user = Model_User::find($auth_id[1]);
        
        // User isn't logged in
        if(!\Auth::check())	
        {
        	\Session::set_flash('error', 'Non sei loggato al sistema.');
        	\Response::redirect('admin/login');
        }
        
        // Check if user can access this section
        if(!\NVUtility\NVPermission::is_allowed($permission))
        {
        	// Check if user can access admin section
        	if(\NVUtility\NVPermission::is_allowed(array('main', $roles['main']['dashboard'])))
        	{
        		\Session::set_flash('error', 'Non puoi accedere a questa sezione.');
        		\Response::redirect('admin/dashboard');
        	}
        	else
        	{
        		\Session::set_flash('error', 'Non puoi entrare nell\'area riservata.');
        		\Response::redirect('admin/login');
        	}
        }
        
        // Set variables
        $this->data['site_values']['global_user'] = $this->global_user;
        
        $this->data['template_values']['title'] = 'NVBlog';
        $this->data['template_values']['subtitle'] = 'Let\'s admin the code!';
        $this->data['template_values']['description'] = 'Sezione riservata';
        $this->data['template_values']['keywords'] = 'administration, access denied';
        
        // Set template 
        \Theme::instance()->set_partial('header', 'private/_global/header');
        \Theme::instance()->set_partial('title', 'private/_global/title');
        \Theme::instance()->set_partial('footer', 'private/_global/footer');
	}
    
    public function after($response)
	{
        if (!\Input::is_ajax())
        {
            \Theme::instance()->set_info('data', $this->data);

            if(empty($response))
            {
                $response = \Response::forge(\Theme::instance());
            }
        }

		return parent::after($response);
	}
}

/* End of file */