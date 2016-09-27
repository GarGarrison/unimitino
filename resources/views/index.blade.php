@extends('layouts.main')

@if (isset($important))
    @section('important')
        <div class="card">
            <div class="card-content">
                <div class="important">
                    <span class="card-title">{{$important->title}}</span>
                    <p>{{$important->annotation}}</p>
                </div>
            </div>
        </div>
    @endsection
@endif

@section('main')
@if (count($errors) > 0)
    errors
    <ul>
        @foreach($errors->all() as $error)       
            <li>->{{ $error }}</li>
        @endforeach
    </ul>
@endif
<nav class="white">
    <div class="nav-wrapper">
        <form class="search_form" action="{{ url('/search') }}">
            <div class="input-field">
                {{ csrf_field() }}
                <input id="search" type="search" name="req" required>
                <label for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
            </div>
        </form>
    </div>
</nav>
<!-- <div class="row"> -->
    <div class="content">
        <div class="col s12">
            <h5>Новые поступления</h5>
            @foreach($new_goods as $ng)
            <div class="col s12 m3">
                <div class="new-goods-item">
                    <div class="new-goods-item-title">{{ $ng->name }}</div>
                    <div>{{ $ng->description }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col s12">
            <h5>Новости</h5>
            @foreach($actual_news as $news)
            <div class="news-item">
                <div class="title">
                    {{ $news->title }}
                </div>
                <div class="annotation">
                    {{ $news->annotation }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
<!-- </div> -->
@endsection