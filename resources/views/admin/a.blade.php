@extends('layouts.app')

@section('left_col')
<div class="card-wrapper">
    <div class="card-head">
        Меню
        <img class="right" src="/img/catalog-icon.png" style="margin-top: 0.3em;" />
    </div>
    <div class="card-body admin-menu">
        <ul>
            <a id="rubric" class="menu-item" href="{{url('/admin/rubric')}}"><li>Рубрики</li></a>
            <a id="news" class="menu-item" href="{{url('/admin/news')}}"><li>Новости</li></a>
            <a id="users" class="menu-item" href="{{url('/admin/users')}}"><li>Пользователи</li></a>
            <a id="goods" class="menu-item" href="{{url('/admin/goods')}}"><li>Товары</li></a>
            <a id="params" class="menu-item" href="{{url('/admin/params')}}"><li>Доп. параметры</li></a>
        </ul>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
@endsection