@extends('layouts.app')

@section('right_col')
    <div class="card-wrapper">
        <div class="card-head">Новые поступления</div>
        <div class="card-body">
            @foreach($new_goods as $g)
                @include("util.goods_pattern")
            @endforeach
            <a href="/new_goods"><div class="card-bottom"><i class="material-icons medium" title="Все поступления">more_horiz</i></div></a>
        </div>
    </div>
    <div class="card-wrapper">
        <div class="card-head">Новости</div>
        <div class="card-body">
            @foreach($actual_news as $news)
            <div class="card-item">
                <div class="card-item-body">
                    <div class="card-item-desc">
                        <b>{{ $news->news_date }}</b>
                        <span class="vert-stick">|</span>
                        <b>{{ $news->title }}</b>
                        <p>{{ $news->annotation }}</p>
                        <div class="card-more-info"><p>{{ $news->text }}</p></div>
                    </div>
                </div>
                <div class="card-item-bottom">
                    <i class="material-icons" title="Подробнее">arrow_drop_down</i>
                </div>
            </div>
            @endforeach
            <a href="/news"><div class="card-bottom"><i class="material-icons medium" title="Все новости">more_horiz</i></div></a>
        </div>
    </div>
@endsection