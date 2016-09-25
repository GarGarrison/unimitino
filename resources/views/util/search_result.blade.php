<h5>Результаты поиска</h5>
для {{ $req }}
@if (count($result)>0)
    <table class="striped" href="{{ url('/add_to_cart') }}">
        <thead>
            <tr>
                <th data-field="name">Название</th>
                <th data-field="description">Описание</th>
                <th data-field="count">Количество</th>
                <th data-filed="price" colspan="2">Цена</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result as $r)
                <tr name="{{ $r->id }}">
                    <td>{{ $r->name }}</td>
                    <td>{{ $r->description }}</td>
                    <td>{{ $r->count }}</td>
                    <td>{{ $r->price }}</td>
                    <td><i class="material-icons to-cart">shopping_cart</i></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div>Ничего не найдено</div>
@endif