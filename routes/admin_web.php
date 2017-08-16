<?php


$router->model('roots', 'Ibec\Content\Root');
$router->model('categories', 'Ibec\Content\Category');
$router->model('posts', '\Ibec\Content\Post');

$router->get('roots/{roots}/confirmDestroy', 'RootsController@confirmDestroy');

$router->resource('roots', 'RootsController', ['as' => config('admin.uri').'.content']);
$router->resource('roots.categories', 'CategoriesController', ['as' => config('admin.uri').'.content']);

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