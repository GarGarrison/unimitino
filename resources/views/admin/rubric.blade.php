@extends('admin/a')

@section('main')
<div class="col s12">
    <div class="card">
        <ul class="tabs">
            <li class="tab col s6"><a href="{{ url('/admin/show_add_rubric') }}">Добавить рубрику</a></li>
            <li class="tab col s6"><a href="{{ url('/admin/show_edit_rubric') }}">Изменить рубрику</a></li>
        </ul>
    </div>
</div>
<div class="col s12 tab-container">
    
</div>
@endsection