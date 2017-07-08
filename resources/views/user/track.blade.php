<script>
    DoSetInterval();
</script>
@if ($orders)
    <h5>Отследить заказ</h5>
    @foreach($orders as $o)
        @include("user.order_status_pattern")
    @endforeach
@else
    <h5>У вас пока нет заказов</h5>
@endif