@extends('layouts.app')

@section('menu')
<a class="menu-item active" href="{{ url('/home') }}">Аккаунт</a>
<a class="menu-item" href="{{ url('/orders') }}">Мои заказы</a>
@endsection

@section('right_col')
    @section('home_content')
        <div class="more-tip user-menu-tip">
            <svg height="20" width="0">
              <path style="fill:white;stroke:#195894;stroke-width:1.2;" />
            </svg>
            <div class="more-tip-body">
                <ul>
                    <a href="/home/profile"><li class="more-tip-body-li">Профиль</li></a>
                    <a href="/home/track"><li class="more-tip-body-li">Отследить заказ</li></a>
                    <a href="/home/history"><li class="more-tip-body-li">История</li></a>
                </ul>
            </div>
        </div>
        <div class="card-wrapper">
            <div class="card-head">
                Личный кабинет
                <i class="material-icons head-icon cabin_icon more-tip-trigger protected-for-click" data-tip="user-menu-tip">more_vert</i>
            </div>
            <div class="card-body user-menu-container">
                @include("user.profile")
            </div>
        </div>
    @show
@endsection
