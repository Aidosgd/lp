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

        if($category->id == 1){
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
                    'product_condition' => $product_post->node->fields->product_condition,
                    'product_sex' => $product_post->node->fields->product_sex,
                    'product_type' => $product_post->node->fields->product_type,
                    'product_brand' => $product_post->node->fields->manufacturer_1,
                    'show' => true,
                ]);
            }

            $fields = $fields->options['options']['ru'];
            $productBrand = new Collection();
            foreach($fields as $product) {
                $productBrand->push([
                    'title' => $product,
                ]);
            }

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
                    'product_condition' => $product_post->node->fields->product_condition_2,
                    'product_type' => $product_post->node->fields->product_type_2,
                    'product_brand' => $product_post->node->fields->manufacturer_2,
                    'show' => true,
                ]);
            }

            $fields = $fields->options['options']['ru'];
            $productBrand = new Collection();
            foreach($fields as $product) {
                $productBrand->push([
                    'title' => $product,
                ]);
            }

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
                    'product_condition' => $product_post->node->fields->product_condition_3,
                    'product_brand' => $product_post->node->fields->manufacturer_3,
                    'show' => true,
                ]);
            }

            $fields = $fields->options['options']['ru'];
            $productBrand = new Collection();
            foreach($fields as $product) {
                $productBrand->push([
                    'title' => $product,
                ]);
            }

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

        return view('catalog.index', compact('products', 'category', 'productBrand', 'fields2',
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

        if($filters['product_condition']){
            $products_post->whereHas('nodes', function($q) use ($filters){
                if (count($filters['product_condition']) == 1){
                    $q->whereRaw('JSON_CONTAINS(fieldsproduct_condition" = ?', (string)$filters['product_condition'][0]);
//                    $q->where('fields->product_condition', (string)$filters['product_condition'][0]);
                }else{
                    $q->whereIn('fields->product_condition', $filters['product_condition']);
                }

            });
        }
        if($filters['product_sex']){
            $products_post->whereHas('nodes', function($q) use ($filters){
                if (count($filters['product_sex']) == 1){
                    $q->where('fields->product_sex', (string)$filters['product_sex'][0]);
                }else{
                    $q->whereIn('fields->product_sex', $filters['product_sex']);
                }

            });
        }
        if($filters['product_type']){
            $products_post->whereHas('nodes', function($q) use ($filters){
                if (count($filters['product_type']) == 1){
                    $q->where('fields->product_type', (string)$filters['product_type'][0]);
                }else{
                    $q->whereIn('fields->product_type', $filters['product_type']);
                }

            });
        }

        $products_post = $products_post->get();

//        dd($products_post->count());


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

        $type = [
            1 => 'product_type',
            2 => 'product_type_2',
        ];

        $fields = Field::where('slug', $manufacturer[$category->id])->first();
        $fields2 = Field::where('slug', 'product_material_case')->first();
        $fields3 = Field::where('slug', 'product_sex')->first();
        if($category->id != 3){
            $fields4 = Field::where('slug', $type[$category->id])->first();
        }
        $fields5 = Field::where('slug', 'product_condition')->first();
        $fields6 = Field::where('slug', 'strap_material')->first();

        return view('catalog.show', compact('category', 'product', 'fields',
            'fields2', 'fields3', 'fields4', 'fields5', 'fields6'));
    }
}
