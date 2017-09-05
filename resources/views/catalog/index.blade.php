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
                <div class="col-md-3 catalog-sidebar">
                    <h4>Отобрать по</h4>
                    <div class="checked-label">
                        <label v-for="name in checkedNames">@{{ name }} <i @click="closeLabel(name)" class="fa fa-close"></i></label>
                        <span v-if="checkedNames.length" @click="clearCheckedNames()"><i class="fa fa-refresh"></i> Сбросить все</span>
                    </div>
                    <div v-if="productCondition.length">
                        <h4>Состояние</h4>
                        <div class="checkbox-filter radio-checkbox">
                            <div v-for="(condition, index) in productCondition" v-cloak>
                                <input @click="checkFilter($event)"
                                :data-value="index" data-filter="product_condition"
                                v-bind:id="'condition' + index" type="checkbox" name="check"
                                v-model="checkedNames" v-bind:value="condition.title">
                                <label v-bind:for="'condition' + index">@{{ condition.title }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-filter">
                        <button class="btn btn-default" data-toggle="modal" data-target="#brand">Выбрать бренд</button>
                    </div>
                    <div v-if="productSex.length">
                        <h4>Кому</h4>
                        <div class="checkbox-filter radio-checkbox">
                            <div v-for="(sex, index) in productSex" v-cloak>
                                <input @click="checkFilter($event)" :data-value="index"
                                data-filter="product_sex" v-bind:id="'sex' + index" type="checkbox"
                                name="check" v-model="checkedNames" v-bind:value="sex.title">
                                <label v-bind:for="'sex' + index">@{{ sex.title }}</label>
                            </div>
                        </div>
                    </div>
                    <h4>Стоимость</h4>
                    <div class="range-filter">
                        <div id="slider-range"></div>
                        <div class="range-input">
                            от <input type="text" id="amount" readonly>
                            до <input type="text" id="amount2" readonly> тг
                        </div>
                    </div>
                    <div v-if="productType.length">
                        <h4>Тип</h4>
                        <div class="checkbox-filter radio-checkbox">
                            <div class="checkbox-filter radio-checkbox">
                                <div v-for="(type, index) in productType" v-cloak>
                                    <input @click="checkFilter($event)" :data-value="index"
                                    data-filter="product_type" v-bind:id="'type' + index" type="checkbox"
                                    name="check" v-model="checkedNames" v-bind:value="type.title">
                                    <label v-bind:for="'type' + index">@{{ type.title }}</label>
                                </div>
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
                            <div v-for="product in products" v-if="product.show" v-cloak class="col-md-3">
                                <div class="product">
                                    <a v-bind:href="product.link">
                                        <img class="img-responsive" v-bind:src="product.img">
                                        <div class="product__title">@{{ product.brand }}</div>
                                        <div class="product__desc">@{{ product.title }}</div>
                                        <div class="product__desc-sec">@{{ product.product_material_case }}</div>
                                        <div class="product__price">@{{ product.price | priceFormat }} тг</div>
                                        <div class="product__price-dollar">~ @{{ product.price_d }} $</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="brand" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Бренды</h4>
                    </div>
                    <div class="modal-body">
                        <div v-if="productBrand.length">
                            <div class="checkbox-filter radio-checkbox">
                                <div v-for="(brand, index) in productBrand" v-cloak>
                                    <input @click="checkFilter($event)"
                                           :data-value="index" data-filter="product_brand"
                                           v-bind:id="'brand' + index" type="checkbox" name="check"
                                           v-model="checkedNames" v-bind:value="brand.title">
                                    <label v-bind:for="'brand' + index">@{{ brand.title }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/vue@2.0.3/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        // Main menu active li elements
        $('.catalog-menu a').each(function(){
            var href = $(this).attr('href').replace( '#', '').split('/').pop();
            var url = window.location.href.split('/').pop();
            if(url == href)
                $(this).closest('li').addClass('active');
        });

        Vue.filter('priceFormat', function(value){
            return value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ")
        });

        var app = new Vue({
            el: '#app',
            data: {
                products: {!! $products !!},
                productsAll: {!! $products !!},
                productsDeleted: {},
                productBrand: {!! isset($productBrand) ? $productBrand : '""' !!},
                productCondition: {!! isset($productCondition) ? $productCondition : '""' !!},
                productSex: {!! isset($productSex) ? $productSex : '""' !!},
                productType: {!! isset($productType) ? $productType : '""' !!},
                checkedNames: [],
                count: 0,
                filterData: {
                    product_sex: [],
                    product_condition: [],
                    product_type: [],
                    product_brand: [],
                },
            },

            methods: {
                clearCheckedNames: function clearCheckedNames(){
                    this.checkedNames = []
                    this.products = this.productsAll;
                },
                closeLabel: function closeLabel(name){
                    var found = this.checkedNames.indexOf(name);

                    while (found !== -1) {
                        this.checkedNames.splice(found, 1);
                        found = this.checkedNames.indexOf(name);
                    }

                    this.products = this.productsAll;
                },
                checkFilter: function checkFilter(event){
                    var input = event.target,
                        value = $(input).data('value'),
                        filter = $(input).data('filter'),
                        data = [value, filter],
                        _this = this;

                    setTimeout(function () {
                        if(_this.count >= 0 && _this.count > _this.checkedNames.length){
                            for (var key in _this.filterData){
                                if(key == 'product_condition' && filter == 'product_condition'){
                                    if (_this.filterData.product_condition.indexOf(value) != -1) {
                                        _this.filterData.product_condition.splice(_this.filterData.product_condition.indexOf(value), 1);
                                    }
                                    console.log('product_condition', value)
                                }else if(key == 'product_sex' && filter == 'product_sex'){
                                    if (_this.filterData.product_sex.indexOf(value) != -1) {
                                        _this.filterData.product_sex.splice(_this.filterData.product_sex.indexOf(value), 1);
                                    }
                                    console.log('product_sex', value)
                                }else if(key == 'product_type' && filter == 'product_type'){
                                    if (_this.filterData.product_type.indexOf(value) != -1) {
                                        _this.filterData.product_type.splice(_this.filterData.product_type.indexOf(value), 1);
                                    }
                                    console.log('product_type', value)
                                }else if(key == 'product_brand' && filter == 'product_brand'){
                                    if (_this.filterData.product_brand.indexOf(value) != -1) {
                                        _this.filterData.product_brand.splice(_this.filterData.product_brand.indexOf(value), 1);
                                    }
                                    console.log('product_brand', value)
                                }
                            }


                            _this.products.filter(function(item) {
                                if(_this.checkedNames.length == 0){
                                    console.log('asd', _this.checkedNames.length)
                                    item.show = true;
                                }else{
                                    if(filter == 'product_condition'){
                                        _this.filterData.product_condition.indexOf(parseInt(item.product_condition)) != -1 ? item.show = true : item.show = false;
                                        console.log('product_condition', value)
                                    }else if(filter == 'product_sex'){
                                        _this.filterData.product_sex.indexOf(parseInt(item.product_sex)) != -1 ? item.show = true : item.show = false;
                                        console.log('product_sex', value)
                                    }else if(filter == 'product_type'){
                                        _this.filterData.product_type.indexOf(parseInt(item.product_type)) != -1 ? item.show = true : item.show = false;
                                        console.log('product_type', value)
                                    }else if(filter == 'product_brand'){
                                        _this.filterData.product_brand.indexOf(parseInt(item.product_brand)) != -1 ? item.show = true : item.show = false;
                                        console.log('product_brand', value)
                                    }
                                }

                            });
                        }else{
                            for (var key in _this.filterData){
                                if(key == 'product_condition' && filter == 'product_condition'){
                                    _this.filterData.product_condition.push(value);
                                }else if(key == 'product_sex' && filter == 'product_sex'){
                                    _this.filterData.product_sex.push(value);
                                }else if(key == 'product_type' && filter == 'product_type'){
                                    _this.filterData.product_type.push(value);
                                }else if(key == 'product_brand' && filter == 'product_brand'){
                                    _this.filterData.product_brand.push(value);
                                }
                            }

                            _this.products.filter(function(item) {
                                if(filter == 'product_condition'){
                                    _this.filterData.product_condition.indexOf(parseInt(item.product_condition)) != -1 ? item.show = true : item.show = false;
                                }else if(filter == 'product_sex'){
                                    _this.filterData.product_sex.indexOf(parseInt(item.product_sex)) != -1 ? item.show = true : item.show = false;
                                }else if(filter == 'product_type'){
                                    _this.filterData.product_type.indexOf(parseInt(item.product_type)) != -1 ? item.show = true : item.show = false;
                                }else if(filter == 'product_brand'){
                                    _this.filterData.product_brand.indexOf(parseInt(item.product_brand)) != -1 ? item.show = true : item.show = false;
                                }
                            });
                        }

                    }, 100);

                    this.count = this.checkedNames.length;

                },
                sentRequest: function sentRequest(){
                    var category = '{{ $category->node->slug }}';
                    this.$http.post('/catalog/'+ category, this.filterData, {
                        headers: {
                            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                        }
                    }).then(function (response) {
                        if (response.status == 200) {
                            if(response.data.length == 0) {


                            }
                            else {
                                this.products = response.data;
                            }
                        }
                    });

                },
                priceFilter: function priceFilter(val) {
                    this.products.filter(function (item) {
                        item.price >= val.values[0] && item.price <= val.values[1] ? item.show = true : item.show = false
                    })
                }
            },

            created: function created() {
                var _this = this;
                $( function() {
                    $( "#slider-range" ).slider({
                        range: true,
                        min: {{ $minPrice }},
                        max: {{ $maxPrice }},
                        values: [ {{ $minPrice }}, {{ $maxPrice }} ],
                        slide: function( event, ui ) {
                            $( "#amount" ).val(ui.values[ 0 ] );
                            $( "#amount2" ).val(ui.values[ 1 ] );
                            _this.priceFilter(ui);
                        }
                    });
                    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ));
                    $( "#amount2" ).val($( "#slider-range" ).slider( "values", 1 ));
                } );
            }
        })
    </script>
@endsection