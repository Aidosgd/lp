<?php

namespace App\Http\Controllers;

use Ibec\Content\Category;
use Ibec\Content\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Post::where('category_id', 1)->take(5)->get();

        return view('home', compact('products'));
    }

    public function catalog($catalog)
    {
        $category = Category::whereHas('nodes', function ($q) use ($catalog){
            $q->where('slug', $catalog);
        })->first();
        $products = Post::where('category_id', $category->id)->get();

        return view('catalog.index', compact('products', 'category'));
    }

    public function show($catalog, $slug)
    {
        $category = Category::whereHas('nodes', function ($q) use ($catalog){
            $q->where('slug', $catalog);
        })->first();

        $product = Post::whereHas('nodes', function ($q) use ($slug){
            $q->where('slug', $slug);
        })->first();

        return view('catalog.show', compact('category', 'product'));
    }
}
