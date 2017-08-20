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
                                <input @click="checkFilter($event)" :data-value="index" data-filter="product_condition" v-bind:id="'condition' + index" type="checkbox" name="check" v-model="checkedNames" v-bind:value="condition.title">
                                <label v-bind:for="'condition' + index">@{{ condition.title }}</label>
                            </div>
                        </div>
                    </div>
                    <h4>Бренд</h4>
                    <div class="modal-filter">
                        <button class="btn btn-default" data-toggle="modal" data-target="#myModal">Выбрать бренд</button>
                    </div>
                    <div v-if="productSex.length">
                        <h4>Кому</h4>
                        <div class="checkbox-filter radio-checkbox">
                            <div v-for="(sex, index) in productSex" v-cloak>
                                <input @click="checkFilter($event)" :data-value="index" data-filter="product_sex" v-bind:id="'sex' + index" type="checkbox" name="check" v-model="checkedNames" v-bind:value="sex.title">
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
                                    <input @click="checkFilter($event)" :data-value="index" data-filter="product_type" v-bind:id="'type' + index" type="checkbox" name="check" v-model="checkedNames" v-bind:value="type.title">
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
                            <select name="" id="">
                                <option value="">По новизне</option>
                                <option value="">По новизне2</option>
                            </select>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="main-products">
                        <div class="row">
                            <div v-for="product in products" v-cloak class="col-md-3">
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
                        <div class="row hidden">

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
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: {{ $minPrice }},
                max: {{ $maxPrice }},
                values: [ {{ $minPrice }}, {{ $maxPrice }} ],
                slide: function( event, ui ) {
                    $( "#amount" ).val(ui.values[ 0 ] );
                    $( "#amount2" ).val(ui.values[ 1 ] );
                }
            });
            $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ));
            $( "#amount2" ).val($( "#slider-range" ).slider( "values", 1 ));
        } );

        Vue.filter('priceFormat', function(value){
            return value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ")
        });

        var app = new Vue({
            el: '#app',
            data: {
                products: {!! $products !!},
                productCondition: {!! $productCondition !!},
                productSex: {!! isset($productSex) ? $productSex : '""' !!},
                productType: {!! isset($productType) ? $productType : '""' !!},
                checkedNames: [],
                filterData: []
            },

            methods: {
                clearCheckedNames: function clearCheckedNames(){
                    this.checkedNames = []
                },
                closeLabel: function closeLabel(name){
                    var found = this.checkedNames.indexOf(name);

                    while (found !== -1) {
                        this.checkedNames.splice(found, 1);
                        found = this.checkedNames.indexOf(name);
                    }
                },
                checkFilter: function checkFilter(event){
                    var input = event.target,
                        value = $(input).data('value'),
                        filter = $(input).data('filter'),
                        data = [value, filter],
                        _this = this;

                    Array.prototype.indexOfForArrays = function(search)
                    {
                        var searchJson = JSON.stringify(search); // "[3,566,23,79]"
                        var arrJson = this.map(JSON.stringify); // ["[2,6,89,45]", "[3,566,23,79]", "[434,677,9,23]"]

                        return arrJson.indexOf(searchJson);
                    };

                    Array.prototype.remove = function(from, to) {
                        var rest = this.slice((to || from) + 1 || this.length);
                        this.length = from < 0 ? this.length + from : from;
                        return this.push.apply(this, rest);
                    };

                    var result = this.filterData.indexOfForArrays(data);

                    if(result == -1){
                        setTimeout(function(){
                            _this.filterData.push([value, filter]);
                        _this.sentRequest();
                        }, 100);
                    }else{
                        setTimeout(function(){
                            _this.filterData.remove(result);
                        _this.sentRequest();
                        }, 100);
                    }

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

                }
            },

            created: function created() {
            }
        })
    </script>
@endsection