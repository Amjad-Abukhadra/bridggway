<?php

return [

    'defaults' => [
        'guard' => 'web', // can stay as 'web' or choose one default
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */
    'guards' => [
        'web' => [ // 👈 ADD THIS BACK
            'driver' => 'session',
            'provider' => 'users',
        ],
        'company' => [
            'driver' => 'session',
            'provider' => 'companies',
        ],

        'college' => [
            'driver' => 'session',
            'provider' => 'colleges',
        ],

        'student' => [
            'driver' => 'session',
            'provider' => 'students',
        ],

        'supervisor' => [
            'driver' => 'session',
            'provider' => 'supervisors',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'companies' => [
            'driver' => 'eloquent',
            'model' => App\Models\Company::class,
        ],

        'colleges' => [
            'driver' => 'eloquent',
            'model' => App\Models\College::class,
        ],

        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,
        ],

        'supervisors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Supervisor::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Reset Settings
    |--------------------------------------------------------------------------
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
