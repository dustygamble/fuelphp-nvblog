<?php

class Controller_Public_Main extends \Controller_Public 
{

    public function action_index() 
    {
        \Response::redirect('public/main/cv');
    }

    public function action_cv() 
    {
        // Set template
        \Theme::instance()->asset->css('cv.css', array(), 'public', false);

        $this->data['template_values']['subtitle'] = 'Curriculum Vitae';
        \Theme::instance()->set_partial('content', 'public/main/cv');
    }

    public function post_sendmail() 
    {
        // Define data
        $success = 'Email sent, thanks you!';
        $error = '';

        // Check input
        $value_name = \Input::post('name');
        $value_email = \Input::post('email');
        $value_subject = \Input::post('subject');
        $value_message = \Input::post('message');

        \Log::error($value_message);

        if ($value_name == '') {
            $error = 'Please enter your name.';
        } else if ($value_email == '') {
            $error = 'Please enter your email.';
        } else if ($value_subject == '') {
            $error = 'Please enter the email subject.';
        } else if ($value_message == '') {
            $error = 'Please enter the email message.';
        }

        // Try to send email        
        if ($error == '') 
        {
            $email = \Email::forge();

            $email->to('info@marcopace.it', 'Marco Pace');
            $email->from($value_email, $value_name);
            $email->subject("Email from marcopace.it: ".$value_subject);
            $email->body($value_message);

            try {
                $email->send();
            } catch (\EmailValidationFailedException $e) {
                $error = 'Error during data validation.';
            } catch (\EmailSendingFailedException $e) {
                $error = 'Error while sending the message.';
            }
        }

        $this->response(array(
            'result' => ($error == '') ? 'OK' : 'KO',
            'success' => $success,
            'error' => $error
        ));
    }

}

/* End of file */