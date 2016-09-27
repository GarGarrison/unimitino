@extends('layouts.app')

@section('content')
<h5>Регистрация</h5>
<form class="col s12" method="post" action="{{ url('/register') }}">
    {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s12 m5 l3">
            <input name="name" type="text" class="validate">
            <label for="name">Имя</label>
            @if ($errors->has('name'))
                <span class="error-block">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="input-field col s12 m5 l3">
            <input name="email" type="text" class="validate" value="{{ old('email')}}">
            <label for="email">Электронная почта</label>
            @if ($errors->has('email'))
                <span class="error-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
     </div>
     <div class="row">   
        <div class="input-field col s12 m5 l3">
            <input name="password" type="password" class="validate">
            <label for="password">Пароль</label>
            @if ($errors->has('password'))
                <span class="error-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="input-field col s12 m5 l3">
            <input name="password_confirmation" type="password" class="validate">
            <label for="password_confirmation">Подтверждение пароля</label>
            @if ($errors->has('password_confirmation'))
                <span class="error-block">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col s12 m5 l3">
            <button type="submit" class="btn">
                Регистрация
            </button>
        </div>
    </div>
</form>
@endsection