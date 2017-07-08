<h5>История заказов</h5>
@if ($bills)
    @foreach($bills as $billid => $bill)
        <div class="user-block">
            <table>
                <tr>
                    <td class="history-title">
                        Накладная №{{ $billid }} от <span class="history-date">{{ $bill["date"] }}</span>
                    </td>
                    <td rowspan="2" class="right-align"><img class="history-loupe" src="/img/big-loupe.png" /></td>
                </tr>
                <tr>
                    <td class="history-sum">
                        Сумма заказа: <span class="green-text">{{ $bill["sum"] }} {{ $bill["money"] }}</span>
                    </td>
                </tr>
            </table>
            <div class="history-more">
                <h5>Накладная №{{ $billid }} от <span class="blue-text">{{ $bill["date"] }}</span></h5>
                <table class="order-table">
                    <th>Товар</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    @foreach($bill["items"] as $i)
                        <?php
                            $class = "green-text";
                            if($i->countdone < $i->countorder) $class = "red-text";
                        ?>
                        <tr>
                            <td>{{ $i->typonominal }}<span class="vert-stick">|</span> {{ $i->producer }}</td>
                            <td>
                                <div class="blue-text">Заказано: <span class="right">{{ $i->countorder }}</span></div>
                                <div class="{{ $class }}">Набрано: <span class="right">{{ $i->countdone }}</span></div>
                            </td>
                            <td>{{ $i->price }} {{ $i->money }}</td>
                            <td>{{ $i->countdone * $i->price }} {{ $i->money }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endforeach
@else
    <h5>У вас пока нет заказов</h5>
@endif