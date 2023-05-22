<?php

return [
    'whitelisted_ip_redis_key_name' => env('WHITELISTED_IP_REDIS_KEY_NAME', 'WHITELISTED_IPS'),
    'minio_base_url' => env('AWS_ENDPOINT', 'https://tikweb4sp.tikweb.com:8080'),
];
