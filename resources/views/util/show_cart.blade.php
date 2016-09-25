@extends('layouts.app')

@section('content')
<h5>Ваша корзина</h5>
@if ($goods)
    <table class="striped order-table">
    {{ csrf_field() }}
        <thead>
            <tr>
                <th data-field="name">Название</th>
                <th data-field="description">Описание</th>
                <th data-filed="price">Цена</th>
                <th data-filed="count" colspan="2">Кол-во</th>
            </tr>
        </thead>
        <tbody>
            @foreach($goods as $g)
                <tr name="{{ $g->id }}">
                    <td>{{ $g->name }}</td>
                    <td>{{ $g->description }}</td>
                    <td>{{ $g->price }}</td>
                    <td>
                        <div contenteditable="true" name="count">5</div>
                    <td><a class="red-text delete-from-cart" href="{{ url('/delete_from_cart') }}"><i class="material-icons">delete</i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn left do-order">Оформить заказ</button>
@else
пуста
@endif
@endsection