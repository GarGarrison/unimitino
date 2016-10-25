@extends('layouts.main')

@section('menu')
<a class="menu-item active" href="{{ url('/home') }}">Аккаунт</a>
<a class="menu-item" href="{{ url('/orders') }}">Мои заказы</a>
@endsection
@section('home_content')
Here
@ensection