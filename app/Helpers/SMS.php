<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class SMS
{
    private $to;
    private $msg;
    private $apiKey;
    private $userSender;
    private $userName;

    public function __construct()
    {
        $this->apiKey = env('SMS_API_KEY');
        $this->userSender = env('SMS_USER_SENDER');
        $this->userName = env('SMS_USER_NAME');
    }

    public function to($to)
    {
        $this->to = $to;
        return $this;
    }

    public function msg($msg)
    {
        $this->msg = $msg;
        return $this;
    }

    public function send()
    {
        $fields = array(
            "userName" => $this->userName,
            "numbers" => $this->to,
            "userSender" => $this->userSender,
            "apiKey" =>  $this->apiKey,
            "msg" => $this->msg
        );
        
        return Http::post('https://www.msegat.com/gw/sendsms.php', $fields);
    }
}