<?php

namespace App\Http\Controllers;

use Ibec\Admin\Fields\Field;
use Ibec\Content\Category;
use Ibec\Content\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use function MongoDB\BSON\toJSON;

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
        $products_post = Post::where('category_id', $category->id)->get();

        $products = new Collection();

        $manufacturer = [
            1 => 'manufacturer_1',
            2 => 'manufacturer_2',
            3 => 'manufacturer_3',
        ];

        $fields = Field::where('slug', $manufacturer[$category->id])->first();
        $fields2 = Field::where('slug', 'product_material_case')->first();

        $url = "http://www.nationalbank.kz/rss/get_rates.cfm?fdate=".date("d.m.Y");
        $xml = simplexml_load_file($url);

        $currencies = [];

        foreach($xml->item as $currency_xml)
        {
            $currencies[(string)$currency_xml->title] = $currency_xml;
        }

        $currencies = $currencies['USD']->description;

        foreach($products_post as $product_post) {
            $manufacturer = [
                1 => isset($product_post->node->fields->manufacturer_1) ? $product_post->node->fields->manufacturer_1 : '',
                2 => isset($product_post->node->fields->manufacturer_2) ? $product_post->node->fields->manufacturer_2 : '',
                3 => isset($product_post->node->fields->manufacturer_3) ? $product_post->node->fields->manufacturer_3 : '',
            ];

            $price = [
                1 => isset($product_post->node->fields->price_1) ? $product_post->node->fields->price_1 : '',
                2 => isset($product_post->node->fields->price_2) ? $product_post->node->fields->price_2 : '',
                3 => isset($product_post->node->fields->price_3) ? $product_post->node->fields->price_3 : '',
            ];

            $price_d = $price[$category->id] / $currencies;

            $products->push([
                'link' => '/catalog/'.$category->node->slug.'/'.$product_post->node->slug,
                'img' => $product_post->images[0]->path,
                'brand' => $fields->options['options']['ru'][$manufacturer[$product_post->category->id]],
                'title' => str_limit($product_post->node->title, 25),
                'product_material_case' => isset($product_post->node->fields->product_material_case) ? $fields2->options['options']['ru'][$product_post->node->fields->product_material_case] : '',
                'price' => $price[$category->id],
                'price_d' => number_format($price_d),
            ]);
        }

        if($category->id == 1){
            $product_condition = Field::where('slug', 'product_condition')->first();
            $product_condition = $product_condition->options['options']['ru'];
            $productCondition = new Collection();
            foreach($product_condition as $product) {
                $productCondition->push([
                    'title' => $product,
                ]);
            }

            $product_sex = Field::where('slug', 'product_sex')->first();
            $product_sex = $product_sex->options['options']['ru'];
            $productSex = new Collection();
            foreach($product_sex as $product) {
                $productSex->push([
                    'title' => $product,
                ]);
            }

            $product_type = Field::where('slug', 'product_type')->first();
            $product_type = $product_type->options['options']['ru'];
            $productType = new Collection();
            foreach($product_type as $product) {
                $productType->push([
                    'title' => $product,
                ]);
            }

            $minPrice = $products_post->sortBy(function($post)
            {
                return $post->node->fields->price_1;
            })->first()->node->fields->price_1;

            $maxPrice = $products_post->sortByDesc(function($post)
            {
                return $post->node->fields->price_1;
            })->first()->node->fields->price_1;

        }elseif($category->id == 2){

            $product_condition = Field::where('slug', 'product_condition_2')->first();
            $product_condition = $product_condition->options['options']['ru'];
            $productCondition = new Collection();
            foreach($product_condition as $product) {
                $productCondition->push([
                    'title' => $product,
                ]);
            }

            $minPrice = $products_post->sortBy(function($post)
            {
                return $post->node->fields->price_2;
            })->first()->node->fields->price_2;

            $maxPrice = $products_post->sortByDesc(function($post)
            {
                return $post->node->fields->price_2;
            })->first()->node->fields->price_2;

        }elseif($category->id == 3){

            $product_condition = Field::where('slug', 'product_condition_3')->first();
            $product_condition = $product_condition->options['options']['ru'];
            $productCondition = new Collection();
            foreach($product_condition as $product) {
                $productCondition->push([
                    'title' => $product,
                ]);
            }

            $minPrice = $products_post->sortBy(function($post)
            {
                return $post->node->fields->price_3;
            })->first()->node->fields->price_3;

            $maxPrice = $products_post->sortByDesc(function($post)
            {
                return $post->node->fields->price_3;
            })->first()->node->fields->price_3;

        }

        return view('catalog.index', compact('products', 'category', 'fields', 'fields2',
            'productCondition', 'productSex', 'productType', 'minPrice', 'maxPrice'));
    }

    public function catalogPost($catalog, Request $request)
    {
        $filters = $request->all();

        $category = Category::whereHas('nodes', function ($q) use ($catalog){
            $q->where('slug', $catalog);
        })->first();

        $products_post = Post::query();

        $products_post->where('category_id', $category->id);

        foreach ($filters as $filter){
            $products_post->whereHas('nodes', function($q) use ($filter){
                $q->where('fields->'.$filter[1], (string)$filter[0]);
            });
        }

        $products_post = $products_post->get();


        $products = new Collection();

        $manufacturer = [
            1 => 'manufacturer_1',
            2 => 'manufacturer_2',
            3 => 'manufacturer_3',
        ];

        $fields = Field::where('slug', $manufacturer[$category->id])->first();
        $fields2 = Field::where('slug', 'product_material_case')->first();

        $url = "http://www.nationalbank.kz/rss/get_rates.cfm?fdate=".date("d.m.Y");
        $xml = simplexml_load_file($url);

        $currencies = [];

        foreach($xml->item as $currency_xml)
        {
            $currencies[(string)$currency_xml->title] = $currency_xml;
        }

        $currencies = $currencies['USD']->description;

        foreach($products_post as $product_post) {
            $manufacturer = [
                1 => isset($product_post->node->fields->manufacturer_1) ? $product_post->node->fields->manufacturer_1 : '',
                2 => isset($product_post->node->fields->manufacturer_2) ? $product_post->node->fields->manufacturer_2 : '',
                3 => isset($product_post->node->fields->manufacturer_3) ? $product_post->node->fields->manufacturer_3 : '',
            ];

            $price = [
                1 => isset($product_post->node->fields->price_1) ? $product_post->node->fields->price_1 : '',
                2 => isset($product_post->node->fields->price_2) ? $product_post->node->fields->price_2 : '',
                3 => isset($product_post->node->fields->price_3) ? $product_post->node->fields->price_3 : '',
            ];

            $price_d = $price[$category->id] / $currencies;

            $products->push([
                'link' => '/catalog/'.$category->node->slug.'/'.$product_post->node->slug,
                'img' => $product_post->images[0]->path,
                'brand' => $fields->options['options']['ru'][$manufacturer[$product_post->category->id]],
                'title' => str_limit($product_post->node->title, 25),
                'product_material_case' => isset($product_post->node->fields->product_material_case) ? $fields2->options['options']['ru'][$product_post->node->fields->product_material_case] : '',
                'price' => $price[$category->id],
                'price_d' => number_format($price_d),
            ]);
        }

        return response()->json($products);
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
