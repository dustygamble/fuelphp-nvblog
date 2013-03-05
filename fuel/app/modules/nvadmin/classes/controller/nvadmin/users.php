<?php

namespace NVAdmin;

class Controller_NVAdmin_Users extends \NVAdmin\Controller_NVAdmin
{
    public function before() 
    {
        parent::before();

        \Lang::load('NVAdmin::nvadmin', 'nvadmin');
    }

    public function action_index()
    {        
        // Create a pagination 
        $pagination = \Pagination::forge('list-users', array(
            'pagination_url' => 'admin/users/index/',
            'total_items' => \Model_User::find()->count(),
            'per_page' => 10,
            'uri_segment' => 3,
            'num_links' => 5,
            ));

        // Set values
        $users = \Model_User::find()
            ->order_by('username', 'asc')
            ->offset($pagination->offset)
            ->limit($pagination->per_page)
            ->get();
        $breadcrumb = array(\Lang::get('nvadmin.private.users.shared.name_plural') => '');

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvadmin.private.users.index.title');
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        $this->data['page_values']['users']= $users;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvadmin/users/index');
    }

    public function action_view($id)
    {
        // Set values
        $user = \Model_User::find($id);
        $breadcrumb = array(
            \Lang::get('nvadmin.private.users.shared.name_plural') => 'admin/users',
            $user->username => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvadmin.private.users.view.title').': '.$user->username;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;
        $this->data['page_values']['user']= $user;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvadmin/users/view');
    }

    public function action_create()
    {        
        // Set validation
        $val = \Validation::forge('create-user');
        $val->add_field('email', \Lang::get('nvadmin.private.shared.email'), 'required|valid_email');
        $val->add_field('username', \Lang::get('nvadmin.private.shared.username'), 'required|min_length[3]');
        $val->add_field('password', \Lang::get('nvadmin.private.shared.password'), 'required|min_length[5]');
        $val->add_field('confirm_password', \Lang::get('nvadmin.private.shared.confirm'), 'match_field[password]');

        // Run validation
        if($val->run())
        {
            try
            {
                // Create a new user
                \Auth::instance()->create_user(
                    $val->validated('username'), 
                    $val->validated('password'), 
                    $val->validated('email'),
                    '50'
                    );

                \Session::set_flash('success', \Lang::get('nvadmin.shared.messages.add.success'));
                \Response::redirect('admin/users/index');
            }
            catch(\SimpleUserUpdateException $e) 
            { 
                // Check if username or email already exists
                $user_count = \Model_User::find()->where('username', $val->validated('username'))->count();
                $errors['create'] = ($user_count > 0)
                    ? \Lang::get('nvadmin.exception.username_already_exists_exception')
                    : \Lang::get('nvadmin.exception.email_already_exists_exception');
            }
        }
        else 
        {
            $errors = $val->error();
        }

        // Set values
        $breadcrumb = array(
            \Lang::get('nvadmin.private.users.shared.name_plural') => 'admin/users',
            \Lang::get('nvadmin.private.users.add.title') => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvadmin.private.users.add.title');
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvadmin/users/create');
    }

    public function action_delete($id)
    {
        $user = \Model_User::find($id);

        if(!empty($user))
        {
            $user->delete();
            \Session::set_flash('success', \Lang::get('nvadmin.shared.messages.delete.success'));
        }
        else
        {
            \Session::set_flash('error', \Lang::get('nvadmin.shared.messages.delete.error'));
        }

        \Response::redirect('admin/users/index');
    }

    public function action_edit($id)
    {
        $user = \Model_User::find($id);

        // Set validation
        $val = \Validation::forge('edit-user');
        $val->add_field('email', \Lang::get('nvadmin.private.shared.email'), 'required|valid_email');
        $val->add_field('old_password', \Lang::get('nvadmin.private.shared.password_old'), 'required|min_length[5]');
        $val->add_field('new_password', \Lang::get('nvadmin.private.shared.password_new'), 'required|min_length[5]');
        $val->add_field('confirm_password', \Lang::get('nvadmin.private.shared.confirm'), 'match_field[new_password]');

        // Run validation
        if($val->run())
        {
            // Update user
            $user_data['email'] = $val->validated('email');
            $user_data['old_password'] = $val->validated('old_password');
            $user_data['password'] = $val->validated('new_password');

            try
            {
                $user_count = \Model_User::find()
                    ->where('email', $val->validated('email'))
                    ->where('id', '!=', $id)
                    ->count();
                if($user_count > 0) 
                { 
                    throw new \SimpleUserUpdateException(\Lang::get('nvadmin.exception.email_already_exists_exception'), 2); 
                }

                \Auth::instance()->update_user($user_data, $user->username);

                \Session::set_flash('success', \Lang::get('nvadmin.shared.messages.edit.success'));
                \Response::redirect('admin/users/view/'.$user->id);
            } 
            catch(\SimpleUserUpdateException $e) 
            { 
                $errors['update'] = \Lang::get('nvadmin.exception.email_already_exists_exception'); 
            }
            catch(\SimpleUserWrongPassword $e)   
            { 
                $errors['update'] = \Lang::get('nvadmin.exception.old_password_invalid_exception'); 
            }
        }
        else
        {
            $errors = $val->error();
        }


        $breadcrumb = array(
            \Lang::get('nvadmin.private.users.shared.name_plural') => 'admin/users',
            $user->username => 'admin/users/view/'.$id,
            \Lang::get('nvadmin.shared.edit') => ''
            );

        // Set templates variables
        $this->data['template_values']['subtitle'] = \Lang::get('nvadmin.private.users.edit.title').": ".$user->username;
        $this->data['page_values']['user'] = $user;
        $this->data['page_values']['errors'] = $errors;
        $this->data['page_values']['breadcrumbs'] = $breadcrumb;

        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvadmin/users/edit');
    }
}

/* End of file */
