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
    cur_count = parseInt($("span.cart-count").text());
    $("span.cart-count").text(cur_count + 1);
}
$(document).ready(function(){
    //$('.menu ul').prev('.menu-item').append("<span>&#9658;</span>");
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

// добавить позицию из поиска в корзину
$(document).on('click', '.to-cart', function(){
    gid = $(this).closest('tr').attr('name');
    url = $(this).closest('table').attr('href');
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
$(document).on('click', '.delete-from-cart', function(event){
    event.preventDefault();
    url = $(this).attr('href');
    id = $(this).closest('tr').attr('name');
    token = $('input[name="_token"]').val();
    data = {'id': id, '_token': token};
    $.ajax({
        'url': url,
        'type': 'post',
        'data': data,
        'success': function(){
            document.location.reload();
        },
        'error': function(resp){
            $('body').prepend(resp.responseText);
        }
    })
});

// показать этапы заказа
$(document).on('click', '.order-next-step', function(){
    $(this).closest('.row').next('.order-step').slideDown('fast');
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
