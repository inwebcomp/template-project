<?php

namespace App\Providers;

use InWeb\Admin\App\Admin;
use InWeb\Admin\App\Events\ServingAdmin;
use InWeb\Admin\App\Providers\AdminApplicationServiceProvider;
use InWeb\Admin\App\Resources\AdminUser;
use InWeb\Admin\TranslatablePhrases\TranslatablePhrases;

class AdminServiceProvider extends AdminApplicationServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Admin::setDefaultLocale('ru');

        Admin::resources([
            AdminUser::class,
        ]);

        Admin::serving(function (ServingAdmin $event) {
//             Admin::script('admin-dist-js', base_path('public/admin-dist/js/app.js'));
//             Admin::style('admin-dist-css', base_path('public/admin-dist/css/app.css'));
//
//             Admin::group('users', __('Пользователи'), 'user');
//
//             Admin::groupedMenu();

//            Admin::setMenu([
//                'users' => [
//                    AdminUser::class
//                ]
//            ]);
        });
    }

    /**
     * Get the cards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new TranslatablePhrases()
        ];
    }
}
