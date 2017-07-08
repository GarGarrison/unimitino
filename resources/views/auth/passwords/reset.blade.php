@extends('layouts.app')

@section('right_col')
<div class="card-wrapper">
    <div class="card-head">Сброс пароля</div>
    <div class="card-body">
        <div class="row">
            <form class="col s12" role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="row">
                    <div class="col s2">
                        <div class="form-title">E-mail:</div>
                    </div>
                    <div class="form-field col s10">
                        <input name="email" type="email" value="{{ $email or old('email') }}">
                        @if ($errors->has('email'))
                            <span class="error-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col s2">
                        <div class="form-title">Пароль:</div>
                    </div>
                    <div class="col s10">
                        <input name="password" type="password">
                        @if ($errors->has('password'))
                            <span class="error-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="col s2">
                        <div class="form-title">Пароль еще раз:</div>
                    </div>
                    <div class="col s10">
                        <input name="password_confirmation" type="password">
                        @if ($errors->has('password_confirmation'))
                            <span class="error-block">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                </div>
                @if ($errors->has('common_error'))
                    <span class="error-block right">{{ $errors->first('common_error') }}</span>
                @endif
                <div class="row">
                    <div class="col s12">
                        <button type="submit" class="btn btn-primary right">Сбросить пароль</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection