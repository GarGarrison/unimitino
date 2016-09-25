<h5>Добавление рубрики</h5>
<form id="add_rubric_form" class="col s12" method="POST" action="{{ url('/admin/add_rubric') }}">
    {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s6 l3">
            <input name="name" type="text" value="{{ old('name') }}">
            <label for="name">Название рубрики</label>
            @if ($errors->has('name'))
                <span class="error-block">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="input-field col s6 l3">
            <select name="parent">
                <option value="" selected>Не выбрано</option>
                @foreach ($rubrics as $rubric)
                   <option value="{{ $rubric->id }}">{{ $rubric->name }}</option>
                @endforeach
            </select>
            <label>Выберете родительскую рубрику</label>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <button type="submit" class="btn">Добавить
            </button>
        </div>
    </div>
</form>