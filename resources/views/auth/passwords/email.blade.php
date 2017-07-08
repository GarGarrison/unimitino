@extends('layouts.app')

@section('right_col')
<div class="card-wrapper">
    <div class="card-head">Сброс пароля</div>
    <div class="card-body">
        <div class="row">
            <form class="col s12" role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col s2">
                        <div class="form-title">E-mail:</div>
                    </div>
                    <div class="form-field col s10">
                        <input name="email" type="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="error-block">{{ $errors->first('email') }}</span>
                        @endif
                        @if (session('status'))
                            <span class="error-block"><div class="green-text">{{ session('status') }}</div></span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <button type="submit" class="btn btn-primary right">Отправить ссылку</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection