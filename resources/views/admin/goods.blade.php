@extends('admin/a')

@section('main')
<div class="col s12">
    <h4>Редактирование товара</h4>
</div>
<div class="col s12">
    <nav class="white">
        <div class="nav-wrapper">
            <form class="search_form" action="{{ url('/search') }}">
                <div class="input-field">
                    {{ csrf_field() }}
                    <input type="hidden" name="target" value="edit">
                    <input id="search" type="search" name="req" required>
                    <label for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                </div>
            </form>
        </div>
    </nav>
</div>
<div class="col s12 content"></div>
@endsection