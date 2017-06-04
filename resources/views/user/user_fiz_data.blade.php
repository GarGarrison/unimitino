<div class="row">
    <input type="hidden" name="user_type" value="fiz">
    <div class="col s3">
        <div class="form-title">ФИО:</div>
    </div>
    <div class="col s9">
        <input name="name" type="text" value="{{ Auth::user()->name ?? '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">E-mail:</div>
    </div>
    <div class="col s9">
        <input name="email" type="text" value="{{ Auth::user()->email ?? '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">Регион/Город:</div>
    </div>
    <div class="col s9">
        <input name="city" type="text" value="{{ Auth::user()->city ?? '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">Адрес:</div>
    </div>
    <div class="col s9">
        <input name="address" type="text" value="{{ Auth::user()->address ?? '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">Индекс:</div>
    </div>
    <div class="col s9">
        <input name="post_index" type="text" value="{{ Auth::user()->post_index ?? '' }}">
    </div>
    <div class="col s3">
        <div class="form-title">Телефон:</div>
    </div>
    <div class="col s9">
        <input name="phone" type="text" value="{{ Auth::user()->phone ?? '' }}">
    </div>
    <input type="hidden" name="company" value="">
    <input type="hidden" name="bank_account" value="">
    <input type="hidden" name="bank_name" value="">
    <input type="hidden" name="inn" value="">
</div>