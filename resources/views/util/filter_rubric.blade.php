@if (count($goods) > 0)
    <p>Найдено <b>{{ count($goods) }}</b> товаров:</p>
    @foreach($goods as $g)
        @include("util.goods_pattern")
    @endforeach
@else
    <p>Ничего не найдено.</p>
@endif