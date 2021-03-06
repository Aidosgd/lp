<header>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    {{--<a class="navbar-brand" href="/">Перспектива <span>часовой ломбард</span></a>--}}
                    <a class="navbar-brand" href="/"><img src="/images/logo.png" style="width: 90%" alt=""></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="/catalog/clocks">Каталог</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Услуги</a>
                            <ul class="dropdown-menu">
                                <li><a href="/pages/pledge"><img src="/images/4c884d50b8.png" style="width: 35px; padding-right: 5px;">Залог</a></li>
                                <li><a href="/pages/purchase"><img src="/images/6c037e15af.png" style="width: 35px; padding-right: 5px;">Скупка</a></li>
                                <li><a href="/pages/valuation"><img src="/images/7f267b3163.png" style="width: 35px; padding-right: 5px;">Оценка</a></li>
                            </ul>
                        </li>
                        <li><a href="/pages/about-lombard">О ломбарде</a></li>
                        <li><a href="/contacts">Контакты</a></li>
                    </ul>
                    <form class="navbar-form navbar-left" action="/search" method="get">
                        <div class="form-group">
                            <input type="text" name="product" class="form-control" placeholder="Поиск">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" data-toggle="modal" data-target="#myModal">+7 (700) 090-90-67  <i class="fa fa-whatsapp" style="padding: 0 5px;"></i><i class="fa fa-telegram"></i><span>Перезвоните мне <i class="fa fa-phone"></i></span></a></li>
                        <!--<li class="dropdown">-->
                        <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>-->
                        <!--<ul class="dropdown-menu">-->
                        <!--<li><a href="#">Action</a></li>-->
                        <!--<li><a href="#">Another action</a></li>-->
                        <!--<li><a href="#">Something else here</a></li>-->
                        <!--<li role="separator" class="divider"></li>-->
                        <!--<li><a href="#">Separated link</a></li>-->
                        <!--</ul>-->
                        <!--</li>-->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        @if(session()->has('message'))
            <div class="alert alert-success">
                <h1>{{ session()->get('message') }}</h1>
            </div>
        @endif
    </div>
</header>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Заказать звонок</h4>
            </div>
            <div class="modal-body">
                <form action="/callbacks" method="post">
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" name="name" class="form-control" placeholder="Имя">
                    </div>

                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" name="phone" class="form-control" placeholder="Телефон">
                    </div>

                    <button type="submit" class="btn btn-default">Отправить</button>
                </form>
            </div>
        </div>

    </div>
</div>