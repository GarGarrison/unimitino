<?php
    $fizclass = "";
    $jurclass = "";
    $user = Auth::user();
    if ($user) {
        $fizclass = $user->type == 'fiz' ? 'active':'';
        $jurclass = $user->type == 'jur' ? 'active':'';
    }
?>
<div class="col s12 radio-block" name="user_type">
    <div class="radio-item {{ $fizclass }}" data-val="fiz" data-group="user_type">
        <svg class="radio-svg">
            <circle class="radio-border" cx=11 cy=11 r=10 stroke="#ccc" fill="none" />
            <circle class="radio-heart" cx=11 cy=11 r=3 stroke="none" fill="#195894" />
        </svg>
        <span>Физическое лицо</span>
    </div>
    <div class="radio-item {{ $jurclass }}" data-val="jur" data-group="user_type">
        <svg class="radio-svg">
            <circle cx=11 cy=11 r=10 stroke="#ccc" fill="none" />
            <circle class="radio-heart" cx=11 cy=11 r=3 stroke="none" fill="#195894" />
        </svg>
        <span>Юридическое лицо</span>
    </div>
</div>