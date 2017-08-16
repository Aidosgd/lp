@extends('layouts.app')

@section('content')
    <div class="catalog">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 catalog-sidebar">
                    <h4>Отобрать по</h4>
                    <div class="checked-label">
                        <label>Часы с пробегом <i class="fa fa-close"></i></label>
                        <label>Rolex <i class="fa fa-close"></i></label>
                        <label>PATEK PHILIPPE <i class="fa fa-close"></i></label>
                        <span><i class="fa fa-refresh"></i> Сбросить все</span>
                    </div>
                    <h4>Состояние</h4>
                    <div class="checkbox-filter radio-checkbox">
                        <input id="check1" type="checkbox" name="check" value="check1">
                        <label for="check1">Абсолютно новые</label>
                        <br>
                        <input id="check2" type="checkbox" name="check" value="check2">
                        <label for="check2">Часы с пробегом</label>
                    </div>
                    <h4>Бренд</h4>
                    <div class="modal-filter">
                        <button class="btn btn-default" data-toggle="modal" data-target="#myModal">Выбрать бренд</button>
                    </div>
                    <h4>Кому</h4>
                    <div class="checkbox-filter radio-checkbox">
                        <input id="check3" type="checkbox" name="check" value="check3">
                        <label for="check3">Женские</label>
                        <br>
                        <input id="check4" type="checkbox" name="check" value="check4">
                        <label for="check4">Мужские</label>
                        <br>
                        <input id="check5" type="checkbox" name="check" value="check5">
                        <label for="check5">Унисекс</label>
                    </div>
                    <h4>Стоимость</h4>
                    <div class="range-filter">
                        <div id="slider-range"></div>
                        <div class="range-input">
                            от <input type="text" id="amount" readonly>
                            до <input type="text" id="amount2" readonly> тг
                        </div>
                    </div>
                    <h4 class="collapsed" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Стоимость <i class="fa fa-caret-down"></i></h4>
                    <div class="checkbox-filter radio-checkbox">
                        <div class="collapse" id="collapseExample">
                            <div class="checkbox-filter radio-checkbox">
                                <input id="check6" type="checkbox" name="check" value="check6">
                                <label for="check6">Женские</label>
                                <br>
                                <input id="check7" type="checkbox" name="check" value="check7">
                                <label for="check7">Мужские</label>
                                <br>
                                <input id="check8" type="checkbox" name="check" value="check8">
                                <label for="check8">Унисекс</label>
                            </div>
                        </div>
                    </div>
                    <h4 class="collapsed" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">Стоимость <i class="fa fa-caret-down"></i></h4>
                    <div class="checkbox-filter radio-checkbox">
                        <div class="collapse" id="collapseExample2">
                            <div class="checkbox-filter radio-checkbox">
                                <input id="check9" type="checkbox" name="check" value="check9">
                                <label for="check9">Женские</label>
                                <br>
                                <input id="check10" type="checkbox" name="check" value="check10">
                                <label for="check10">Мужские</label>
                                <br>
                                <input id="checck11" type="checkbox" name="check" value="checck11">
                                <label for="checck11">Унисекс</label>
                            </div>
                        </div>
                    </div>
                    <h4 class="collapsed" role="button" data-toggle="collapse" href="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">Стоимость <i class="fa fa-caret-down"></i></h4>
                    <div class="checkbox-filter radio-checkbox">
                        <div class="collapse" id="collapseExample3">
                            <div class="checkbox-filter radio-checkbox">
                                <input id="check12" type="checkbox" name="check" value="check12">
                                <label for="check12">Женские</label>
                                <br>
                                <input id="check13" type="checkbox" name="check" value="check13">
                                <label for="check13">Мужские</label>
                                <br>
                                <input id="check14" type="checkbox" name="check" value="check14">
                                <label for="check14">Унисекс</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 catalog-content">
                    <div class="top-content">
                        <div class="categories">
                            <ul class="nav nav-pills catalog-menu">
                                <li><a href="/catalog/clocks">Швейцарские часы</a></li>
                                <li><a href="/catalog/jewelries">Ювелирные украшения</a></li>
                                <li><a href="/catalog/accessories">Аксессуары</a></li>
                            </ul>
                        </div>
                        <div class="pull-right sort-by">
                            <select name="" id="">
                                <option value="">По новизне</option>
                                <option value="">По новизне2</option>
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="main-products">
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-md-3">
                                    <div class="product">
                                        <a href="/catalog/{{ $category->node->slug }}/{{ $product->node->slug }}">
                                            <img class="img-responsive" src="{{ $product->images->first()->path }}" alt="">
                                            <div class="product__title">{{ str_limit($product->node->title, 15) }}</div>
                                            <div class="product__desc">Calatrava 5960 WG Limited Edition</div>
                                            <div class="product__desc-sec">18-к белое золото</div>
                                            <?php
                                                $price = [
                                                    1 => isset($product->node->fields->price_1) ? $product->node->fields->price_1 : '',
                                                    2 => isset($product->node->fields->price_2) ? $product->node->fields->price_2 : '',
                                                    3 => isset($product->node->fields->price_3) ? $product->node->fields->price_3 : '',
                                                ];
                                                $price_d = $price[$category->id] / $currencies;
                                            ?>
                                            <div class="product__price">{{ $price[$category->id] }} тг</div>
                                            <div class="product__price-dollar">~ {{ number_format($price_d) }} $</div>
                                        </a>
                                    </div>
                                </div>
                                @if($loop->iteration == 4)
                                    <div class="clearfix"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        // Main menu active li elements
        $('.catalog-menu a').each(function(){
            var href = $(this).attr('href').replace( '#', '').split('/').pop();
            var url = window.location.href.split('/').pop();
            if(url == href)
                $(this).closest('li').addClass('active');
        });
    </script>
@endsection