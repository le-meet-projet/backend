<?php


function no_image(){
    return env('NO_IMAGE');
}

if (!function_exists('email')) {
    function email()
    {
        return new \App\Helpers\Email();
    }
}

if (!function_exists('sms')) {
    function sms()
    {
        return new \App\Helpers\SMS();
    }
}