<?php

namespace App\Providers;

use Ibec\Feedback\FeedbackGroup;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AdminMenuServiceProvider extends ServiceProvider
{

    public function boot(Factory $view)
    {

        if(app('request')->segment(1) != 'admin')
            return;


        $view->creator(['admin::parts.aside'], function(View $view)
        {
            app('admin_menu')->clearMenu();

            if (!$this->app->runningInConsole()) {

                if(auth('admin')->user()->can('content.content.access')){

                    $roots = \Ibec\Content\Root::all();

                    app('admin_menu')->addSection('content', trans('Контент'), 'fa fa-book text-info-lter', 'Контент');

                    foreach ($roots as $root) {

                        app('admin_menu')->addItem('content', admin_route('content.roots.show', [$root->slug]),
                            $root->category->node->title);

                    }

                    app('admin_menu')->addItem('content', admin_route('content.roots.create'), 'Новый тип');
                }

            }

            if(auth('admin')->user()->can('media.media.access')) {
                app('admin_menu')->addSection('media', trans('Медиа'), 'icon-picture text-info-lter', 'Контент');
                app('admin_menu')->addItem('media', admin_route('media.galleries.index'), trans('Галереи'));
            }


            if(auth('admin')->user()->can('menu.menu.access')) {
                app('admin_menu')->addSection('menu', trans('Меню'), 'fa fa-list text-info-lter', 'Контент');
                app('admin_menu')->addItem('menu', admin_route('menu.tree.index'), 'Управление');
            }

            if(auth('admin')->user()->can('translations.translations.access')) {
                app('admin_menu')->addSection('translations', trans('Переводы'), 'fa fa-language text-info-lter', 'Контент');
                app('admin_menu')->addItem('translations', admin_route('translations.index'), trans('Переводы'));
            }

            if(auth('admin')->user()->can('feedback.feedback.access')) {
                if (!$this->app->runningInConsole()) {
                    $feedback_groups = FeedbackGroup::all();

                    app('admin_menu')->addSection('feedback', trans('Обратная связь'), 'icon-envelope-letter text-info-lter', 'Обратная связь');

                    foreach ($feedback_groups as $feedback_group) {

                        app('admin_menu')->addItem('feedback', admin_route('feedback.feedback_groups.show', [$feedback_group->id]), $feedback_group->node->title);

                    }

                    app('admin_menu')->addItem('feedback', admin_route('feedback.feedback_groups.create'), 'Новая форма');
                }
            }

            if(auth('admin')->user()->can('fields.fields.access')) {
                app('admin_menu')->addSection('fields', trans('Поля'), 'glyphicon glyphicon-edit text-info-lter', 'Обратная связь');
                app('admin_menu')->addItem('fields', admin_route('fields.index'), trans('Поля'));
                app('admin_menu')->addItem('fields', admin_route('fields.create'), trans('Новое поле'));
            }

            if(auth('admin')->user()->can('acl.acl.access')) {
                app('admin_menu')->addSection('acl', trans('Доступ'), 'icon-lock text-danger-lter', 'Доступ');
                app('admin_menu')->addItem('acl', admin_route('acl.users.index'), 'Пользователи');
                app('admin_menu')->addItem('acl', admin_route('acl.roles.index'), 'Роли');
            }

            if(auth('admin')->user()->can('useractivities.useractivities.access')) {
                app('admin_menu')->addSection('user_activities', trans('Логирование пользователей'), 'fa fa-list-alt text-danger-lter', 'Доступ');
                app('admin_menu')->addItem('user_activities', admin_route('user_activities.index'), trans('Логирование пользователей'));
            }

            if(auth('admin')->user()->can('settings.settings.access')) {
                app('admin_menu')->addSection('settings', 'Заказы');
                app('admin_menu')->addItem('settings', '/admin/callbacks', 'Заказы на звонок');
                app('admin_menu')->addItem('settings', '/admin/orders', 'Заказ товара');
                app('admin_menu')->addItem('settings', '/admin/subs', 'Подписчики');
            }
        });

    }
}
