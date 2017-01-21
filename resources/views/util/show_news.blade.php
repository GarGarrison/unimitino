@extends('layouts.app')

@section('right_col')
    <div class="card-wrapper">
        <div class="card-head">Новости</div>
        <div class="card-body">
            @foreach($news as $new)
            <div class="card-item">
                <div class="card-item-body">
                    <div class="card-item-desc">
                        <b>{{ $new->news_date }}</b>
                        <span class="vert-stick">|</span>
                        <b>{{ $new->title }}</b>
                        <p>{{ $new->annotation }}</p>
                    </div>
                    <div class="card-more-info"><p>{{ $new->text }}</p></div>
                </div>
                <div class="card-item-bottom">
                    <i class="material-icons" title="Подробнее">arrow_drop_down</i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection