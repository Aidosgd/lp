@extends('layouts.app')

@section('content')
    <div class="product-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="picture row">
                        <div class="col-md-4">
                            <div id="bx-pager">
                                @foreach($product->images as $index => $image)
                                    <a data-slide-index="{{ $index }}" href=""><img class="img-responsive" src="{{ $image->path }}" /></a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-8">
                            <ul class="bxslider">
                                @foreach($product->images as $image)
                                    <li><img class="img-responsive" src="{{ $image->path }}" /></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                    $manufacturer = [
                        1 => isset($product->node->fields->manufacturer_1) ? $product->node->fields->manufacturer_1 : '',
                        2 => isset($product->node->fields->manufacturer_2) ? $product->node->fields->manufacturer_2 : '',
                        3 => isset($product->node->fields->manufacturer_3) ? $product->node->fields->manufacturer_3 : '',
                    ];
                    ?>
                    <div class="product-page__title">{{ $fields->options['options']['ru'][$manufacturer[$product->category->id]] }}</div>
                    <div class="product-page__desc">{{ $product->node->title }}</div>
                    @if(isset($product->node->fields->product_material_case))<div class="product-page__desc-sec">{{ $fields2->options['options']['ru'][$product->node->fields->product_material_case] }}</div>@endif
                    <?php
                        $price = [
                            1 => isset($product->node->fields->price_1) ? $product->node->fields->price_1 : '',
                            2 => isset($product->node->fields->price_2) ? $product->node->fields->price_2 : '',
                            3 => isset($product->node->fields->price_3) ? $product->node->fields->price_3 : '',
                        ];
                        $price_d = $price[$category->id] / $currencies;
                    ?>
                    <div class="product__price">{{ $price[$category->id] }} тг</div>
                    <div class="product-page__price-dollar">~ {{ number_format($price_d) }} $</div>
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