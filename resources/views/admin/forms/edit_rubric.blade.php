@extends('admin.a')

@section('admin_right_col')
<h5>Изменение рубрики</h5>
<form id="edit_rubric_form" class="col s12" method="POST">
    {{ csrf_field() }}
    <select id="relations_dict">
            <option value="0" selected></option>
        @foreach ($relations_by_id as $rid => $rel)
            <option value="{{ $rid }}">{{ $rel["parent"] }}</option>
        @endforeach
    </select>
    <div class="row">
        <div class="col s3">
            <div class="form-title">Выберете рубрику:</div>
        </div>
        <div class="col s9">
            <select class="custom-select" name="rubric-to-change">
                <option value="" selected>Не выбрано</option>
                @foreach ($rubrics as $rubric)
                   <option value="{{ $rubric->id }}">{{ $rubric->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
            <div class="col s3">
                <p id="rubric_id"></p>
            </div>
    </div>
    <div class="on-change-input">
        <div class="row">
            <div class="col s3">
                <div class="form-title">Новое название рубрики:</div>
            </div>
            <div class="col s9">
                <input name="name" type="text">
                @if ($errors->has('name'))
                    <span class="error-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col s3">
                <div class="form-title">Изменить родительскую рубрику:</div>
            </div>
            <div class="col s9">
                <select class="custom-select" name="parent">
                    <option value="0" selected>Не выбрано</option>
                    @foreach ($rubrics as $rubric)
                        <option value="{{ $rubric->id }}">{{ $rubric->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('parent'))
                    <span class="error-block">{{ $errors->first('parent') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn">Сохранить</button>
                <a data-href="/admin/del_rubric/" class="delete-entity">Удалить</a>
                <p style="font-size: 0.8rem">Если у рубрики есть потомки, то при удалении они так же будут удалены</p>
            </div>
        </div>
    </div>
</form>
@endsection