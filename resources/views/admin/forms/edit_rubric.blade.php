<h5>Изменение рубрики</h5>
<form id="edit_rubric_form" class="col s12" method="POST" action="{{ url('/admin/edit_rubric') }}">
    {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s6 l3">
            <select name="rubric-to-change">
                <option value="" selected>Не выбрано</option>
                @foreach ($rubrics as $rubric)
                   <option value="{{ $rubric->id }}">{{ $rubric->name }}</option>
                @endforeach
            </select>
            <label>Выберете рубрику</label>
        </div>
        <div class="col s6 l3">
            <a class="btn-floating delete-entity" href="{{ url('/admin/del_rubric') }}"><i class="material-icons">delete</i></a>
        </div>
    </div>
    <div class="on-change-input">
        <div class="row">
            <div class="input-field col s6 l3">
                    <input name="name" type="text" class="validate">
                    <label for="name">Новое название рубрики</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button type="submit" class="btn">Сохранить
                </button>
            </div>
        </div>
    </div>
</form>