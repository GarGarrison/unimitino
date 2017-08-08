<div class="row">
    <div class="col s3">
        <div class="form-title">Заголовок новости:</div>
    </div>
    <div class="col s9">
        <input name="title" type="text" value="{{ $current_news['title'] or '' }}">
        @if ($errors->has('title'))
            <span class="error-block">{{ $errors->first('title') }}</span>
        @endif
    </div>
</div>
<div class="row">
    <div class="col s3">
        <div class="form-title">Аннотация:</div>
    </div>
    <div class="col s9">
        <textarea name="annotation">{{ $current_news['annotation'] or '' }}</textarea>
        @if ($errors->has('annotation'))
            <span class="error-block">{{ $errors->first('annotation') }}</span>
        @endif
    </div>
</div>
<div class="row">
    <div class="col s3">
        <div class="form-title">Текст:</div>
    </div>
    <div class="col s9">
        <textarea name="text">{{ $current_news['text'] or '' }}</textarea>
        @if ($errors->has('text'))
            <span class="error-block">{{ $errors->first('text') }}</span>
        @endif
    </div>
</div>
<div class="row">
    <div class="col s3">
        <div class="form-title">Дата новости:</div>
    </div>
    <div class="col s6">
        <input type="text" class="datepicker" name="news_date" data-value="{{ $current_news['news_date'] or '' }}">
        @if ($errors->has('news_date'))
            <span class="error-block">{{ $errors->first('news_date') }}</span>
        @endif
    </div>
</div>
<div class="row">
    <div class="col s3">
        <div class="form-title">Дата публикации:</div>
    </div>
    <div class="col s6">
        <input type="text" class="datepicker" name="public_date" data-value="{{ $current_news['public_date'] or '' }}">
        @if ($errors->has('public_date'))
            <span class="error-block">{{ $errors->first('public_date') }}</span>
        @endif
    </div>
</div>
<div class="row">
    <div class="col s3">
        <div class="form-title">Дата отмены:</div>
    </div>
    <div class="col s6">
        <input type="text" class="datepicker" name="unpublic_date" data-value="{{ $current_news['unpublic_date'] or '' }}">
        @if ($errors->has('unpublic_date'))
            <span class="error-block">{{ $errors->first('unpublic_date') }}</span>
        @endif
    </div>
</div>