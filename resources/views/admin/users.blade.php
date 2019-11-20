@extends('admin.a')

@section('admin_right_col')
<h5>Пользователи</h5>
<div class="user-actions">
    <div class="row">
        <div class="col s12">
            <b>Изменение параметров пользователя: </b><span data-relation="name"></span>
        </div>
    </div>
    <form data-href = "/admin/save_user/" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col s4">
                <select class="browser-default"  data-relation="price-level" name="price_level">
                    <option value="">Новый уровень скидок</option>
                    <option value="price_retail_usd">price_retail_usd</option>
                    <option value="price_retail_rub">price_retail_rub</option>
                    <option value="price_minitrade_usd">price_minitrade_usd</option>
                    <option value="price_minitrade_rub">price_minitrade_rub</option>
                    <option value="price_trade_rub">price_trade_rub</option>
                    <option value="price_trade_usd">price_trade_usd</option>
                </select>
            </div>
            <div class="col s4">
                <select class="browser-default"  data-relation="money" name="money">
                    <option value="">Новая валюта</option>
                    <option value="руб">руб</option>
                    <option value="$">$</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn">Сохранить</button>
                <a class="delete-entity" data-href = "/admin/del_user/">Удалить</a>
            </div>
        </div>
    </form>
</div>
<table class="order-table">
        <th>UID</th>
        <th>Имя</th>
        <th>Адрес</th>
        <th>Телефон</th>
        <th>Валюта</th>
        <th>Скидка</th>
        <form method="GET">
        <tr class="filter-string">
            <td><input type="text" class="filter-users" name="id" value="{{ app('request')->input('id') }}"></td>
            <td><input type="text" class="filter-users" name="name" value="{{ app('request')->input('name') }}"></td>
            <td><input type="text" class="filter-users" name="address" value="{{ app('request')->input('address') }}"></td>
            <td><input type="text" class="filter-users" name="phone" value="{{ app('request')->input('phone') }}"></td>
            <td><input type="text" class="filter-users" name="money" value="{{ app('request')->input('money') }}"></td>
            <td><input type="text" class="filter-users" name="price_level" value="{{ app('request')->input('price_level') }}">
                <input type="submit" style="display:none"/>
            </td>
        </tr>
        </form>
        @foreach($users as $u)
            <tr data-id = "{{ $u->id }}">
                <td data-relation="id">{{ $u->id }}</td>
                <td data-relation="name">
                    @if(!empty($u->company)){{ $u->company}}
                    @else {{ $u->name }}
                    @endif
                </td>
                <td>{{ $u->address }}</td>
                <td>{{ $u->phone}}</td>
                <td data-relation="money">{{ $u->money }}</td>
                <td data-relation="price-level">{{ $u->price_level }}</td>
            </tr>
        @endforeach
</table>
{{ $users->links() }}
@endsection

