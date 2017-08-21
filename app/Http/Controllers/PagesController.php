<?php

namespace App\Http\Controllers;

use Ibec\Content\Post;
use Ibec\Menu\Database\Menu;

class PagesController extends Controller
{
    public function show($slug = 'pledge')
    {
        $menu = Menu::with('children')->find(1);

        $main_menu = $menu
            ->descendants()
            ->with('linkable')
            ->get()
            ->toHierarchy();

        $post = Post::whereHas('nodes', function ($q) use ($slug){
            $q->where('slug', $slug);
        })->first();

        return view('pages.show', compact('main_menu', 'post'));
    }

    public function contacts()
    {

        return view('pages.contacts');
    }
}
