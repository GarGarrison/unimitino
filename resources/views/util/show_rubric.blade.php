@extends('layouts.app')
@if ($params)
    @section('left_col')
    <div class="card-wrapper">
        <div class="card-head drop-head">
            Параметры
            <img class="right" src="/img/params-icon.png" />
        </div>
        <div class="card-body">
        @foreach($params as $p)
            <div class="param-item">
                <b>{{ $p->name }}:</b>
                @if ($p->type=="integer")
                <input type="text" class="param-box param-box-integer" data-colname = "{{ $p->column_name }}" data-operation=">=">
                <span class="param-stick">-</span>
                <input type="text" class="param-box param-box-integer" data-colname = "{{ $p->column_name }}" data-operation="<=">
                @else
                <input type="text" class="param-box param-box-varchar" data-colname = "{{ $p->column_name }}" data-operation="LIKE">
                @endif
            </div>
        @endforeach
            <button class="btn btn-param" data-rid="{{ $rid }}">Выбрать</button>
        </div>
    </div>
    @parent
    @endsection
@endif

@section('right_col')
    <div class="card-wrapper">
        <div class="card-head">
            <div class="bread">
            @foreach ($bread as $b)
                @if ($b != end($bread))
                <span class="blue-text">{{ $rubrics[$b]['name'] }}</span><span class="bread-quote">»</span>
                @else
                    <b>{{ $rubrics[$b]['name'] }}</b>
                @endif
            @endforeach
            </div>
        </div>
        <div class="card-body main-content">
            @foreach($goods as $g)
                @include("util.goods_pattern")
            @endforeach
        </div>
    </div>
@endsection