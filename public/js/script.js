var reloadinterval;
select_settings = {
    "arrow_color": "#195894",
    "need_legend": false
}
function DoSetInterval(){
    //reloadinterval = setInterval(ReloadTracker, 3000);
}
function StopReloadTracker(){
    //clearInterval(reloadinterval);
}
$(document).ajaxError(function(event, request, settings){
    $("body").prepend(request.responseText);
});

function ReloadTracker() {
    $(".user-menu-container").load("/home/track");
}
// хорошее округление
function round(d,n) {
    p = n || 2;
    if (n == 0) p = 0;
    count = Math.pow(10,p);
    return Math.round(parseFloat(d) * count) / count;
}

// отправить не ajax запрос с произвольными данными в словаре
function magicDataSubmit(dic, action, method) {
    var form = $("<form></form>", {action:action, method:method, style: "display: none;"});
    if ($("meta[name='csrf-token']")) {
        var token = $("meta[name='csrf-token']").attr('content');
        var token_i = $("<input type='text' name='_token'>");
        token_i.val(token);
        form.append(token_i);
    }
    for (k in dic) {
        var i = $("<input type='text'>");
        i.attr("name", k);
        i.attr("value", dic[k]);
        form.append(i);
    }
    print(dic)
    form.appendTo("body").submit();
}

// обновить количество товаров в корзине, после клика на товар
function plusCart() {
    cur_count = parseInt($("span.cart-length").text());
    $("span.cart-length").text(cur_count + 1);
    $("span.cart-length-simple").text(cur_count + 1);
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
function checkGoodsCount(obj) {
    var count = obj.val();
    var max_count = obj.attr("data-max-count");
    if ( isNaN( parseInt(count) ) ) {
        alert("Количество должно быть числом!")
        return false;
    }
    if (parseInt(count) > parseInt(max_count)) {
        alert("На складе есть только " + max_count);
        return false;
    }
    if ( count == 0 ) {
        alert("Укажите количество товара!");
        return false;
    }
    return true;
}
// Подсчет общей итоговой суммы
function resultSum() {
    rez = 0.0;
    $(".cart-bottom .sum-price").each(function(i) {
        cur_sum = parseFloat($(this).text());
        rez = rez + cur_sum;
    });
    $(".cart-result-sum-price-value").text(round(rez));
}
$.fn.updateCount = function() {
    cid = $(this).attr("data-id");
    v = $(this).val();
    $.post("/cart/update_count", {cid:cid, value: v});
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
    if ($(this).hasClass("empty")) return false;

    var obj = $(this).next(".goods-count-container").find(".goods-count");
    var count = obj.val()
    var check = checkGoodsCount(obj);
    
    if (!check) return false;

    var url = "/add_to_cart";
    var gid = $(this).attr('data-id');
    var price = $(this).attr('data-price');
    var money = $(this).attr('data-money');
    $.ajax({
        'url': url,
        'type': 'post',
        'data': {'gid': gid, 'count': count, 'price': price, 'money': money},
        'success': function(resp) {
            if (resp.success) plusCart();
            alert(resp.message);   
        }
    })
});

// удаление позиции из корзины
$(document).on('click', '.delete-from-cart', function(){
    var par = $(this).closest(".card-item");
    var id = $(this).attr('data-id');
    $.ajax({
        'url': "/delete_from_cart/" + id,
        'type': 'get',
        'success': function(resp){
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

// // развернуть превью новости
// $(document).on('click', '.card-item-bottom', function(){
//     if ($(this).children("i").text() == "arrow_drop_up") {
//         $(".card-more-info").slideUp("fast");
//         $(this).find("i").text("arrow_drop_down");
//         return false;
//     }
//     $(".card-more-info").slideUp("fast");
//     $(".card-item-bottom i").text("arrow_drop_down");
//     $(this).closest(".card-item").find(".card-more-info").slideDown("fast");
//     $(this).find("i").text("arrow_drop_up");
// });
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
$(document).on('blur', '.cart-goods-count', function(){
    var obj = $(this);
    var check = checkGoodsCount(obj);

    if (!check) return false;

    var sum = $(this).closest(".card-item").find(".cart-bottom .sum-price");
    currentSum(sum);
    $(this).updateCount();
});

// пересчитать общую сумму
$(document).on('click', '.cart-result-resum', function(){
    resultSum();
});
$.fn.chooseRadio = function() {
    block = $(this).closest(".radio-block");
    v = $(this).attr("data-val");
    group = $(this).attr("data-group");
    targ = $(".toggle-form[data-target='" + v + "'][data-group='" + group + "']");
    block.find(".active").removeClass("active");
    $(this).addClass("active");
    $(".toggle-form[data-group='" + group + "']").hide();
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
    if (!params.length) return false;
    $(".main-content").load("/rubric/filter", data);
});

// показать транспортные компании, если выбрана такая доставка
$(document).on('change', '#delivery-type', function(){
    v = $(this).val();
    if (v == "Транспортная компания") $("#transport-company").initCustomSelect(select_settings);
    else $("#transport-company").destroyCustomSelect();
});

// отправить заказ в работу
$(document).on('click', '#order', function(e){
    e.preventDefault();
    v = $(this).attr("data-val");
    user_form = serializeToObject($(".toggle-form:visible"));
    pay = $(".radio-item.active[data-group='payment']").attr("data-val");
    delivery_form = serializeToObject($(".delivery-form"));
    delivery_type = $("#delivery-type[data-init='1']").val();
    transport_company = $("#transport-company[data-init='1']").val() || "";
    qiwi_phone = $("input[name='qiwi_phone']").val() || "";
    if (!pay) {
        alert("Укажите способ оплаты!");
        return false;
    }
    order = Object.assign(user_form, delivery_form, {"payment": pay, "qiwi_phone": qiwi_phone, "delivery_type": delivery_type, "transport_company": transport_company});
    magicDataSubmit(order, "/make_order", "post");
});

// удалить позицию из заказа
$(document).on("click", ".delete-order", function(){
    oid = $(this).attr("data-oid");
    $.post("/home/delete_order/" + oid, function(resp) {
        alert(resp);
        ReloadTracker();
    });
});

// вернуть удаленную позицию назад в заказ
$(document).on("click", ".back-to-order", function(){
    oid = $(this).attr("data-oid");
    $.post("/home/back_to_order/" + oid, function(resp) {
        alert(resp);
        ReloadTracker();
    });
});

// посмотреть подробную информацию о накладной (нажав на лупу)
$(document).on("click", ".history-loupe", function(){
    shadow_settings = {
        "max_width": "900px"
    }
    $(this).closest("table").next(".history-more").initShadow(shadow_settings);
})

$(document).ready(function(){
    $(".button-collapse").sideNav();
    url = location.href.split("/").pop();
    $('.top-menu a[data-url="' + url + '"]').addClass("active");
    if (url == "cart") {
        allSum();
        resultSum();
    }
    checkRadio();
    StopReloadTracker();
    $('#delivery-type').initCustomSelect(select_settings);
});