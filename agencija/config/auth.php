<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => 'clients', // Ispravljeno: sada koristi 'clients' umesto 'users'
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'clients',
        ],

        'api' => [
            'driver' => 'sanctum', // Ispravljeno: Laravel koristi Sanctum za API
            'provider' => 'clients',
        ],

        'admin-api' => [
            'driver' => 'sanctum',
            'provider' => 'admins',
        ],

        'admin' => [
            'driver' => 'sanctum',
            'provider' => 'admins',  // Dodaj ovu liniju za admin autentifikaciju
        ],

        'agent-api' => [
            'driver' => 'sanctum',
            'provider' => 'agents',
        ],
    ],

    'providers' => [
        'clients' => [ // Ispravljeno: umesto 'users' sada je 'clients'
            'driver' => 'eloquent',
            'model' => App\Models\Client::class, // Korisnici - Client model
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\Admin::class), // Administratori - Admin model
        ],

        'agents' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\Agent::class), // Agenti - Agent model
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
