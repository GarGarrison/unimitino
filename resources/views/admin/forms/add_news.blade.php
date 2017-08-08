@extends('admin.a')

@section('admin_right_col')
    <h5>Добавление новости</h5>
    <form id="add_news_form" class="col s12" method="POST" action="{{ url('/admin/add_news') }}">
        {{ csrf_field() }}
        @if (isset($current_news))
        <input type="hidden" name="id" value="{{ $current_news->id }}">
        @endif
        @include("admin.forms.news_base")
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn">Сохранить
                </button>
            </div>
        </div>
    </form>
@endsection