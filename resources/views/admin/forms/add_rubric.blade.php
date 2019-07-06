@extends('admin.a')

@section('admin_right_col')
<h5>Добавление рубрики</h5>
<form id="add_rubric_form" class="col s12" method="POST" action="{{ url('/admin/add_rubric') }}">
    {{ csrf_field() }}
    <div class="row">
        <div class="col s3">
            <div class="form-title">Название рубрики:</div>
        </div>
        <div class="col s9">
            <input name="name" type="text" value="{{ old('name') }}">
            @if ($errors->has('name'))
                <span class="error-block">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col s3">
            <div class="form-title">Родительская рубрика:</div>
        </div>
        <div class="col s9">
            <select class="custom-select" name="parent">
                <option value="0" selected>Не выбрано</option>
                @foreach ($rubrics as $rubric)
                   <option value="{{ $rubric->id }}">{{ $rubric->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col offset-s3 s9">
            <button type="submit" class="btn">Добавить</button>
        </div>
    </div>
</form>
@endsection