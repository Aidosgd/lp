@extends('layouts.app')

@section('content')
    <div class="container-fluid pages">
        <div class="row">
            <div class="col-md-3">
                <ul class="pages-menu">
                    @foreach($main_menu as $menu)
                        <li>
                            <a href="/{{ $menu->link }}">{{ $menu->node->title }}</a>
                            <ul class="children">
                                @foreach($menu->children as $item)
                                    <li><a href="/{{ $item->link }}">{{ $item->node->title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-9">
                <h1>{{ $post->node->title }}</h1>

                <div class="content">
                    {!! $post->node->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var windowHeight = $(window).height(),
            pagesMenu = $('.pages-menu');

        pagesMenu.css('height', windowHeight - 170);
    </script>
@endsection