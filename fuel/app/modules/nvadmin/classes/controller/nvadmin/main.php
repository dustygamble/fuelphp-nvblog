<?php

namespace NVAdmin;

class Controller_NVAdmin_Main extends \NVAdmin\Controller_NVAdmin
{
	public function action_index()
	{
        \Response::redirect('admin/dashboard');
	}
	
	public function action_dashboard()
	{
		$this->data['page_values']['breadcrumbs'] = array();
		
		// Set template       
        $this->data['template_values']['subtitle'] = 'Dashboard';
        \Theme::instance()->set_partial('breadcrumbs', 'private/_global/breadcrumbs');
        \Theme::instance()->set_partial('content', 'private/nvadmin/main/dashboard');
	}
}

/* End of file */