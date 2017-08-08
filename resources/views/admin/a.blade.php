@extends('layouts.app')

@section('left_col')
<div class="card-wrapper">
    <div class="card-head">
        Меню
        <img class="right" src="/img/catalog-icon.png" style="margin-top: 0.3em;" />
    </div>
    <div class="card-body menu">
        <ul>
            <a id="admin" class="menu-item" href="{{url('/admin')}}"><li>Заказы</li></a>
            <li class="menu-item menu-header">Рубрики</li>
            <ul>
                <a id="add_rubric" class="menu-item" href="{{url('/admin/add_rubric')}}"><li>Добавить рубрику</li></a>
                <a id="edit_rubric" class="menu-item" href="{{url('/admin/edit_rubric')}}"><li>Изменить рубрику</li></a>
            </ul>
            <li class="menu-item menu-header">Новости</li>
            <ul>
                <a id="news" class="menu-item" href="{{url('/admin/add_news')}}"><li>Добавить новость</li></a>
                <a id="news" class="menu-item" href="{{url('/admin/edit_news')}}"><li>Изменить новость</li></a>
            </ul>
            <a id="users" class="menu-item" href="{{url('/admin/users')}}"><li>Пользователи</li></a>
        </ul>
    </div>
</div>
@endsection

@section('right_col')
<div class="card-wrapper">
        <div class="card-head">
            Администрирование
        </div>
        <div class="card-body">
            @yield('admin_right_col')
            <div class="tab-container"></div>
        </div>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
@endsection