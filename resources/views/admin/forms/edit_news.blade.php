<h5>Изменение новостей</h5>
@if ($news)
    {{ csrf_field() }}
    @foreach($news as $n)
        <div class="card truncate edit-news-item" href="{{ url('/admin/show_add_news', [$n->id]) }}"><div class="edit-news-title">{{ $n->title }}</div>
            <a class="btn-floating delete-entity" href="{{ url('/admin/del_news') }}" name="{{ $n->id }}"><i class="material-icons">delete</i></a>
        </div>
    @endforeach
@endif