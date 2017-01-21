@extends('layouts.app')

@section('right_col')
    <div class="card-wrapper">
        <div class="card-head">Результаты поиска</div>
        <div class="card-body">
            <p>по запросу <b>"{{ $req }}":</b></p>
            @if (count($result)>0)
                @foreach($result as $g)
                    @include("util.goods_pattern")
                @endforeach
            @else
                <p>Ничего не найдено</p>
            @endif
        </div>
    </div>
@endsection