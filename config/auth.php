<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],
    // Guard
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
        'adminstrator' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
        'traders' => [
            'driver' => 'session',
            'provider' => 'trader',
        ],
        'surveyors' => [
            'driver' => 'session',
            'provider' => 'surveyor',
        ],
        'surveyors_perusahaan' => [
            'driver' => 'session',
            'provider' => 'surveyor',
        ],
    ],
    //  Providers
    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'trader' => [
            'driver' => 'eloquent',
            'model' => App\Models\Trader::class,
        ],
        'surveyor' => [
            'driver' => 'eloquent',
            'model' => App\Models\Surveyor::class,
        ],
    ],
    // Password
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],
];
