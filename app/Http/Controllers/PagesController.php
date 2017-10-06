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

        $seo = [
            'title' => $post->node->seo_title,
            'description' => $post->node->seo_description,
            'keywords' => $post->node->seo_keywords
        ];

        view()->share(compact('seo'));

        return view('pages.show', compact('main_menu', 'post'));
    }

    public function contacts()
    {
        $seo = [
            'title' => 'Контакты | Часовой Ломбард «Перспектива»,',
            'description' => 'Если вы хотите заложить, продать или купить швейцарские часы, то будем рады приветствовать вас в нашем ломбарде часов',
            'keywords' => 'контакты ломбарда часов, адрес часового ломбарда'
        ];

        view()->share(compact('seo'));

        return view('pages.contacts');
    }
}
