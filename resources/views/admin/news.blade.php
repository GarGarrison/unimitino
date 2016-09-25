@extends('admin/a')

@section('main')
<div class="col s12">
    <div class="card">
        <ul class="tabs">
            <li class="tab col s6"><a href="{{ url('/admin/show_add_news') }}">Добавить новость</a></li>
            <li class="tab col s6"><a href="{{ url('/admin/show_edit_news') }}">Изменить новость</a></li>
        </ul>
    </div>
</div>
<div class="col s12">
    <div class="row tab-container"></div>
</div>
@endsection