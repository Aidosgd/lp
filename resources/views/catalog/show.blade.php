@extends('layouts.app')

@section('content')
    <div class="product-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="picture row">
                        <div class="col-md-4">
                            <div id="bx-pager">
                                <a data-slide-index="0" href=""><img class="img-responsive" src="{{ $product->images->first()->path }}" /></a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <ul class="bxslider">
                                <li><img class="img-responsive" src="{{ $product->images->first()->path }}" /></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="product-page__title">{{ $product->node->title }}</div>
                    <div class="product-page__desc">Calatrava 5960 WG Limited Edition</div>
                    <div class="product-page__desc-sec">18-к белое золото</div>
                    <?php
                    $price = [
                        1 => isset($product->node->fields->price_1) ? $product->node->fields->price_1 : '',
                        2 => isset($product->node->fields->price_2) ? $product->node->fields->price_2 : '',
                        3 => isset($product->node->fields->price_3) ? $product->node->fields->price_3 : '',
                    ];
                    ?>
                    <div class="product__price">{{ $price[$category->id] }} тг</div>
                    <div class="product-page__price-dollar">~ 1 969 $</div>
                    <button class="btn btn-default">Заказать</button>
                </div>
                <div class="col-md-4">
                    <div class="company-desc">
                        <img class="img-responsive" src="/images/4c884d50b8.png" alt="">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur aut eveniet itaque quis tenetur, voluptate. Ab commodi debitis earum eius explicabo sed unde voluptatem. Ab laboriosam minima odio reprehenderit sint?</p>
                    </div>
                </div>
            </div>

            <div class="row product-descriptions">
                <div class="col-md-6">
                    <ul>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                        <li><span>test:</span> <span class="right">brand</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.bxslider').bxSlider({
            pagerCustom: '#bx-pager'
        });
    </script>
@endsection