// хорошее округление
function round(d,n) {
    p = n || 2;
    if (n == 0) p = 0;
    count = Math.pow(10,p);
    return Math.round(parseFloat(d) * count) / count;
}

// собрать заказ из таблицы в словарь
function makeOrder() {
    order = [];
    $('.order-table tbody tr').each(function(){
        id = $(this).attr('name');
        count = $(this).find('div[name="count"]').text();
        price = $(this).find('td[name="price"]').text();
        order.push({"id": id, "count": count, "price": price});
    })
    return order;
}
// обновить количество товаров в корзине, после клика на товар
function plusCart() {
    cur_count = parseInt($("span.cart-length").text());
    $("span.cart-length").text(cur_count + 1);
}

// обновить количество товаров в корзине, после клика на товар
function minusCart() {
    cur_count = parseInt($("span.cart-length").text());
    $("span.cart-length").text(cur_count - 1);
}

// Подсчет конкретной суммы для позиции в корзине
function currentSum(sum) {
    count = parseFloat(sum.closest(".card-item").find(".goods-count").val());
    price = parseFloat(sum.closest(".card-item").find(".cart-price").text());
    sum.text(round(count*price, 2));
}

// Подсчет сумм для каждой позиции в корзине
function allSum() {
    $(".cart-bottom .sum-price").each(function(i) {
        sum = $(this);
        currentSum(sum);
    })
}
// Подсчет общей итоговой суммы
function resultSum() {
    rez = 0.0;
    $(".cart-bottom .sum-price").each(function(i) {
        cur_sum = parseFloat($(this).text());
        rez = rez + cur_sum;
    });
    $(".cart-result-sum-price").text(rez);
}
function checkRadio(){
    if ($(".radio-item.active").length ) $(".radio-item.active").chooseRadio();
    else if ($(".radio-block") ) $(".radio-item:first").chooseRadio();
}
// скрыть выпавшее до меню
$(document).on('click', 'body', function(event){
    c = $(event.target);
    if (!c.hasClass("protected-for-click")) $(".more-tip").hide();
});

// аккордеон меню
$(document).on('click', '.menu-item', function(){
    if ($(this).has('i')) {
        i = $(this).find('i')
        if (i.text() == "chevron_right") i.text("expand_more");
        else i.text("chevron_right");
    }
    $(this).next('ul').slideToggle('fast');
});
$(document).on('click', '.card-head.drop-head', function(){
    $(this).next(".card-body").slideToggle('fast');
});
// добавить позицию из поиска в корзину
$(document).on('click', '.to-cart', function(){
    count = $(this).closest(".card-item-info").find(".goods-count").val()
    if ( count == 0 ) {
        alert("Укажите количество товара!");
        return false;
    }
    url = "/add_to_cart";
    gid = $(this).attr('data-id');
    $.ajax({
        'url': url,
        'type': 'post',
        'data': {'gid': gid, 'count': count},
        'success': function(resp) {
            if (resp.success) plusCart();
            alert(resp.message);   
        }
    })
});

// удаление позиции из корзины
$(document).on('click', '.delete-from-cart', function(){
    par = $(this).closest(".card-item");
    id = $(this).attr('data-id');
    $.ajax({
        'url': "/delete_from_cart/" + id,
        'type': 'get',
        'success': function(resp){
            //console.log(resp.success, resp.message);
            if (resp.success) {
                par.remove();
                minusCart();
                resultSum();
                if ($(".cart-item").length == 1) $(".cart-item").closest(".card-body").html("<h5>Ваша корзина пока пуста</h5>");
            }
            alert(resp.message);
            
        }
    })
});

// показать этапы заказа
$(document).on('click', '.order-next-step', function(){
    $(this).closest('.card-wrapper').next('.order-step').slideDown('fast');
    $(this).hide();
});

// отправить заказ
$(document).on('click', '.do-order', function(event){
    event.preventDefault();
    form = $(this).closest('form');
    url = form.attr('action');
    data = serializeToObject(form);
    data["order"] = makeOrder();
    SendForm(url, data, function(resp) {
        alert(resp);
        document.location.reload();
    });
});

// развернуть превью новости
$(document).on('click', '.card-item-bottom', function(){
    if ($(this).children("i").text() == "arrow_drop_up") {
        $(".card-more-info").slideUp("fast");
        $(this).find("i").text("arrow_drop_down");
        return false;
    }
    $(".card-more-info").slideUp("fast");
    $(".card-item-bottom i").text("arrow_drop_down");
    $(this).closest(".card-item").find(".card-more-info").slideDown("fast");
    $(this).find("i").text("arrow_drop_up");
});
// показать доп меню
$(document).on('click', '.more-tip-trigger', function(){
    $(".more-tip").hide();
    tip = $(this).attr("data-tip");
    tip_obj = $("." + tip);
    // 10 для более удлинненого блока (взято просто так)
    large_width = 10;
    last_x = tip_obj.width() + large_width;
    middle_x = tip_obj.width() * 0.6;
    p = tip_obj.find("path");
    d = "M 0,11 " + middle_x + ",11 " + (middle_x+large_width) + ",0 " + (middle_x + large_width*2) + ",11 " + last_x + ",11";
    tip_obj.find("svg").attr("width",last_x);
    tip_obj.find("path").attr("d",d);
    delta = 0;
    if (tip == "main-menu-tip") delta = 15;
    y = $(this).offset().top + $(this).height() - delta;
    x = $(this).offset().left - tip_obj.width() * parseFloat(2)/3 + $(this).width()/2 + large_width;
    tip_obj.css({"top": y, "left": x});
    tip_obj.fadeIn("fast");
});
// подгрузить нужный блок пользовательского меню
$(document).on('click', '.user-menu-tip a', function(e){
    e.preventDefault();
    url = $(this).attr("href");
    $(".user-menu-container").load(url, function(){
        checkRadio();
    });
})
// обновить конкретную сумму
$(document).on('blur', '.goods-count', function(){
    sum = $(this).closest(".card-item").find(".cart-bottom .sum-price");
    currentSum(sum);
});

// пересчитать общую сумму
$(document).on('click', '.cart-result-resum', function(){
    resultSum();
});
$.fn.chooseRadio = function() {
    block = $(this).closest(".radio-block");
    v = $(this).attr("data-val");
    targ = $(".toggle-form[data-target='" + v + "']");
    block.find(".active").removeClass("active");
    $(this).addClass("active");
    $(".toggle-form").hide();
    targ.show();
}
$(document).on('click', '.radio-item', function(){
    $(this).chooseRadio();
});

$(document).on('click', '.btn-param', function(){
    data = {"rid": $(this).attr("data-rid")};
    params = [];
    $(this).closest(".card-body").find("input").each(function(){
        v = $(this).val();
        column = $(this).attr("data-colname");
        operation = $(this).attr("data-operation");
        i = {"column": column, "operation": operation, "value": v};
        if (v) params.push(i);
    });
    data["params"] = params;
    //data = JSON.stringify(data);
    if (!params.length) return false;
    $(".main-content").load("/rubric/filter", data);
});

$(document).ready(function(){
    $(".button-collapse").sideNav();
    url = location.href.split("/").pop();
    $('.top-menu a[data-url="' + url + '"]').addClass("active");
    if (url == "cart") {
        allSum();
        resultSum();
    }
    checkRadio();
});