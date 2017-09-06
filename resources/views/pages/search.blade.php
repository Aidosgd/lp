@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        [v-cloak] {
            display: none
        }
    </style>
@endsection

@section('content')
    <div class="catalog" id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 catalog-content">
                    <div class="top-content">
                        <div class="categories">
                            <ul class="nav nav-pills catalog-menu">
                                <li><a href="/catalog/clocks">Швейцарские часы</a></li>
                                <li><a href="/catalog/jewelries">Ювелирные украшения</a></li>
                                <li><a href="/catalog/accessories">Аксессуары</a></li>
                            </ul>
                        </div>
                        <div class="pull-right sort-by">
                            <select name="sortBy" id="">
                                <option value="0">По новизне</option>
                                <option value="1">по возрастанию цены</option>
                                <option value="2">по убыванию цены</option>
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="main-products">
                        <div class="row">
                            @foreach($articles as $item)
                                <div class="col-md-3">
                                    <div class="product">
                                        <a v-bind:href="product.link">
                                            <img class="img-responsive" src="{{ $item->images->first()->path }}">
                                            <div class="product__title">{{ $item->node->brand }}</div>
                                            <div class="product__desc">{{ $item->node->title }}</div>
                                            <div class="product__desc-sec">{{ $item->node->product_material_case }}</div>
                                            <div class="product__price">{{ $item->node->price }} тг</div>
                                            <div class="product__price-dollar">~ {{ $item->node->price_d }} $</div>
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