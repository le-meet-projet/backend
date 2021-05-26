<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResponseFactory;

class ResponseServiceProvider extends ServiceProvider
{
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('success', function ($message = '', $data = false) use ($factory) {

            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - LARAVEL_START;
            $seconds = number_format($seconds, 3) . ' seconds';

            $format = [
                'state' => true,
                'code' => 200,
                'message' => $message,
                'execution' => $seconds
            ];
            if ($data) {
                $format['data'] = $data;
            }

            return $factory->make($format);
        });

        $factory->macro('error', function ($code, $message = '', $data = []) use ($factory) {

            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - LARAVEL_START;
            $seconds = number_format($seconds, 3) . ' seconds';

            $false = [
                'state' => false,
                'code' => $code,
                'message' => $message,
                'execution' => $seconds,
            ];

            if ($data) {
                $false['data'] = $data;
            }

            return $factory->make($false);
        });

        $factory->macro('data', function ($data = false) use ($factory) {

            $executionEndTime = microtime(true);
            $seconds = $executionEndTime - LARAVEL_START;
            $seconds = number_format($seconds, 3) . ' seconds';

            $format = [
                'state' => true,
                'code' => 200,
                'message' => '',
                'execution' => $seconds
            ];

            $format['data'] = $data ?? [];

            return $factory->make($format);
        });

    }
}