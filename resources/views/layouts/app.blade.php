<!DOCTYPE html>
<html>
<head>
    <title>Uniserv</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/material_helper.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/production.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('lib/jqgoodies/jqgoodies.css')}}">
</head>
<body>
    {{ var_dump($errors->messages())}}
    <div class="container">
        <img src="/img/triangle_big_cut.png" class="triangle_big_cut">
        <img src="/img/triangle_big.png" class="triangle_big">
    </div>
    <ul class="side-nav blue" id="collapse_menu">
        <a href="/cart"><li>Корзина ( <span class="cart-length-simple">{{ $cart_length }}</span> )</li></a>
        <a href="/home"><li>Личный кабинет</li></a>
        <!-- <a href="/news"><li>Новости</li></a> -->
        <a href="/new_goods"><li>Новые поступления</li></a>
        <a href="/kak-kupit"><li>Как купить?</li></a>
        <a href="#"><li>Доставка</li></a>
        <a href="/contacts"><li>Контакты</li></a>
        <a href="/about"><li>О компании</li></a>
    </ul>
    <nav class="blue top-nav">
        <div class="nav-wrapper container">
            <a href="/"><img class="logo" src="/img/logo.png" /></a>
            <ul class="hide-on-large-only right">
                <li><a href="#" data-activates="collapse_menu" class="button-collapse"><i class="material-icons collapse_icon">menu</i></a></li>
            </ul>
            <ul class="hide-on-med-and-down right top-menu">
                <li><a href="/cart" class="cart" data-url="cart"><i class="material-icons" title="Корзина">shopping_cart</i><span class="cart-length">{{ $cart_length }}</span></a></li>
                <li><a href="/home" data-url="home"><i class="material-icons" title="Войти в личный кабинет">account_box</i></a></li>
                <li class="more-tip-trigger protected-for-click" data-tip="main-menu-tip"><a class="protected-for-click"><i class="material-icons protected-for-click" title="Дополнительное меню">more_vert</i></a></li>
                @if (Auth::user())
                <li><a href="/logout"><i class="material-icons" title="Выйти из аккаунта">exit_to_app</i></a></li>
                @endif
            </ul>
        </div>
    </nav>
    <div class="more-tip main-menu-tip">
        <svg height="20" width="0">
          <path
          style="fill:white;stroke:#195894;stroke-width:1.2;fill-rule:nonzero;" />
        </svg>
        <div class="more-tip-body">
            <ul>
                <!-- <a href="/news"><li class="more-tip-body-li">Новости</li></a> -->
                <a href="/new-goods"><li class="more-tip-body-li">Новые поступления</li></a>
                <a href="/kak-kupit"><li class="more-tip-body-li">Как купить?</li></a>
                <a href="#"><li class="more-tip-body-li">Доставка</li></a>
                <a href="/contacts"><li class="more-tip-body-li">Контакты</li></a>
                <a href="/about"><li class="more-tip-body-li">О компании</li></a>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row content">
            <div class="top-address-phone">
                <div class="top-address">
                    125464, г.Москва, Пятницкое шоссе, д.18<br /> 
                    ТК Митинский Радиорынок, пав. №604<br />
                    Работаем: вторник - суббота 9:00-18:00
                </div>
                <div class="top-phone">
                    +7 (495) 544-58-80
                </div>
            </div>
            <div class="black-stripe"></div>
            <form class="search-bar" action="{{ url('/search') }}" method="post">
                {{ csrf_field() }}
                <div class="form-field">
                    <i class="material-icons search-icon">search</i>
                    <input id="search" type="text" name="req" class="white">
                </div>
                <button type="submit" class="btn right">Поиск</button>
            </form>
            <div class="col s12 l4 left-col">
                @section('left_col')
                    @if (isset($important))
                    <div class="card-wrapper">
                        <div class="card-body important">
                            <div>
                                <i class="material-icons tiny right">close</i>
                            </div>
                            <b>{{$important->title}}</b>
                            <p>{{$important->annotation}}</p>

                        </div>
                    </div>
                    @endif
                    <div class="card-wrapper">
                        <div class="card-head">
                            Каталог
                            <img class="right" src="/img/catalog-icon.png" />
                        </div>
                        <div class="card-body menu">
                            @if ( isset($rubrics_dict) && isset($rubric_relations))
                                <?php $curlevel = 1; ?>
                                @foreach ($rubric_relations as $rubrel)
                                    <?php
                                        $arr = explode('#', $rubrel->relation);
                                        $level = count($arr);
                                        $rubric = $rubrics_dict[$arr[$level - 1]];
                                    ?>
                                    @if ($level > $curlevel)
                                        <?php $curlevel = $level; ?>
                                        <ul>
                                    @elseif ( $level < $curlevel)
                                        <?php
                                            echo str_repeat("</ul>", $curlevel-$level); 
                                            $curlevel = $level;
                                        ?>
                                    @endif
                                    @if ($rubrel->has_child)
                                        <li class="menu-item menu-header">
                                            {{ $rubric["name"] }}
                                            <i class='material-icons'>chevron_right</i>
                                        </li>
                                    @else
                                        <a href="{{url('/rubric/'.$rubrel->rid.'/'.$rubric['url']) }}">
                                            <li class="menu-item">{{ $rubric["name"] }}</li>
                                        </a>
                                    @endif
                                    
                                @endforeach
                            @endif
                        </div>
                    </div>
                @show
            </div>
            <div class="col s12 l8 right-col">
                @section('right_col')
                @show
            </div>
        </div>
        <div class="row">
            @section("wide_content")
            @show
        </div>
    </div>
    <footer class="row page-footer blue">
        <div class="container">
            <div class="footer_social">
                <img src="/img/footer_vk.png">
                <img src="/img/footer_fb.png">
                <img src="/img/footer_tw.png">
                <img src="/img/footer_gl.png">
            </div>
            <div class="footer_copyright">
                © 2016 «УНИСЕРВИС» ВСЕ ПРАВА СОХРАНЕНЫ | РАЗРАБОТКА САЙТА — СТУДИЯ «FRONTMAN»
            </div>
            <div class="footer_logo">
                <img src="/img/footer_logo.png">
            </div>
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
    <script type="text/javascript" src="{{asset('lib/jqgoodies/jqgoodies.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/common.js')}}"></script>
    @section('js')
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
    @show
</body>
    @if (session("MSG"))
    <script type="text/javascript">
        alert("{{ session('MSG') }}");
    </script>
    @endif
</html>