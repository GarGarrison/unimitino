@extends('layouts.app')

@section('right_col')
<div class="card-wrapper">
    <div class="card-head">Вход<i class="material-icons head-icon">account_box</i></div>
    <div class="card-body">
        <form method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col s2">
                    <div class="form-title">E-mail:</div>
                </div>
                <div class="form-field col s10">
                    <input name="email" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col s2">
                    <div class="form-title">Пароль:</div>
                </div>
                <div class="form-field col s10">
                    <input name="password" type="password">
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <a href="{{url('/social_login/vkontakte')}}"><img src="/img/logo_vk.png"></a>
                    <a href="{{url('/social_login/facebook')}}"><img src="/img/logo_fb.png"></a>
                    <a href="{{url('/social_login/google')}}"><img src="/img/logo_goog.png"></a>  
                </div>
                <div class="col s6">
                    <button type="submit" class="btn right">Войти</button>
                    <a href="{{ url('/register') }}" class="right">Регистрация</a>
                    <!-- <a href="{{ url('/password/reset') }}">Забыли пароль?</a> -->
                </div>
            </div>
        </form>      
    </div>
</div>
@endsection
