@extends('layouts.app')

@section('right_col')
<div class="card-wrapper">
    <div class="card-head">Оплата заказа<i class="material-icons head-icon">shopping_cart</i></div>
    <div class="card-body">
        <iframe src="http://demo.paykeeper.ru/form/" style="width:100%; height: 500px; border: 1px solid #ccc;"></iframe>
    </div>
</div>
@endsection