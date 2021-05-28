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