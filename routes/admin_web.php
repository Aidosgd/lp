<?php

Route::model('callbacks', \App\Callback::class);
Route::resource('callbacks', 'Admin\CallbacksController', ['as' => config('admin.uri')]);
Route::model('orders', \App\Order::class);
Route::resource('orders', 'Admin\OrdersController', ['as' => config('admin.uri')]);
Route::model('subs', \App\Subs::class);
Route::resource('subs', 'Admin\SubsController', ['as' => config('admin.uri')]);

$router->group([
], function($router)
{
    $router->resource('roots.posts', 'Admin\PostsController', ['as' => config('admin.uri').'.content']);
});

$router->get('posts.json', [
    'as' => admin_prefix('content.posts.json'),
    function()
    {
        return \Ibec\Content\Post::with('category')->get()->toJson();
    }
]);