@extends('admin/a')

@section('right_col')
<div class="card-wrapper">
    <div class="card-body">
        <ul class="tabs">
            <li class="tab col s6"><a href="{{ url('/admin/show_add_rubric') }}">Добавить рубрику</a></li>
            <li class="tab col s6"><a href="{{ url('/admin/show_edit_rubric') }}">Изменить рубрику</a></li>
        </ul>
        <div class="tab-container"></div>
    </div>
</div>
@endsection