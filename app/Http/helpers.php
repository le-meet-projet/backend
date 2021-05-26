<?php


function no_image(){
    return  'https://obazaar-test.com/not-found.png';
}

if (!function_exists('email')) {
    function email()
    {
        return new \App\Helpers\Email();
    }
}