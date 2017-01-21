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
    count = parseFloat(sum.closest(".card-item").find(".goods-count").text());
    price = parseFloat(sum.closest(".card-item").find(".cart-price").text());
    sum.text(count*price);
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
$(document).ready(function(){
    $(".button-collapse").sideNav();
    url = location.href.split("/").pop();
    $('.top-menu a[data-url="' + url + '"]').addClass("active");
    if (url == "cart") {
        allSum();
        resultSum();
    }
});

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
    url = "/add_to_cart";
    gid = $(this).attr('data-id');
    $.ajax({
        'url': url,
        'type': 'post',
        'data': {'gid': gid},
        'success': function(resp) {
            if (resp.success) plusCart();
            alert(resp.message);   
        },
        'error': function(resp){
            $('body').prepend(resp.responseText);
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
            if (resp.success) alert(resp.success);
            else alert("error");
            par.remove();
            minusCart();
        },
        'error': function(resp){
            $('body').prepend(resp.responseText);
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
    y = $(this).offset().top + $(this).height() - 20;
    x = $(this).offset().left - $(".more-tip").width()/3 -15;
    $(".more-tip").css({"top": y, "left": x});
    $(".more-tip").fadeIn("fast");
});

// обновить конкретную сумму
$(document).on('blur', '.goods-count', function(){
    sum = $(this).closest(".card-item").find(".cart-bottom .sum-price");
    currentSum(sum);
});

// пересчитать общую сумму
$(document).on('click', '.cart-result-resum', function(){
    resultSum();
});
