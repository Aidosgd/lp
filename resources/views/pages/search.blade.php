@extends('layouts.app')

@section('content')
    <div class="catalog" id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 catalog-content">
                    <div class="main-products" style="padding-top: 80px;">
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-md-3">
                                    <div class="product">
                                        <a href="{{ $product->category->id != 6 ? '/catalog' : '' }}/{{ $product->category->node->slug }}/{{ $product->node->slug }}">
                                            <img class="img-responsive" src="{{ $product->images->count() ? $product->images->first()->path : ''}}" alt="">
                                            @if($product->category->id != 6)
                                                <div class="product__title">
                                                    <?php
                                                        $brand = [
                                                            1 => isset($product->node->fields->manufacturer_1) ? $fieldsm1->options['options']['ru'][$product->node->fields->manufacturer_1] : '',
                                                            2 => isset($product->node->fields->manufacturer_2) ? $fieldsm2->options['options']['ru'][$product->node->fields->manufacturer_2] : '',
                                                            3 => isset($product->node->fields->manufacturer_3) ? $fieldsm3->options['options']['ru'][$product->node->fields->manufacturer_3] : ''
                                                        ];
                                                    ?>
                                                    {{ $brand[$product->category->id] }}
                                                </div>
                                            @endif
                                            <div class="product__desc" style="font-size: 20px;">{{ str_limit($product->node->title, 30) }}</div>
                                            @if($product->category->id != 6)
                                                <?php
                                                    $price = [
                                                        1 => isset($product->node->fields->price_1) ? $product->node->fields->price_1 : '',
                                                        2 => isset($product->node->fields->price_2) ? $product->node->fields->price_2 : '',
                                                        3 => isset($product->node->fields->price_3) ? $product->node->fields->price_3 : ''
                                                    ];
                                                    $price_d = $price[$product->category->id] / $currencies;
                                                ?>
                                                <div class="product__price">{{ $price[$product->category->id] }} тг</div>
                                                <div class="product__price-dollar">~ {{ number_format($price_d) }} $</div>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection