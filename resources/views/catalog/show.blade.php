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
                    <div class="product__price">{{ number_format($price[$category->id], 0, ' ', ' ') }} тг</div>
                    <div class="product-page__price-dollar">~ {{ number_format($price_d, 2, ',', ' ') }} $</div>
                    <button class="btn btn-default">Заказать</button>
                </div>
                <div class="col-md-4">
                    <div class="company-desc">
                        {!! $product->node->content !!}
                    </div>
                </div>
            </div>

            <div class="row product-descriptions">
                <div class="col-md-6">
                    <ul>
                        <li><span>Бренд:</span> <span class="right">{{ $fields->options['options']['ru'][$manufacturer[$product->category->id]] }}</span></li>
                        <li><span>Коллекция:</span> <span class="right">{{ $product->node->title }}</span></li>
                        @if($category->id == 1)<li><span>Кому:</span> <span class="right">{{ $fields3->options['options']['ru'][$product->node->fields->product_sex] }}</span></li>@endif
                        <?php
                            $type = [
                                    1 => isset($product->node->fields->product_type) ? $product->node->fields->product_type : '',
                                    2 => isset($product->node->fields->product_type_2) ? $product->node->fields->product_type_2 : '',
                            ];
                        ?>
                        @if($category->id != 3)<li><span>Тип:</span> <span class="right">{{ $fields4->options['options']['ru'][$type[$product->category->id]] }}</span></li>@endif
                        @if($category->id == 1)<li><span>Материал корпуса:</span> <span class="right">{{ $fields2->options['options']['ru'][$product->node->fields->product_material_case] }}</span></li>@endif
                        @if($category->id == 1)<li><span>Водопроницаемость:</span> <span class="right">{{ $product->node->fields->watertightness }}</span></li>@endif
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        @if($category->id == 1)<li><span>Диаметр корпуса:</span> <span class="right">{{ $product->node->fields->case_diameter }}</span></li>
                        <li><span>Комплектация:</span> <span class="right">{{ $product->node->fields->equipment }}</span></li>
                        <li><span>Цвет циферблата:</span> <span class="right">{{ $product->node->fields->dial_color }}</span></li>
{{--                        <li><span>Тип механизма:</span> <span class="right">{{ $product->node->fields->product_condition }}</span></li>--}}
{{--                        <li><span>Запас хода:</span> <span class="right">{{ $product->node->fields->product_condition }}</span></li>--}}
{{--                        <li><span>Калибр:</span> <span class="right">{{ $product->node->fields->product_condition }}</span></li>--}}
                        <li><span>Состояние:</span> <span class="right">{{ $fields5->options['options']['ru'][$product->node->fields->product_condition] }}</span></li>
                        <li><span>Материал ремешка:</span> <span class="right">{{ $fields6->options['options']['ru'][$product->node->fields->strap_material] }}</span></li>
                        <li><span>Функции:</span> <span class="right">{{ $product->node->fields->function }}</span></li>@endif
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