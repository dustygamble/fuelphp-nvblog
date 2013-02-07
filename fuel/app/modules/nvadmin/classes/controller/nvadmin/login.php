<?php

namespace NVAdmin;

class Controller_NVAdmin_Login extends \Controller 
{
	public $template = 'private/login';
    public $data = array();
    
    public function before()
	{
		parent::before();
        
        // Set empty values to avoid errors
        $this->data['site_values'] = array();
        $this->data['template_values'] = array();
        $this->data['page_values'] = array();
        
        // Initial configuration
        \Package::load('nvutility');
        \Theme::instance()->set_template($this->template);
    }
	
	public function action_index()
	{
		\Response::redirect('admin/login');
	}
	
	public function action_login()
	{		
		// Check if user has logged and if he can access admin section
		if(\Auth::check())
		{
			\Response::redirect('admin/dashboard');
		}
		
		// Set validation
		$val = \Validation::forge('login');
		$val->add_field('username', 'Name', 'required');
		$val->add_field('password', 'Password', 'required');
		
		// Run validation
		if($val->run())
		{
			if(\Auth::instance()->login($val->validated('username'), $val->validated('password')))
			{
				\Session::set_flash('success', 'Sei stato loggato correttamente al sistema.');
				\Response::redirect('admin/dashboard');
			}
			else
			{
				$this->data['page_values']['errors'] = 'Dati errati, riprova.';
			}
		}
		else
		{
			$this->data['site_values']['errors'] = $val->show_errors();
		}
        
        $this->data['template_values']['title'] = 'MarcoPace.it';
        $this->data['template_values']['subtitle'] = 'Login';
        $this->data['template_values']['description'] = 'Effettua il login';
        $this->data['template_values']['keywords'] = 'login, access denied';
	}
	
	public function action_logout()
	{
		\Auth::instance()->logout();
		\Session::set_flash('success', 'Ti sei disconnesso con successo.');
		\Response::redirect('admin/login');
	}
    
    public function after($response)
	{
        \Theme::instance()->set_info('data', $this->data);
        
		if(empty($response))
		{
			$response = \Response::forge(\Theme::instance());
		}

		return parent::after($response);
	}
}

/* End of file */