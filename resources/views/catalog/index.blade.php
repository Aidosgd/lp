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
                        <label v-for="item in checkedNamesLabel" v-cloak>
                            @{{ item.title }}
                            <i @click="closeLabel(item)" class="fa fa-close"></i>
                        </label>
                        <span v-if="checkedNames.length" @click="clearCheckedNames()"><i class="fa fa-refresh"></i> Сбросить все</span>
                    </div>
                    <div v-if="productCondition.length">
                        <h4>Состояние</h4>
                        <div class="checkbox-filter radio-checkbox">
                            <div v-for="(condition, index) in productCondition" v-cloak>
                                <input @click="checkFilter($event)"
                                :data-value="index" data-filter="product_condition" :data-title="condition.title"
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
                                data-filter="product_sex" :data-title="sex.title" v-bind:id="'sex' + index" type="checkbox"
                                name="check" v-model="checkedNames" v-bind:value="sex.title">
                                <label v-bind:for="'sex' + index">@{{ sex.title }}</label>
                            </div>
                        </div>
                    </div>
                    <h4>Стоимость</h4>
                    <div class="range-filter">
                        <div id="slider-range"></div>
                        <div class="range-input">
                            от <input class="money" type="text" id="amount" readonly>
                            до <input class="money" type="text" id="amount2" readonly> тг
                        </div>
                    </div>
                    <div v-if="productType.length">
                        <h4 class="collapsed" role="button"
                            data-toggle="collapse"
                            href="#collapseExample3"
                            aria-expanded="false"
                            aria-controls="collapseExample3">Тип <i class="fa fa-caret-down"></i></h4>
                        <div class="checkbox-filter radio-checkbox">
                            <div class="collapse" id="collapseExample3">
                                <div v-for="(type, index) in productType" v-cloak>
                                    <input @click="checkFilter($event)" :data-value="index"
                                    data-filter="product_type" :data-title="type.title" v-bind:id="'type' + index" type="checkbox"
                                    name="check" v-model="checkedNames" v-bind:value="type.title">
                                    <label v-bind:for="'type' + index">@{{ type.title }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="productCase.length">
                        <h4 class="collapsed" role="button"
                            data-toggle="collapse"
                            href="#collapseExample4"
                            aria-expanded="false"
                            aria-controls="collapseExample4">Форма корпуса <i class="fa fa-caret-down"></i></h4>
                        <div class="checkbox-filter radio-checkbox">
                            <div class="collapse" id="collapseExample4">
                                <div v-for="(type, index) in productCase" v-cloak>
                                    <input @click="checkFilter($event)" :data-value="index"
                                           data-filter="product_case" :data-title="type.title" v-bind:id="'case' + index" type="checkbox"
                                           name="check" v-model="checkedNames" v-bind:value="type.title">
                                    <label v-bind:for="'case' + index">@{{ type.title }}</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="productMaterialCase.length">
                        <h4 class="collapsed" role="button"
                            data-toggle="collapse"
                            href="#collapseExample5"
                            aria-expanded="false"
                            aria-controls="collapseExample5">Материал корпуса <i class="fa fa-caret-down"></i></h4>
                        <div class="checkbox-filter radio-checkbox">
                            <div class="collapse" id="collapseExample5">
                                <div v-for="(type, index) in productMaterialCase" v-cloak>
                                    <input @click="checkFilter($event)" :data-value="index"
                                           data-filter="product_material_case" :data-title="type.title" v-bind:id="'material' + index" type="checkbox"
                                           name="check" v-model="checkedNames" v-bind:value="type.title">
                                    <label v-bind:for="'material' + index">@{{ type.title }}</label>
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
                                        <div class="product__desc-sec">@{{ product.product_material_case_text }}</div>
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
                                           :data-value="index" data-filter="product_brand" :data-title="brand.title"
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
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
                productCase: {!! isset($productCase) ? $productCase : '""' !!},
                productMaterialCase: {!! isset($productMaterialCase) ? $productMaterialCase : '""' !!},
                checkedNames: [],
                checkedNamesLabel: [],
                count: 0,
                filterData: {
                    product_sex: [],
                    product_condition: [],
                    product_type: [],
                    product_brand: [],
                    product_case: [],
                    product_material_case: [],
                },
            },

            methods: {
                clearCheckedNames: function clearCheckedNames(){
                    this.checkedNames = [];
                    this.checkedNamesLabel = [];
                    this.products = this.productsAll;
                },
                closeLabel: function closeLabel(item){
                    var found = this.checkedNames.indexOf(item.title),
                        _this = this;

                    while (found !== -1) {
                        this.checkedNames.splice(found, 1);
                        found = this.checkedNames.indexOf(item.title);
                    }

                    this.checkedNamesLabel.splice(this.checkedNamesLabel.indexOf(item), 1);


                    for (var key in this.filterData){
                        if(key == 'product_condition' && item.filter == 'product_condition'){
                            if (this.filterData.product_condition.indexOf(item.id) != -1) {
                                this.filterData.product_condition.splice(this.filterData.product_condition.indexOf(item.id), 1);
                            }
                        }else if(key == 'product_sex' && item.filter == 'product_sex'){
                            if (this.filterData.product_sex.indexOf(item.id) != -1) {
                                this.filterData.product_sex.splice(this.filterData.product_sex.indexOf(item.id), 1);
                            }
                        }else if(key == 'product_type' && item.filter == 'product_type'){
                            if (this.filterData.product_type.indexOf(item.id) != -1) {
                                this.filterData.product_type.splice(this.filterData.product_type.indexOf(item.id), 1);
                            }
                        }else if(key == 'product_brand' && item.filter == 'product_brand'){
                            if (this.filterData.product_brand.indexOf(item.id) != -1) {
                                this.filterData.product_brand.splice(this.filterData.product_brand.indexOf(item.id), 1);
                            }
                        }else if(key == 'product_case' && item.filter == 'product_case'){
                            if (this.filterData.product_case.indexOf(item.id) != -1) {
                                this.filterData.product_case.splice(this.filterData.product_case.indexOf(item.id), 1);
                            }
                        }else if(key == 'product_material_case' && item.filter == 'product_material_case'){
                            if (this.filterData.product_material_case.indexOf(item.id) != -1) {
                                this.filterData.product_material_case.splice(this.filterData.product_material_case.indexOf(item.id), 1);
                            }
                        }
                    }


                    this.products.filter(function(product) {
                        if(_this.checkedNames.length == 0){
                            product.show = true;
                        }else{
                            if(item.filter == 'product_condition'){
                                _this.filterData.product_condition.indexOf(parseInt(product.product_condition)) != -1 ? product.show = true : product.show = false;
                            }else if(item.filter == 'product_sex'){
                                _this.filterData.product_sex.indexOf(parseInt(product.product_sex)) != -1 ? product.show = true : product.show = false;
                            }else if(item.filter == 'product_type'){
                                _this.filterData.product_type.indexOf(parseInt(product.product_type)) != -1 ? product.show = true : product.show = false;
                            }else if(item.filter == 'product_brand'){
                                _this.filterData.product_brand.indexOf(parseInt(product.product_brand)) != -1 ? product.show = true : product.show = false;
                            }else if(item.filter == 'product_case'){
                                _this.filterData.product_case.indexOf(parseInt(product.product_case)) != -1 ? product.show = true : product.show = false;
                            }else if(item.filter == 'product_material_case'){
                                _this.filterData.product_material_case.indexOf(parseInt(product.product_material_case)) != -1 ? product.show = true : product.show = false;
                            }
                        }

                    });

                },
                checkFilter: function checkFilter(event){
                    var input = event.target,
                        value = $(input).data('value'),
                        filter = $(input).data('filter'),
                        title = $(input).data('title'),
                        data = [value, filter],
                        _this = this,
                        element = {};

                    setTimeout(function () {
                        if(_this.count >= 0 && _this.count > _this.checkedNames.length){
                            for (var key in _this.filterData){
                                if(key == 'product_condition' && filter == 'product_condition'){
                                    if (_this.filterData.product_condition.indexOf(value) != -1) {
                                        _this.filterData.product_condition.splice(_this.filterData.product_condition.indexOf(value), 1);
                                    }
                                }else if(key == 'product_sex' && filter == 'product_sex'){
                                    if (_this.filterData.product_sex.indexOf(value) != -1) {
                                        _this.filterData.product_sex.splice(_this.filterData.product_sex.indexOf(value), 1);
                                    }
                                }else if(key == 'product_type' && filter == 'product_type'){
                                    if (_this.filterData.product_type.indexOf(value) != -1) {
                                        _this.filterData.product_type.splice(_this.filterData.product_type.indexOf(value), 1);
                                    }
                                }else if(key == 'product_brand' && filter == 'product_brand'){
                                    if (_this.filterData.product_brand.indexOf(value) != -1) {
                                        _this.filterData.product_brand.splice(_this.filterData.product_brand.indexOf(value), 1);
                                    }
                                }else if(key == 'product_case' && filter == 'product_case'){
                                    if (_this.filterData.product_case.indexOf(value) != -1) {
                                        _this.filterData.product_case.splice(_this.filterData.product_case.indexOf(value), 1);
                                    }
                                }else if(key == 'product_material_case' && filter == 'product_material_case'){
                                    if (_this.filterData.product_material_case.indexOf(value) != -1) {
                                        _this.filterData.product_material_case.splice(_this.filterData.product_material_case.indexOf(value), 1);
                                    }
                                }
                            }


                            _this.products.filter(function(item) {
                                if(_this.checkedNames.length == 0){
                                    item.show = true;
                                }else{
                                    if(filter == 'product_condition'){
                                        _this.filterData.product_condition.indexOf(parseInt(item.product_condition)) != -1 ? item.show = true : item.show = false;
                                    }else if(filter == 'product_sex'){
                                        _this.filterData.product_sex.indexOf(parseInt(item.product_sex)) != -1 ? item.show = true : item.show = false;
                                    }else if(filter == 'product_type'){
                                        _this.filterData.product_type.indexOf(parseInt(item.product_type)) != -1 ? item.show = true : item.show = false;
                                    }else if(filter == 'product_brand'){
                                        _this.filterData.product_brand.indexOf(parseInt(item.product_brand)) != -1 ? item.show = true : item.show = false;
                                    }else if(filter == 'product_case'){
                                        _this.filterData.product_case.indexOf(parseInt(item.product_case)) != -1 ? item.show = true : item.show = false;
                                    }else if(filter == 'product_material_case'){
                                        _this.filterData.product_material_case.indexOf(parseInt(item.product_material_case)) != -1 ? item.show = true : item.show = false;
                                    }
                                }
                            });

                            element.id = value;
                            element.title = title;
                            element.filter = filter;

                            _this.checkedNamesLabel.splice(_this.checkedNamesLabel.indexOf(element), 1);
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
                                }else if(key == 'product_case' && filter == 'product_case'){
                                    _this.filterData.product_case.push(value);
                                }else if(key == 'product_material_case' && filter == 'product_material_case'){
                                    _this.filterData.product_material_case.push(value);
                                }
                            }

                            _this.products.filter(function(item) {
                                if(filter == 'product_condition'){
                                    if(item.show == true){
                                        _this.filterData.product_condition.indexOf(parseInt(item.product_condition)) != -1
                                            ? item.show = true
                                            : item.show = false;
                                    }
                                }else if(filter == 'product_sex'){
                                    if(item.show == true){
                                        _this.filterData.product_sex.indexOf(parseInt(item.product_sex)) != -1 ? item.show = true : item.show = false;
                                    }
                                }else if(filter == 'product_type'){
                                    if(item.show == true){
                                        _this.filterData.product_type.indexOf(parseInt(item.product_type)) != -1 ? item.show = true : item.show = false;
                                    }
                                }else if(filter == 'product_brand'){
                                    if(item.show == true){
                                        _this.filterData.product_brand.indexOf(parseInt(item.product_brand)) != -1 ? item.show = true : item.show = false;
                                    }
                                }else if(filter == 'product_case'){
                                    if(item.show == true){
                                        _this.filterData.product_case.indexOf(parseInt(item.product_case)) != -1 ? item.show = true : item.show = false;
                                    }
                                }else if(filter == 'product_material_case'){
                                    if(item.show == true){
                                        _this.filterData.product_material_case.indexOf(parseInt(item.product_material_case)) != -1 ? item.show = true : item.show = false;
                                    }
                                }
                            });

                            element.id = value;
                            element.title = title;
                            element.filter = filter;

                            _this.checkedNamesLabel.push(element);
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
                },
                sortBy: function sortBy(val){
                    this.products.sort(function (item, item2) {
                        if(val == 1)
                        {
                            if(parseInt(item2.price) > parseInt(item.price)) return -1;
                            if(parseInt(item2.price) < parseInt(item.price)) return 1;
                            return 0;
                        }else if(val == 2){
                            if(parseInt(item.price) > parseInt(item2.price)) return -1;
                            if(parseInt(item.price) < parseInt(item2.price)) return 1;
                            return 0;
                        }else{
                            if(item.created_at < item2.created_at) return -1;
                            if(item.created_at > item2.created_at) return 1;
                            return 0;
                        }
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
                            $('.money').unmask();
                            $('.money').mask('000 000 000 000 000 000', {reverse: true});
                        }
                    });
                    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ));
                    $( "#amount2" ).val($( "#slider-range" ).slider( "values", 1 ));

                } );

                $(document).ready(function(){
                    $('.money').mask('000 000 000 000 000 000', {reverse: true});

                    $('.sort-by select').on('change', function(){
                        _this.sortBy(this.value);
                    });
                });

                var windowHeight = $('html').height(),
                    pagesMenu = $('.catalog-sidebar');

                pagesMenu.css('min-height', windowHeight);
            }
        })
    </script>
@endsection