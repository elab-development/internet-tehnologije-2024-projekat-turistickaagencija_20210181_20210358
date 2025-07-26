<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => 'clients',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'clients',
        ],

        'api' => [
            'driver' => 'sanctum', 
            'provider' => 'clients',
        ],

        'admin-api' => [
            'driver' => 'sanctum',
            'provider' => 'admins',
        ],

        'admin' => [
            'driver' => 'sanctum',
            'provider' => 'admins',  
        ],

        'agent-api' => [
            'driver' => 'sanctum',
            'provider' => 'agents',
        ],
    ],

    'providers' => [
        'clients' => [ 
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\Client::class)
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\Admin::class),
        ],

        'agents' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\Agent::class), 
        ],
    ],

    'passwords' => [
        'clients' => [  // Ispravljeno: sada koristi 'clients' umesto 'users'
            'provider' => 'clients',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'agents' => [
            'provider' => 'agents',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
