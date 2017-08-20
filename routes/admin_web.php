<?php


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