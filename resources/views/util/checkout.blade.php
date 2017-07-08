@extends('layouts.app')

@section('right_col')
<div class="card-wrapper">
    <div class="card-head">Оформление заказа <i class="material-icons head-icon">shopping_cart</i></div>
    <div class="card-body">
        <div class="row">
            @include("user.radioblock")
        </div>
        <form class="toggle-form" data-target="fiz" data-group="user_type">
            @include("user.user_fiz_data")
        </form>
        <form class="toggle-form" data-target="jur" data-group="user_type">
            @include("user.user_jur_data")
        </form>
    </div>
</div>
<div class="card-wrapper">
    <div class="card-head">Оплата</div>
    <div class="card-body">
        <div class="col s12 radio-block">
            <div class="radio-item fullstring" data-val="paykeeper" data-group="payment">
                <svg class="radio-svg">
                    <circle class="radio-border" cx=11 cy=11 r=10 stroke="#ccc" fill="none" />
                    <circle class="radio-heart" cx=11 cy=11 r=3 stroke="none" fill="#195894" />
                </svg>
                <span>Банковская карта</span>
            </div>
            <div class="radio-item fullstring" data-val="account" data-group="payment">
                <svg class="radio-svg">
                    <circle cx=11 cy=11 r=10 stroke="#ccc" fill="none" />
                    <circle class="radio-heart" cx=11 cy=11 r=3 stroke="none" fill="#195894" />
                </svg>
                <span>Выставить счет на оплату</span>
            </div>
            <div class="radio-item fullstring" data-val="qiwi" data-group="payment">
                <svg class="radio-svg">
                    <circle cx=11 cy=11 r=10 stroke="#ccc" fill="none" />
                    <circle class="radio-heart" cx=11 cy=11 r=3 stroke="none" fill="#195894" />
                </svg>
                <span>Выставить счет в QIWI</span>
            </div>
            @if ($errors->has('payment'))
                <span class="error-block">{{ $errors->first('payment') }}</span>
            @endif
        </div>
        <div class="toggle-form" data-target="qiwi" data-group="payment">
            <div class="col s2"><div class="form-title">Телефон:</div></div>
            <div class="col s8"><input type="text" name="qiwi_phone"></div>
            @if ($errors->has('qiwi_phone'))
                <span class="error-block">{{ $errors->first('qiwi_phone') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="card-wrapper">
    <div class="card-head">Доставка</div>
    <form class="card-body delivery-form">
        <div class="form-title">Выберите способ доставки:</div>
        <select id="delivery-type" class="custom-select">
            <option>Обычная почта</option>
            <option>Транспортная компания</option>
            <option>Экспресс-почта</option>
            <option>Авиапочта</option>
            <option>Самовывоз из павильона 604 на Митинском Радиорынке</option>
        </select>
        <select id="transport-company" class="custom-select">
            <option>Грузовозофф</option>
            <option>Автотрейдинг</option>
            <option>ЗАО "ФинАвто"</option>
            <option>Скиф-Карго</option>
            <option>Реил Континент</option>
            <option>Цитотранс</option>
            <option>ООО "Центральное Агентство Перевозок"</option>
            <option>Доставкин</option>
            <option>Желдорэкспедиция</option>
            <option>Транзит-РТК</option>
            <option>ТранзитАвто</option>
            <option>Байкал Сервис</option>
            <option>ООО "Юниленд"</option>
            <option>ТК Энергия</option>
            <option>Экспресс-Авто</option>
            <option>ЗАО «ТРЭЙН»</option>
        </select>
        <div class="form-title">Комментарий к заказу:</div>
        <textarea name="comment"></textarea>
        <input type="hidden" name="money" value="{{ $money }}">
        <button id="order" class="btn right">Завершить заказ</button>
    </form>
</div>
@endsection