@extends('layouts.app')

@section('right_col')
<div class="card-wrapper">
    <div class="card-head">Корзина <i class="material-icons head-icon">shopping_cart</i></div>
    <div class="card-body">
        @if ($goods)
            @foreach($goods as $g)
            <div class="card-item cart-item">
                <div class="card-item-body">
                    <div class="card-item-desc">{{ $g->typonominal }} <span class="vert-stick">|</span>{{ $g->producer }}
                    <i class="material-icons delete-from-cart" title="Удалить из карзины" data-id="{{ $g->cid }}">close</i>
                    </div>
                    <div class="cart-item-info">
                        <span class="good-card-lable">Цена:</span><div class="cart-price">{{ $g->price }} {{ $money }}</div>
                        <div class="cart-count-wrapper">
                            <span class="good-card-lable">Кол-во:</span><input type="text" class="goods-count cart-goods-count" data-max-count="{{ $g->onlinecount }}" value="{{ $g->count }}" data-id="{{ $g->cid }}">
                        </div>                                    
                    </div>
                </div>
                <div class="card-item-bottom cart-bottom">
                    Сумма: <span class="sum-price"></span>
                </div>
            </div>
            @endforeach
            <div class="card-item cart-item">
                <div class="card-item-body">
                    <div class="cart-result-sum">
                        Итого: <span class="cart-result-sum-price"><span class="cart-result-sum-price-value"></span> {{ $money }}</span>
                        <i class="material-icons right cart-result-resum" title="Пересчитать корзину">autorenew</i>
                    </div>
                </div>
            </div>
            <a href="/checkout"><button class="btn right">Оформить заказ</button></a>
        @else
            <h5>Ваша корзина пока пуста</h5>
        @endif
    </div>
</div>
@endsection