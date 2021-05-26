<?php

namespace App\Helpers;

use Exception;

/*
*   usage example
*    
    email()
      ->to('takiddine.job@gmail.com')
      ->subject('Buchungsbestätigung')
      ->view('emails.invoice')
      ->data($data)
      ->send();

     if (!$email->success()) {
        $email->errors();
     }

*/

class Email
{
    private $from;
    private $to;
    private $data;
    private $view;
    private $fromName;
    private $apikey;
    private $success = false;
    private $errors = false;

    public function __construct()
    {
        $this->fromName = env('MAIL_FROM_NAME');
        $this->from = env('MAIL_FROM_ADDRESS');
        $this->apikey = env('ELASTIC_EMAIL_KEY');
    }

    public function to($to)
    {
        $this->to = $to;
        return $this;
    }

    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    public function fromName($fromName)
    {
        $this->fromName = $fromName;
        return $this;
    }

    public function subject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function view($view)
    {
        $this->view = $view;
        return $this;
    }

    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    public function send()
    {
        $url = 'https://api.elasticemail.com/v2/email/send';
        try {
            $post = array(
                'from' => $this->from,
                'fromName' => $this->fromName,
                'apikey' => $this->apikey,
                'subject' => $this->subject,
                'to' => $this->to,
                'bodyHtml' => view($this->view, $this->data),
                'isTransactional' => false
            );

            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $post,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_SSL_VERIFYPEER => false
            ));

            $result = curl_exec($ch);
            $result = json_decode($result);

            $this->success = true;

            if ($result->success != true) {

                $this->success = false;
                $this->errors = $result->error;
            }

            curl_close($ch);
        } catch (Exception $ex) {
            $this->success = false;
            $this->errors = $ex->getMessage();
        }

        return $this;
    }

    public function success()
    {
        return $this->success;
    }

    public function errors()
    {
        return $this->errors;
    }
}
