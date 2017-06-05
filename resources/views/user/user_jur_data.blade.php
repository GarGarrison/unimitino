<div class="row">
    <input type="hidden" name="user_type" value="jur">
    <div class="col s3">
        <div class="form-title">Компания:</div>
    </div>
    <div class="form-field col s9">
        <input name="company" type="text" value="{{ Auth::user()->company ?: '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">E-mail:</div>
    </div>
    <div class="form-field col s9">
        <input name="email" type="text" value="{{ Auth::user()->email ?: '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">Регион/Город:</div>
    </div>
    <div class="form-field col s9">
        <input name="city" type="text" value="{{ Auth::user()->city ?: '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">Адрес:</div>
    </div>
    <div class="form-field col s9">
        <input name="address" type="text" value="{{ Auth::user()->address ?: '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">Индекс:</div>
    </div>
    <div class="form-field col s9">
        <input name="post_index" type="text" value="{{ Auth::user()->post_index ?: '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">Телефон:</div>
    </div>
    <div class="form-field col s9">
        <input name="phone" type="text" value="{{ Auth::user()->phone ?: '' }}">
    </div>
     <div class="col s3">
        <div class="form-title">ИНН/КПП:</div>
    </div>
    <div class="form-field col s9">
        <input name="inn" type="text" value="{{ Auth::user()->inn ?: '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">Банк:</div>
    </div>
    <div class="form-field col s9">
        <input name="bank_name" type="text" value="{{ Auth::user()->bank_name ?: '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">Расчетный счет:</div>
    </div>
    <div class="form-field col s9">
        <input name="bank_account" type="text" value="{{ Auth::user()->bank_account ?: '' }}">
    </div>
</div>