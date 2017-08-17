<?php

namespace App\Http\Controllers;

use Ibec\Admin\Fields\Field;
use Ibec\Content\Category;
use Ibec\Content\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Post::where('category_id', 1)->take(5)->get();
        $fields = Field::where('slug', 'manufacturer_1')->first();
        $fields2 = Field::where('slug', 'product_material_case')->first();

        return view('home', compact('products', 'fields', 'fields2'));
    }

    public function catalog($catalog)
    {
        $category = Category::whereHas('nodes', function ($q) use ($catalog){
            $q->where('slug', $catalog);
        })->first();
        $products = Post::where('category_id', $category->id)->get();

        $manufacturer = [
            1 => 'manufacturer_1',
            2 => 'manufacturer_2',
            3 => 'manufacturer_3',
        ];

        $fields = Field::where('slug', $manufacturer[$category->id])->first();
        $fields2 = Field::where('slug', 'product_material_case')->first();

        return view('catalog.index', compact('products', 'category', 'fields', 'fields2'));
    }

    public function show($catalog, $slug)
    {
        $category = Category::whereHas('nodes', function ($q) use ($catalog){
            $q->where('slug', $catalog);
        })->first();

        $product = Post::whereHas('nodes', function ($q) use ($slug){
            $q->where('slug', $slug);
        })->first();

        $manufacturer = [
            1 => 'manufacturer_1',
            2 => 'manufacturer_2',
            3 => 'manufacturer_3',
        ];

        $fields = Field::where('slug', $manufacturer[$category->id])->first();
        $fields2 = Field::where('slug', 'product_material_case')->first();

        return view('catalog.show', compact('category', 'product', 'fields', 'fields2'));
    }
}
