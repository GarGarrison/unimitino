@extends('layouts.app')

@section('right_col')
<div class="card-wrapper">
    <div class="card-head">Корзина <i class="material-icons head-icon">shopping_cart</i></div>
    <div class="card-body">
        @if ($goods)
            @foreach($goods as $g)
            <div class="card-item cart-item">
                <div class="card-item-body">
                    <div class="card-item-desc">{{ $g->goodsname }} <span class="vert-stick">|</span>{{ $g->producer }}
                    <i class="material-icons delete-from-cart" title="Удалить из карзины" data-id="{{ $g->cid }}">close</i>
                    </div>
                    <div class="card-item-info">
                        <span class="good-card-lable">Цена:</span><div class="cart-price">{{ $g->price_retail_rub }}</div>
                        <div class="cart-count-wrapper">
                            <span class="good-card-lable">Кол-во:</span><input type="text" class="goods-count" value="{{ $g->count }}">
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
                        Итого: <span class="cart-result-sum-price"></span>
                        <i class="material-icons right cart-result-resum" title="Пересчитать корзину">autorenew</i>
                    </div>
                </div>
            </div>
            <button class="btn right order-next-step">Оформить заказ</button>
        @else
            <h5>Ваша корзина пока пуста</h5>
        @endif
    </div>
</div>
<div class="card-wrapper order-step pay">
    <div class="card-head">Оплата</div>
    <div class="card-body">
        <div class="">
            <button class="btn left order-next-step">Далее</button>
        </div>
    </div>
</div>
<div class="card-wrapper order-step user_data">
    <div class="card-head">Ваши данные</div>
    <div class="card-body">
        <form method="post" action="{{ url('/make_order') }}">
            {{ csrf_field() }}
            <?php
                $user = Auth::user();
            ?>
            <div class="row">
                <div class="input-field col s6">
                    <input name="name" type="text"  value="{{$user->name or ''}}">
                    <label for="name">Имя</label>
                    @if ($errors->has('name'))
                        <span class="error-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="input-field col s6">
                    <input name="city" type="text"  value="{{$user->city or ''}}">
                    <label for="city">Город</label>
                    @if ($errors->has('city'))
                        <span class="error-block">{{ $errors->first('city') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input name="company" type="text"  value="{{$user->company or ''}}">
                    <label for="company">Компания</label>
                </div>
                <div class="input-field col s6">
                    <input name="inn" type="text"  value="{{$user->inn or ''}}">
                    <label for="inn">ИНН</label>
                    @if ($errors->has('inn'))
                        <span class="error-block">{{ $errors->first('inn') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input name="address" type="text"  value="{{$user->address or ''}}">
                    <label for="address">Адрес</label>
                </div>
                <div class="input-field col s6">
                    <input name="post_index" type="text"  value="{{$user->post_index or ''}}">
                    <label for="post_index">Почтовый индекс</label>
                    @if ($errors->has('post_index'))
                        <span class="error-block">{{ $errors->first('post_index') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input name="phone" type="text"  value="{{$user->phone or ''}}">
                    <label for="phone">Телефон</label>
                    @if ($errors->has('phone'))
                        <span class="error-block">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="input-field col s6">
                    <input name="email" type="text"  value="{{$user->email or ''}}">
                    <label for="email">Электронная почта</label>
                    @if ($errors->has('email'))
                        <span class="error-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input name="bank_account" type="text"  value="{{$user->bank_account or ''}}">
                    <label for="bank_account">Расчетный счет</label>
                    @if ($errors->has('bank_account'))
                        <span class="error-block">{{ $errors->first('bank_account') }}</span>
                    @endif
                </div>
                <div class="input-field col s6">
                    <input name="bank_name" type="text"  value="{{$user->bank_name or ''}}">
                    <label for="bank_name">Банк</label>
                </div>
            </div>
            <button type="submit" class="btn left do-order">Заказать</button>
        </form>
    </div>
</div>
@endsection