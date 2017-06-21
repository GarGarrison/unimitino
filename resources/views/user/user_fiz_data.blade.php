<div class="row">
    <input type="hidden" name="user_type" value="fiz">
    <div class="col s3">
        <div class="form-title">ФИО:</div>
    </div>
    <div class="col s9">
        <input name="name" type="text" value="{{ !Auth::guest() ? Auth::user()->name : '' }}">
        @if ($errors->has('name'))
            <span class="error-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">E-mail:</div>
    </div>
    <div class="col s9">
        <input name="email" type="text" value="{{ !Auth::guest() ? Auth::user()->email : '' }}">
        @if ($errors->has('email'))
            <span class="error-block">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">Регион/Город:</div>
    </div>
    <div class="col s9">
        <input name="city" type="text" value="{{ !Auth::guest() ? Auth::user()->city : '' }}">
        @if ($errors->has('city'))
            <span class="error-block">{{ $errors->first('city') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">Адрес:</div>
    </div>
    <div class="col s9">
        <input name="address" type="text" value="{{ !Auth::guest() ? Auth::user()->address : '' }}">
        @if ($errors->has('address'))
            <span class="error-block">{{ $errors->first('address') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">Индекс:</div>
    </div>
    <div class="col s9">
        <input name="post_index" type="text" value="{{ !Auth::guest() ? Auth::user()->post_index : '' }}">
        @if ($errors->has('post_index'))
            <span class="error-block">{{ $errors->first('post_index') }}</span>
        @endif
    </div>
    <div class="col s3">
        <div class="form-title">Телефон:</div>
    </div>
    <div class="col s9">
        <input name="phone" type="text" value="{{ !Auth::guest() ? Auth::user()->phone : '' }}">
        @if ($errors->has('phone'))
            <span class="error-block">{{ $errors->first('phone') }}</span>
        @endif
    </div>
    <input type="hidden" name="company" value="">
    <input type="hidden" name="bank_account" value="">
    <input type="hidden" name="bank_name" value="">
    <input type="hidden" name="inn" value="">
</div>