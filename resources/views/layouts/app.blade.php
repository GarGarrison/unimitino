<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unimitino</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/material_helper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/picker_helper.css')}}">
    <script type="text/javascript">
        var JS_APP_URL = {!! json_encode(url('/')) !!};
    </script>
</head>
<body>
    <header>
        <nav class="blue">
            <div class="nav-wrapper">
                <a class="brand-logo left" href="{{ url('/') }}">Unimitino</a>
                <ul class="right">
                    @if (Auth::user() && Auth::user()->isUser() || Auth::guest())
                        <li><a href="{{ url('/show_cart') }}">Корзина (<span class="cart-count">{{ $cart_length }}</span>)</a></li>
                    @endif
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Вход</a></li>
                        <li><a href="{{ url('/register') }}">Регистрация</a></li>
                    @else
                        <li><a href="{{ url('/home') }}">Личный кабинет</a></li>
                        <li><a href="{{ url('/logout') }}">Выйти</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>
    @if (Auth::user())
        <div class="row">
            <div class="right">Здравствуйте, {{ Auth::user()->name }}!</div>
        </div>
    @endif
    <div class="container">
        <div class="row">
                @yield("content")
        </div>
    </div>
    <footer class="page-footer blue">
        <div class="container">
            <div class="row"></div>
        </div>
    </footer>

    <!-- JavaScripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
    <script type="text/javascript" src="{{asset('js/ru_RU.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $("meta[name='csrf-token']").attr('content') }
        });
    </script>
    <script type="text/javascript" src="{{asset('js/helpers.js')}}"></script>
    @section('js')
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
    @show
</body>
</html>
