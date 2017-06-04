@extends('layouts.app')

@section('right_col')
<div class="card-wrapper">
    <div class="card-head">Оформление заказа <i class="material-icons head-icon">shopping_cart</i></div>
    <div class="card-body">
        <div class="row">
            @include("user.radioblock")
        </div>
        <div class="toggle-form" data-target="fiz" data-group="user_type">
            {{ csrf_field() }}
            @include("user.user_fiz_data")
        </div>
        <div class="toggle-form" data-target="jur" data-group="user_type">
            {{ csrf_field() }}
            @include("user.user_jur_data")
        </div>
    </div>
</div>
<div class="card-wrapper">
    <div class="card-head">Оплата</div>
    <div class="card-body">
        <div class="col s12 radio-block" name="delivery_type">
            <div class="radio-item fullstring" data-val="paykeeper" data-group="payment">
                <svg class="radio-svg">
                    <circle class="radio-border" cx=11 cy=11 r=10 stroke="#ccc" fill="none" />
                    <circle class="radio-heart" cx=11 cy=11 r=3 stroke="none" fill="#195894" />
                </svg>
                <span>Банковская карта</span>
            </div>
            <div class="radio-item fullstring" data-val="" data-group="payment">
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
        </div>
        <div class="toggle-form" data-target="qiwi" data-group="payment">
            <div class="col s2"><div class="form-title">Телефон:</div></div>
            <div class="col s8"><input type="text" name="phone"></div>
        </div>
        <div class="toggle-form" data-target="paykeeper" data-group="payment">
            <iframe src="http://demo.paykeeper.ru/form/" style="width:100%; height: 500px; border: 1px solid #ccc;"></iframe>
        </div>
    </div>
</div>
<div class="card-wrapper">
    <div class="card-head">Доставка</div>
    <div class="card-body">
        <div class="form-title">Выберите способ доставки:</div>
        <select class="custom-select">
            <option>Транспортная компания</option>
            <option>Обычная почта</option>
            <option>Экспресс-почта</option>
            <option>Авиапочта</option>
            <option>Самовывоз из павильона 604 на Митинском Радиорынке</option>
        </select>
        <select class="custom-select">
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
        <div class="form-title">Уточните адрес доставки:</div>
        <input type="text" name="clarift-address">
        <div class="form-title">Комментарий к заказу:</div>
        <textarea></textarea>
        <button class="btn right">Завершить заказ</button>
    </div>
</div>
@endsection