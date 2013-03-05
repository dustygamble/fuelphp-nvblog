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
        \Lang::load('NVAdmin::nvadmin', 'nvadmin');
        \Theme::instance()->set_template($this->template);

        // Default values
        $this->data['template_values']['title'] = 'NVBlog';
    }

    public function action_index()
    {
        \Response::redirect('admin/login');
    }

    public function action_login()
    {       
        // Check if user has logged in
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
                \Session::set_flash('success', \Lang::get('nvadmin.public.login_success'));
                \Response::redirect('admin/dashboard');
            }
            else
            {
                $this->data['page_values']['errors'] = \Lang::get('nvadmin.public.login_error');
            }
        }
        else
        {
            $this->data['page_values']['errors'] = $val->show_errors();
        }

        // Set templates variables
        $this->data['template_values']['subtitle'] = 'Login';
        $this->data['template_values']['description'] = \Lang::get('nvadmin.public.login');
        $this->data['template_values']['keywords'] = 'login, access denied';
    }

    public function action_logout()
    {
        \Auth::instance()->logout();
        \Session::set_flash('success', \Lang::get('nvadmin.public.logout'));
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
