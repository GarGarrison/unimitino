@extends('layouts.main')

@section('important')
@endsection

@section('menu')
<a id="rubric" class="menu-item" href="{{url('/admin/rubric')}}">Рубрики</a>
<a id="news" class="menu-item" href="{{url('/admin/news')}}">Новости</a>
<a id="3" class="menu-item" href="#">Пользователи</a>
<a id="4" class="menu-item" href="#">Товары</a>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
@endsection