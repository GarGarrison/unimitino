<div class="row">
    <input type="hidden" name="user_type" value="jur">
    <div class="col s3">
        <div class="form-title">Компания:</div>
    </div>
    <div class="form-field col s9">
        <input name="company" type="text" value="{{ !Auth::guest() ? Auth::user()->company : '' }}">
        @if ($errors->has('company'))
            <span class="error-block">{{ $errors->first('company') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">E-mail:</div>
    </div>
    <div class="form-field col s9">
        <input name="email" type="text" value="{{ !Auth::guest() ? Auth::user()->email : '' }}">
        @if ($errors->has('email'))
            <span class="error-block">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">Регион/Город:</div>
    </div>
    <div class="form-field col s9">
        <input name="city" type="text" value="{{ !Auth::guest() ? Auth::user()->city : '' }}">
        @if ($errors->has('city'))
            <span class="error-block">{{ $errors->first('city') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">Адрес:</div>
    </div>
    <div class="form-field col s9">
        <input name="address" type="text" value="{{ !Auth::guest() ? Auth::user()->address : '' }}">
        @if ($errors->has('address'))
            <span class="error-block">{{ $errors->first('address') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">Индекс:</div>
    </div>
    <div class="form-field col s9">
        <input name="post_index" type="text" value="{{ !Auth::guest() ? Auth::user()->post_index : '' }}">
        @if ($errors->has('post_index'))
            <span class="error-block">{{ $errors->first('post_index') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">Телефон:</div>
    </div>
    <div class="form-field col s9">
        <input name="phone" type="text" value="{{ !Auth::guest() ? Auth::user()->phone : '' }}">
        @if ($errors->has('phone'))
            <span class="error-block">{{ $errors->first('phone') }}</span>
        @endif
    </div>
     <div class="col s3">
        <div class="form-title">ИНН/КПП:</div>
    </div>
    <div class="form-field col s9">
        <input name="inn" type="text" value="{{ !Auth::guest() ? Auth::user()->inn : '' }}">
        @if ($errors->has('inn'))
            <span class="error-block">{{ $errors->first('inn') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">Банк:</div>
    </div>
    <div class="form-field col s9">
        <input name="bank_name" type="text" value="{{ !Auth::guest() ? Auth::user()->bank_name : '' }}">
        @if ($errors->has('bank_name'))
            <span class="error-block">{{ $errors->first('bank_name') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">Расчетный счет:</div>
    </div>
    <div class="form-field col s9">
        <input name="bank_account" type="text" value="{{ !Auth::guest() ? Auth::user()->bank_account : '' }}">
        @if ($errors->has('bank_account'))
            <span class="error-block">{{ $errors->first('bank_account') }}</span>
        @endif
    </div>
</div>