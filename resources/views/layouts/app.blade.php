<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($seo['title']) ? $seo['title'] : 'Выкуп, продажа, залог элитных швейцарских часов | Часовой Ломбард «Перспектива»,'}}</title>
    <meta name="description" content="{{ isset($seo['description']) ? $seo['description'] : 'Первый официальный часовой ломбард в Казахстане. Мы предоставляем услуги скупки, продажи и залога элитных швейцарских часов уже более 10 лет. Произведем оценку и выплату в течение 15 минут.'}}">
    <meta name="keywords" content="{{ isset($seo['keywords']) ? $seo['keywords']  : 'Залог элитных часов, залог швейцарских часов, часы под залог, часовой ломбард, скупка элитных часов,' }}">
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    @yield('styles')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div class="wrap">
        @include('parts.header')

        @yield('content')

        @include('parts.footer')
    </div>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    @yield('scripts')
</body>
</html>
