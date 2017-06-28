@extends('layouts.app')

@section('right_col')
<div class="card-wrapper">
    <div class="card-head">Регистрация</div>
    <div class="card-body">
        <div class="row">
            @include("user.radioblock")
        </div>
        <form method="post" action="{{ url('/register') }}" class="toggle-form" data-target="fiz" data-group="user_type">
            {{ csrf_field() }}
            @include("user.user_fiz_data")
            <div class="row">
                <div class="col s3">
                    <div class="form-title">Пароль:</div>
                </div>
                <div class="col s9">
                    <input name="password" type="password">
                    @if ($errors->has('password'))
                        <span class="error-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="col s3">
                    <div class="form-title">Пароль еще раз:</div>
                </div>
                <div class="col s9">
                    <input name="password_confirmation" type="password">
                </div>
                <div class="col s12">
                    <button type="submit" class="btn right">
                        Регистрация
                    </button>
                </div>
            </div>
        </form>
        <form method="post" action="{{ url('/register') }}" class="toggle-form" data-target="jur" data-group="user_type">
            {{ csrf_field() }}
            @include("user.user_jur_data")
            <div class="row">
                <div class="col s3">
                    <div class="form-title">Пароль:</div>
                </div>
                <div class="col s9">
                    <input name="password" type="password">
                    @if ($errors->has('password'))
                        <span class="error-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="col s3">
                    <div class="form-title">Пароль еще раз:</div>
                </div>
                <div class="col s9">
                    <input name="password_confirmation" type="password">
                </div>
                <div class="col s12">
                    <button type="submit" class="btn right">
                        Регистрация
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection