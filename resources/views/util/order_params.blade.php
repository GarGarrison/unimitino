<form class="col s12" method="post" action="{{ url('/make_order') }}">
    {{ csrf_field() }}
    <?php
        $user = Auth::user();
    ?>
    <div class="row">
        <div class="input-field col s6 l3">
            <input name="name" type="text" class="validate" value="{{$user->name or ''}}">
            <label for="name">Имя</label>
            @if ($errors->has('name'))
                <span class="error-block">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="input-field col s6 l3">
            <input name="city" type="text" class="validate" value="{{$user->city or ''}}">
            <label for="city">Город</label>
            @if ($errors->has('city'))
                <span class="error-block">{{ $errors->first('city') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6 l3">
            <input name="company" type="text" class="validate" value="{{$user->company or ''}}">
            <label for="company">Компания</label>
        </div>
        <div class="input-field col s6 l3">
            <input name="inn" type="text" class="validate" value="{{$user->inn or ''}}">
            <label for="inn">ИНН</label>
            @if ($errors->has('inn'))
                <span class="error-block">{{ $errors->first('inn') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6 l3">
            <input name="address" type="text" class="validate" value="{{$user->address or ''}}">
            <label for="address">Адрес</label>
        </div>
        <div class="input-field col s6 l3">
            <input name="post_index" type="text" class="validate" value="{{$user->post_index or ''}}">
            <label for="post_index">Почтовый индекс</label>
            @if ($errors->has('post_index'))
                <span class="error-block">{{ $errors->first('post_index') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6 l3">
            <input name="phone" type="text" class="validate" value="{{$user->phone or ''}}">
            <label for="phone">Телефон</label>
            @if ($errors->has('phone'))
                <span class="error-block">{{ $errors->first('phone') }}</span>
            @endif
        </div>
        <div class="input-field col s6 l3">
            <input name="email" type="text" class="validate" value="{{$user->email or ''}}">
            <label for="email">Электронная почта</label>
            @if ($errors->has('email'))
                <span class="error-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6 l3">
            <input name="bank_account" type="text" class="validate" value="{{$user->bank_account or ''}}">
            <label for="bank_account">Расчетный счет</label>
            @if ($errors->has('bank_account'))
                <span class="error-block">{{ $errors->first('bank_account') }}</span>
            @endif
        </div>
        <div class="input-field col s6 l3">
            <input name="bank_name" type="text" class="validate" value="{{$user->bank_name or ''}}">
            <label for="bank_name">Банк</label>
        </div>
    </div>
</form>