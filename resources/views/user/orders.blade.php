@extends('layouts.main')

@section('menu')
<a class="menu-item" href="{{ url('/home') }}">Аккаунт</a>
<a class="menu-item active" href="{{ url('/orders') }}">Мои заказы</a>
@endsection
@section('main')
    <h4>Ваши заказы</h4>
    @if($orders)
    <table class="striped order-table">
        <thead>
            <tr>
                <th data-field="name">Название</th>
                <th data-filed="price">Цена</th>
                <th data-filed="count">Кол-во</th>
                <th data-filed="status">Статус</th>
                <th data-filed="date">Время заказа</th>
            </tr>
        </thead>
        <tbody>
        @foreach( $orders as $o)
            <tr>
                <td>{{ $o->gid }}</td>
                <td>{{ $o->price }}</td>
                <td>{{ $o->count }}</td>
                <td>{{ $o->status }}</td>
                <td>{{ $o->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        нет заказов
    @endif
@endsection