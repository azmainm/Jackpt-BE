<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (! function_exists('storeUuid')) {
    function storeUuid($model): void
    {
        $model->uuid = (string) Str::orderedUuid();
    }
}
if (! function_exists('randomString')) {
    function randomString(int $strength = 16, string $input = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
    {
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
}

if (! function_exists('getIp')) {
    /**
     * @return string
     */
    function getIp()
    {
        $ip_methods = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        foreach ($ip_methods as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); //just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }

        return request()->ip();
    }
}

if (! function_exists('uploadFile')) {

    function uploadFile($file, $path = 'reports'): string
    {
        $path = Storage::cloud()->put($path, $file);

        return Storage::disk('s3')->url($path);
    }
}
