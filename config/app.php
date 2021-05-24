<?php
return [
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'allowed-url' => [
        'http://localhost',
        'http://localhost:8080',
        'http://localhost:8080/',
        'http://localhost:8081',
        'http://172.21.0.52:8050',
        'https://hdf.51talk.ph',
    ],
    'unguard-url' => [
        'login',
        'logout',
        'home',
        'policy',
        'news',
        'token-check',
        'search-user',
    ],
]
?>
