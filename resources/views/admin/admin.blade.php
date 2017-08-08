@extends('admin.a')

@section('admin_right_col')
        @if (count($orders))
            <h5>Заказы</h5>
            <table class="order-table">
                    <th>Товар</th>
                    <th>Пользователь</th>
                    <th>Статус</th>
                    <th>Дата создания</th>
                    <form method="GET">
                    <tr class="filter-string">
                        <td><input type="text" class="filter-users" name="gid" value="{{ app('request')->input('gid') }}"></td>
                        <td><input type="text" class="filter-users" name="uid" value="{{ app('request')->input('uid') }}"></td>
                        <td><input type="text" class="filter-users" name="status" value="{{ app('request')->input('status') }}"></td>
                        <td><input type="text" class="filter-users" name="created_at" value="{{ app('request')->input('created_at') }}"><input type="submit" style="display:none"/></td>
                    </tr>
                    </form>
                    @foreach($orders as $o)
                        <tr>
                            <td>{{ $o->gid }}</td>
                            <td>{{ $o->uid }}</td>
                            <td>{{ $o->status}}</td>
                            <td>{{ $o->created_at }}</td>
                        </tr>
                    @endforeach
            </table>
            {{ $orders->links() }}
        @else
            <h5>Не было ни одного заказа</h5>
        @endif
    </div>
</div>
@endsection