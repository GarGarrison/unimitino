<div class="card-item">
    <div class="card-item-body">
        <div class="goods-item-info-short">
            <div class="card-item-desc"><b>{{ $g->typonominal }} <span class="vert-stick">|</span>{{ $g->producer }} <span class="vert-stick">|</span>{{ $g->case }}</b>
                <div class="goods-img"><img src="{{ $g->img }}"></div>
            </div>
            <div class="goods-price green-text">{{ $g->$price_level }} {{ $money }}</div>
            @if ($g->onlinecount)
                <i class="material-icons right to-cart cart-icon" data-id="{{ $g->id }}" data-price="{{ $g->$price_level }}" data-money="{{ $money }}" title="В корзину">shopping_cart</i>
                <div class="goods-count-container">
                    <input class="goods-count" type="text" 
                        data-max-count="{{ $g->onlinecount }}"
                        placeholder="{{ $g->onlinecount }}"
                        onfocus="this.placeholder=''"
                        onblur="this.placeholder='{{ $g->onlinecount }}'" 
                    />
                    @if (isset ($cart_dict[$g->id]))
                        <div class="goods-in-cart-count">Заказано: {{ $cart_dict[$g->id] }}</div>
                    @endif
                </div>    
            @elseif ($g->supply)
                <i class="material-icons right to-mail" title="В корзину">mail</i>
                <div class="goods-count-container">
                    <input class="goods-count supply" type="text" value="Сообщить о поставке" disabled="disabled" />
                </div>
            @else
                <i class="material-icons right cart-icon empty" title="Товара нет в наличии">shopping_cart</i>
                <div class="goods-count-container">
                    <input class="goods-count empty" type="text" value="Нет в наличии" disabled="disabled" />
                </div>
            @endif

            @php($price_pack_money = $price_pack[$money])
            @if ($g->packcount || $g[$price_pack_money] || $g->mark)
            <div class="goods-item-info">
                @if ($g->packcount)
                <b>Кол-во в упаковке: </b><span class="green-text">{{ $g->packcount }}шт</span></b>
                @endif
                @if ($g[$price_pack_money])
            <span class="vert-stick">|</span> <b>Цена при покупке упаковки: <span class="green-text">{{ $g[$price_pack_money] }} {{$money}}</span></b>
                <br />
                @endif
                @if ($g->mark)
                <b>Маркировка: <span class="green-text">{{ $g->mark }}</span></b>
                @endif
            </div>
            @endif
            <p>{{ $g->description }}</p>
        </div>
        <div class="card-more-info">
                <p>{!! $g->description_long !!}</p>
            {{-- <table>
                <tr>
                    <td>Внешний вид:</td><td>желтоватая жидкость</td>
                </tr>
                <tr>
                    <td>Плотность при 25°С:</td><td>1,04 г/см3</td>
                </tr>
                <tr>
                    <td>Термостойкость:</td><td>-45°С- +500°С</td>
                </tr>
                <tr>
                    <td>Вязкость при 23°С:</td><td>220-330 мПа</td>
                </tr>
                <tr>
                    <td>Содержание не летучих веществ:</td><td>50%</td>
                </tr>
                <tr>
                    <td>Поверхностное сопротивление (DIN53483):</td><td>7,5x1016Ом см</td>
                </tr>
                <tr>
                    <td>Диэлектрическая постоянная (DIN53483):</td><td>3,09</td>
                </tr>
                <tr>
                    <td>Прочность диэлектрика:</td><td>(DIN53481)110кВ/мм</td>
                </tr>
            </table>
            <b>Характеристики</b>
            <p>ISOTEMP – термостойкое, влагоотталкивающее и водонепроницаемое защитное покрытие на силиконовой основе, 
            предназначенное для использования в микроэлектронике для жестких и гибких печатных плат. Сохраняет свою эффективность до +500°С. 
            Кроме того, оно огнеупорное (в соответствии со стандартом UL94), эластичное и обладает хорошей адгезией. 
            ISOTEMP также предохраняет компоненты от влаги, сырости, соли, плесени и коррозионных испарений.</p>
            <b>Применение</b>
            <p>Применяется для изоляции печатных плат, подверженных воздействию высоких температур в процессе работы, 
            например, в двигателях транспортных средств, авиации и аэрокосмической технике. Также используется для изоляции коммуникационного оборудования, 
            измерительных приборов, в кораблестроении, энергетике и тяжелой промышленности.</p>

            Техническая информация (zip, 75Кб) --}}
        </div>
    </div>
    <div class="card-item-bottom">
        <i class="material-icons" title="Подробнее">arrow_drop_down</i>
    </div>
</div>