<h5>Профиль</h5>
<div class="row">
    <div class="col s12 radio-block" name="user_type">
        <div class="radio-item {{ Auth::user()->type == 'fiz' ? 'active':'' }}" data-val="fiz">
            <svg class="radio-svg">
                <circle class="radio-border" cx=11 cy=11 r=10 stroke="#ccc" fill="none" />
                <circle class="radio-heart" cx=11 cy=11 r=3 stroke="none" fill="#195894" />
            </svg>
            <span>Физическое лицо</span>
        </div>
        <div class="radio-item {{ Auth::user()->type == 'jur' ? 'active':'' }}" data-val="jur">
            <svg class="radio-svg">
                <circle cx=11 cy=11 r=10 stroke="#ccc" fill="none" />
                <circle class="radio-heart" cx=11 cy=11 r=3 stroke="none" fill="#195894" />
            </svg>
            <span>Юридическое лицо</span>
        </div>
    </div>
</div>
<form method="post" action="{{ url('/home') }}" class="toggle-form" data-target="fiz">
    {{ csrf_field() }}
    @include("user.user_fiz_data")
    <div class="row">
        <div class="col s3">
            <div class="form-title">Пароль:</div>
        </div>
        <div class="form-field col s9">
            <input name="password" type="password">
        </div>
        <div class="col s3">
            <div class="form-title">Пароль еще раз:</div>
        </div>
        <div class="form-field col s9">
            <input name="password_confirmation" type="password">
        </div>
        <div class="col s12">
            <button type="submit" class="btn right">
                Сохранить
            </button>
        </div>
    </div>
</form>
<form method="post" action="{{ url('/home') }}" class="toggle-form" data-target="jur">
    {{ csrf_field() }}
    @include("user.user_jur_data")
    <div class="row">
        <div class="col s3">
            <div class="form-title">Пароль:</div>
        </div>
        <div class="form-field col s9">
            <input name="password" type="password">
        </div>
        <div class="col s3">
            <div class="form-title">Пароль еще раз:</div>
        </div>
        <div class="form-field col s9">
            <input name="password_confirmation" type="password">
        </div>
        <div class="col s12">
            <button type="submit" class="btn right">
                Сохранить
            </button>
        </div>
    </div>
</form>