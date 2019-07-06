@extends('admin.a')

@section('admin_right_col')
<h5>Изменение рубрики</h5>
<form id="edit_rubric_form" class="col s12" method="POST">
    {{ csrf_field() }}
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
    <div class="on-change-input">
        <div class="row">
            <div class="col s3">
                <div class="form-title">Новое название рубрики:</div>
            </div>
            <div class="col s9">
                <input name="name" type="text">
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