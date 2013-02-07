<?php

use \Model_User as Model_User;

class Controller_Public extends \Controller_Hybrid {

    public $template = 'public/default';
    public $data = array();

    public function before() {
        if (\Input::is_ajax()) {
            return parent::before();
        }

        // Set empty values to avoid errors
        $this->data['site_values'] = array();
        $this->data['template_values'] = array();
        $this->data['page_values'] = array();

        // Initial configuration
        \Package::load('nvutility');
        \Theme::instance()->set_template($this->template);

        // Get current segments
        $segments = \Uri::segments();
        if (empty($segments))
            $segments[0] = 'blog';

        // Set variables
        $this->data['template_values']['title'] = 'MarcoPace.it';
        $this->data['template_values']['subtitle'] = 'My coding place';
        $this->data['template_values']['description'] = 'Sito personale di Marco Pace';
        $this->data['template_values']['keywords'] = 'fotografie, nikon, programmazione';
        $this->data['template_values']['segments'] = $segments;

        // Set template 
        \Theme::instance()->set_partial('header', 'public/_global/header');
        \Theme::instance()->set_partial('footer', 'public/_global/footer');
    }

    public function action_404() {
        $messages = array('Accidenti!', 'Che succede?', 'Uh Oh!', 'No, non qui...', 'Huh ?');

        $this->data['page_values']['title'] = $messages[array_rand($messages)];
        \Theme::instance()->set_partial('content', 'public/main/404');
    }

    public function after($response) {
        if (!\Input::is_ajax()) {
            \Theme::instance()->set_info('data', $this->data);

            if (empty($response)) {
                $response = \Response::forge(\Theme::instance());
            }
        }

        return parent::after($response);
    }

}

/* End of file */