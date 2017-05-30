<div class="card-item">
    <div class="card-item-body">
        <div class="card-item-desc">{{ $g->goodsname }} <span class="vert-stick">|</span>{{ $g->producer }}
        </div>
        <div class="card-item-info row">
            <div class="col s4 m7"><div class="goods-price green-text">{{ $g->price_minitrade_rub }}</div></div>
            <div class="col s4 m3"><input class="goods-count" type="text" value="{{ $g->onlinecount }}" /></div>
            <div class="col s4 m1 offset-m1"><i class="material-icons right to-cart" data-id="{{ $g->id }}" title="В корзину">shopping_cart</i></div>
            <div class="col s12">
                <b>Кол-во в упаковке: <span class="green-text">{{ $g->packcount }}шт</span>
                 | Цена при покупке упаковки: <span class="green-text">{{ $g->price_pack_rub }}</span></b></div>
        </div>
        <div class="card-more-info">
            <table>
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

            Техническая информация (zip, 75Кб)
        </div>
    </div>
    <div class="card-item-bottom">
        <i class="material-icons" title="Подробнее">arrow_drop_down</i>
    </div>
</div>