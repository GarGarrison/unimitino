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
                <b data-colname = "$p->col_name">{{ $p->name }}:</b>
                @if ($p->type=="integer")
                <div class="param-box param-box-integer" contenteditable="true"></div>
                <span class="param-stick">-</span>
                <div class="param-box param-box-integer" contenteditable="true"></div>
                @else
                <div class="param-box param-box-varchar" contenteditable="true"></div>
                @endif
            </div>
        @endforeach
            <button class="btn btn-large btn-param">Выбрать</button>
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
            <span class="bread-quote">»</span> {{ $rubrics[$b]['name'] }}
            @endforeach
            </div>
        </div>
        <div class="card-body">
            @foreach($goods as $g)
                @include("util.goods_pattern")
            @endforeach
        </div>
    </div>
@endsection