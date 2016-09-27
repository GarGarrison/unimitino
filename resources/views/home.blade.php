@extends('layouts.main')

@section('menu')
<a class="menu-item active" href="{{ url('/home') }}">Аккаунт</a>
<a class="menu-item" href="#">Мои заказы</a>
@endsection
@section('main')
<div class="col s12 container">
    @section('home_content')
        <h5>Ваши данные</h5>
        <form class="col s12" method="post" action="{{ url('/home') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s6 l3">
                    <input name="name" type="text" class="validate" value="{{ Auth::user()->name }}">
                    <label for="name">Имя</label>
                    @if ($errors->has('name'))
                        <span class="error-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="input-field col s6 l3">
                    <input name="city" type="text" class="validate" value="{{ Auth::user()->city }}">
                    <label for="city">Город</label>
                    @if ($errors->has('city'))
                        <span class="error-block">{{ $errors->first('city') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 l3">
                    <input name="company" type="text" class="validate" value="{{ Auth::user()->company }}">
                    <label for="company">Компания</label>
                </div>
                <div class="input-field col s6 l3">
                    <input name="inn" type="text" class="validate" value="{{ Auth::user()->inn }}">
                    <label for="inn">ИНН</label>
                    @if ($errors->has('inn'))
                        <span class="error-block">{{ $errors->first('inn') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 l3">
                    <input name="address" type="text" class="validate" value="{{ Auth::user()->address }}">
                    <label for="address">Адрес</label>
                </div>
                <div class="input-field col s6 l3">
                    <input name="post_index" type="text" class="validate" value="{{ Auth::user()->post_index }}">
                    <label for="post_index">Почтовый индекс</label>
                    @if ($errors->has('post_index'))
                        <span class="error-block">{{ $errors->first('post_index') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 l3">
                    <input name="phone" type="text" class="validate" value="{{ Auth::user()->phone }}">
                    <label for="phone">Телефон</label>
                    @if ($errors->has('phone'))
                        <span class="error-block">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="input-field col s6 l3">
                    <input name="email" type="text" class="validate" value="{{ Auth::user()->email }}">
                    <label for="email">Электронная почта</label>
                    @if ($errors->has('email'))
                        <span class="error-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 l3">
                    <input name="bank_account" type="text" class="validate" value="{{ Auth::user()->bank_account }}">
                    <label for="bank_account">Расчетный счет</label>
                    @if ($errors->has('bank_account'))
                        <span class="error-block">{{ $errors->first('bank_account') }}</span>
                    @endif
                </div>
                <div class="input-field col s6 l3">
                    <input name="bank_name" type="text" class="validate" value="{{ Auth::user()->bank_name }}">
                    <label for="bank_name">Банк</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 l3">
                    <input name="password" type="password" class="validate">
                    <label for="password">Пароль</label>
                    @if ($errors->has('password'))
                        <span class="error-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="input-field col s6 l3">
                    <input name="password_confirmation" type="password" class="validate">
                    <label for="password_confirmation">Подтверждение пароля</label>
                    @if ($errors->has('password_confirmation'))
                        <span class="error-block">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s6 l3">
                    <button type="submit" class="btn">
                        Сохранить
                    </button>
                </div>
            </div>
        </form>
    @show
</div>
@endsection
