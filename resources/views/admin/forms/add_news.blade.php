<h5>Добавление новости</h5>
<?php
    $action = "";
    $class = "";
    $important = "";
    $submit = "Добавить";
    $formid = "add_news_form";
    if ($current_news) {
        $action = url('/admin/edit_news');
        $class = "active";
        $submit = "Сохранить";
        $formid = "edit_news_form";
        if ($current_news->important) $important = "checked='checked'";
    }
    else $action = url('/admin/add_news');
?> 
<form id="{{ $formid }}" class="col s12" method="POST" action="{{ $action }}">
    {{ csrf_field() }}
    @if ($current_news)
    <input type="hidden" name="id" value="{{$current_news->id}}">
    @endif
    <div class="row">
        <div class="input-field col s12 m12 l6">
            <input name="title" type="text" value="{{ $current_news['title'] or '' }}">
            <label for="title" class="{{$class}}">Заголовок новости</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12 m12 l6">
            <textarea name="annotation" class="materialize-textarea">{{ $current_news['annotation'] or '' }}</textarea>
            <label for="annotation" class="{{$class}}">Аннотация</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12 m12 l6">
            <textarea name="text" class="materialize-textarea">{{ $current_news->text or '' }}</textarea>
            <label for="text" class="{{$class}}">Текст</label>
        </div>
    </div>
    <div class="row">
        <div class="col s4">
            <input type="text" class="datepicker" name="news_date" data-value="{{ $current_news['news_date'] or '' }}">
            <label for="news_date">Дата новости</label>
        </div>
        <div class="col s4">
            <input type="text" class="datepicker" name="public_date" data-value="{{ $current_news['public_date'] or '' }}">
            <label for="public_date">Дата публикации</label>
        </div>
        <div class="col s4">
            <input type="text" class="datepicker" name="unpublic_date" data-value="{{ $current_news['unpublic_date'] or '' }}">
            <label for="unpublic_date">Дата отмены</label>
        </div>
    </div>
    <div class="row">
        <div class="col s4">
            <input type="checkbox" name="important" id="important" {{ $important }}/>
            <label for="important">Важная</label>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <button type="submit" class="btn">{{ $submit }}
            </button>
        </div>
    </div>
</form>