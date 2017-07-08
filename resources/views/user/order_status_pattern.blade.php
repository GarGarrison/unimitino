@if ($o->status == 0)
    <div class="user-block">
        <div class="row">
            <div class="col s12">
                <span class="track-title">{{ $o->typonominal }}<span class="vert-stick">|</span>{{ $o->producer }}</span>
                <img class="right" src="/img/status-wait.png" />
            </div>
        </div>
        <div class="row">
            <div class="col s4">
                <span class="track-span">Цена:</span>
                <span class="goods-price track">{{ $o->price }} {{ $o->money }}</span>
            </div>
            <div class="col s4 center-align">
                <span class="track-span">Заказано:</span>
                <input class="goods-count track" type="text" value="{{ $o->countorder }}" />
            </div>
            <div class="col s4 right-align">
                <img class="right delete-order" data-oid="{{ $o->oid }}" src="/img/delete-button.png" title="Удалить позицию"/>
            </div>
        </div>
    </div>
@elseif ($o->status == 1)
    <div class="user-block">
        <div class="row">
            <div class="col s12">
                <span class="track-title">{{ $o->typonominal }}<span class="vert-stick">|</span>{{ $o->producer }}</span>
                <img class="right" src="/img/status-delete.png" />
            </div>
        </div>
        <div class="row">
            <div class="col s8">
                <span class="track-span">Цена:</span>
                <span class="goods-price track">{{ $o->price }} {{ $o->money }}</span>
            </div>
            <div class="col s4 right-align">
                <i class="material-icons cart-icon back-to-order" data-oid="{{ $o->oid }}" title="Вернуть позицию в заказ">shopping_cart</i>
            </div>
        </div>
    </div>
@elseif ($o->status == 2)
    <div class="user-block">
        <div class="row">
            <div class="col s12">
                <span class="track-title">{{ $o->typonominal }}<span class="vert-stick">|</span>{{ $o->producer }}</span>
                <img class="right" src="/img/status-building.png" />
            </div>
        </div>
        <div class="row">
            <div class="col s4">
                <span class="track-span">Цена:</span>
                <span class="goods-price track">{{ $o->price }} {{ $o->money }}</span>
            </div>
            <div class="col s4 center-align">
                <span class="track-span">Заказано:</span><span class="track-span blue-text">{{ $o->countorder }}</span>
            </div>
        </div>
    </div>
@elseif ($o->status == 3)
    <div class="user-block">
        <div class="row">
            <div class="col s12">
                <span class="track-title">{{ $o->typonominal }}<span class="vert-stick">|</span>{{ $o->producer }}</span>
                <img class="right" src="/img/status-built.png" />
            </div>
        </div>
        <div class="row">
            <div class="col s4">
                <span class="track-span">Цена:</span>
                <span class="goods-price track">{{ $o->price }} {{ $o->money }}</span>
            </div>
            <div class="col s4 center-align">
                <span class="track-span">Заказано:</span><span class="track-span blue-text">{{ $o->countorder }}</span>
            </div>
            <div class="col s4 right-align">
                <span class="track-span">Набрано:</span><span class="track-span red-text">{{ $o->countdone }}</span>
            </div>
        </div>
    </div>
@elseif ($o->status == 4)
    <div class="user-block">
        <div class="row">
            <div class="col s12">
                <span class="track-title">{{ $o->typonominal }}<span class="vert-stick">|</span>{{ $o->producer }}</span>
                <img class="right" src="/img/status-built.png" />
            </div>
        </div>
        <div class="row">
            <div class="col s4">
                <span class="track-span">Цена:</span>
                <span class="goods-price track">{{ $o->price }} {{ $o->money }}</span>
            </div>
            <div class="col s4 center-align">
                <span class="track-span">Заказано:</span><span class="track-span blue-text">{{ $o->countorder }}</span>
            </div>
            <div class="col s4 right-align">
                <span class="track-span">Набрано:</span><span class="track-span green-text">{{ $o->countdone }}</span>
            </div>
        </div>
    </div>
@elseif ($o->status == 5)
    <div class="user-block">
        <div class="row">
            <div class="col s12">
                <span class="track-title">{{ $o->typonominal }}<span class="vert-stick">|</span>{{ $o->producer }}</span>
                <img class="right" src="/img/status-unavail-big.png" />
            </div>
        </div>
        <div class="row">
            <div class="col s4">
                <span class="track-span">Цена:</span>
                <span class="goods-price track">{{ $o->price }} {{ $o->money }}</span>
            </div>
            <div class="col s4 center-align">
                <span class="track-span">Заказано:</span><span class="track-span blue-text">{{ $o->countorder }}</span>
            </div>
        </div>
    </div>
@endif


