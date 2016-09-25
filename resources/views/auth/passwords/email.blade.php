@extends('layouts.app')

<!-- Main Content -->
@section('content')
<h5>Сброс пароля</h5>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form class="col s12" role="form" method="POST" action="{{ url('/password/email') }}">
    {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s12">
            <input name="email" type="email" class="validate" value="{{ old('email') }}">
            <label for="email">Электронная почта</label>
            @if ($errors->has('email'))
                <span class="error-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <button type="submit" class="btn btn-primary">Send Password Reset Link
            </button>
        </div>
    </div>
</form>
@endsection