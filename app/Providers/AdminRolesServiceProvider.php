<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class AdminRolesServiceProvider extends ServiceProvider
{

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {

        if(app('request')->segment(1) != 'admin')
            return;

        $this->app['acl.registrar']->set('content',
            [
                'content' => ['access'],
            ]
        );


        $this->app['acl.registrar']->set('media',
            [
                'media' => ['access'],
            ]
        );

        $this->app['acl.registrar']->set('menu',
            [
                'menu' => ['access'],
            ]
        );

        $this->app['acl.registrar']->set('translations',
            [
                'translations' => ['access'],
            ]
        );

        $this->app['acl.registrar']->set('feedback',
            [
                'feedback' => ['access'],
            ]
        );

        $this->app['acl.registrar']->set('fields',
            [
                'fields' => ['access'],
            ]
        );

        $this->app['acl.registrar']->set('acl',
            [
                'acl' => ['access'],
            ]
        );

        $this->app['acl.registrar']->set('useractivities',
            [
                'useractivities' => ['access'],
            ]
        );

        $this->app['acl.registrar']->set('siteusers',
            [
                'siteusers' => ['access'],
            ]
        );

        $this->app['acl.registrar']->set('settings',
            [
                'settings' => ['access'],
            ]
        );

    }
}
