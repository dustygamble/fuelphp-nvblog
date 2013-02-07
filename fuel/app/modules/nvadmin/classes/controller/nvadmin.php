<?php

namespace NVAdmin;

class Controller_NVAdmin extends \Controller_Private 
{    	
	public function before()
	{
		parent::before();
        
        $this->data['page_values']['errors'] = array();
	}
}

/* End of file */