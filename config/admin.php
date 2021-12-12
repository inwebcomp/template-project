<?php

use \Illuminate\Session\Middleware\AuthenticateSession;
use InWeb\Admin\App\Http\Middleware\BootTools;
use InWeb\Admin\App\Http\Middleware\DispatchServingAdminEvent;

return [
    'path' => 'admin',

    'default_route' => '/',

    'auth' => [
        'login' => 'admin',
        'email' => 'admin@sitename.com',
        'password' => 'admin'
    ],

    'middleware' => [
        'web',
        DispatchServingAdminEvent::class,
        BootTools::class,
        AuthenticateSession::class,
        'admin-auth',
    ],
];
