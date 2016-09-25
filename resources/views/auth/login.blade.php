@extends('layouts.app')

@section('content')
<h5>Вход</h5>
<form class="col s12" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s6 l3">
            <input name="email" type="text" class="validate" value="{{ old('email') }}">
            <label for="email">Электронная почта</label>
            @if ($errors->has('email'))
                <span class="error-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="input-field col s6 l3">
            <input name="password" type="password" class="validate">
            <label for="password">Пароль</label>
            @if ($errors->has('password'))
                <span class="error-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
    </div>


    <!-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> -->
    <div class="row">
        <div class="col s12">
            <input type="checkbox" id="remember" name="remember" />
            <label for="remember">Запомнить меня</label>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <button type="submit" class="btn">Войти
            </button>
            <a href="{{ url('/password/reset') }}">Забыли пароль?</a>
        </div>
    </div>
</form>
@endsection
