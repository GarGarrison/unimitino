@extends('admin.a')

@section('admin_right_col')
    <h5>Изменение новостей</h5>
    @if ($news)
            @foreach($news as $current_news)
            <div class="truncate edit-news-item">{{ $current_news->news_date }} <span class="vert-stick">|</span> {{ $current_news->title }}</div>
            <form class="edit-news-item-more" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $current_news->id }}">
                @include("admin.forms.news_base")
                <div class="row">
                    <div class="col s12">
                        <button type="submit" class="btn">Сохранить</button>
                        <a href="{{ '/admin/del_news/'.$current_news->id }}" class="delete-entity">Удалить</a>
                    </div>
                </div>
            </form>
            @endforeach
    @endif
@endsection