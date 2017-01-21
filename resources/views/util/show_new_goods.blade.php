@extends('layouts.app')

@section('right_col')
    <div class="card-wrapper">
        <div class="card-head">Новые поступления</div>
        <div class="card-body">
            @foreach($new_goods as $g)
                @include("util.goods_pattern")
            @endforeach
        </div>
    </div>
@endsection