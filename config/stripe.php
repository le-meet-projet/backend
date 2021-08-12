<?php

return [
    'test' => [
        'public_key' => env('STRIPE_TEST_PUBLIC_KEY'),
        'secret_key' => env('STRIPE_TEST_SECRET_KEY')
    ],
    'live' => [
        'public_key' => env('STRIPE_LIVE_PUBLIC_KEY'),
        'secret_key' => env('STRIPE_LIVE_SECRET_KEY') 
    ],
    'settings' => [
        'mode' => env('STRIPE_MODE', 'test')
    ]
];