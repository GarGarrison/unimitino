/* TODO 
    убрать из SendForm $('body').append(resp.responseText);
    может оставить console.log

*/
function print(text) {
    console.log(text);
}
// функция стандартного ответа на успешный аякс (вывод в консоль)
function standartSuccess(resp) { print(resp);}
// функция стандартного ответа на успешный аякс (алерт)
function alertSuccess(resp) { alert(resp);}
// функция при успешном выполнении аякса ( добовление html в объект)
function htmlSuccess(resp, obj) { obj.html(resp);
}
// функция ответа на отправку формы с подсветкой ошибочных данных
function formSuccess(resp){
    if (resp.success) {
        alert(resp.success);
        reloadTab();
    }
    else lightErrorsInForm(resp);
}
// собрать форму в словарь
function serializeToObject(form) {
    arr = form.serializeArray();
    tmp = {};
    $.each(arr, function(){
        tmp[this.name]=this.value;
    });
    return tmp;
}

// подсветить неправильно заполненные поля формы в материалайзе
function lightErrorsInForm(errors) {
    for (var k in errors) {
        $("form.ajax-form").find('label[for="' + k + '"]').after("<span class='error-block'>" + errors[k] + "</span>");
    }
}
// перезагрузка материального селекта
function selectReload() {
    $('select').material_select();
}
//перезагрузка разных объектов
function reloadSomeJS(){
    selectReload();
    $('.datepicker').pickadate({
        today: 'Сегодня',
        clear: '',
        close: 'Закрыть',
        onSet: function(context) {this.close();}
    });
}

// загрузка данных в таб
function loadTab(url) {
    $(".tab-container").load(url, function(){reloadSomeJS();})
}

// перезагрузка данных таба
function reloadTab() {
    url = $(".tab a.active").attr("href");
    loadTab(url);
}

// отправка любой формы
function SendForm(url, data, success=standartSuccess, obj="") {
    if (!data['_token']) data['_token'] = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        'url': url,
        'type': 'post',
        'data': data,
        'success': function(resp){
            success(resp, obj)
        },
        'error': function(resp) {
            $('body').prepend(resp.responseText);
        }
    })
}

// аякс сабмит формы
$(document).on('submit', '.ajax-form', function(event){
    event.preventDefault();
    url = $(this).attr('action');
    data = serializeToObject($(this));
    SendForm(url, data, formSuccess);
});
// запрос на поиск
$(document).on('submit', '.search_form', function(event){
    event.preventDefault();
    url = $(this).attr("action");
    data = serializeToObject($(this));
    SendForm(url, data, htmlSuccess, $('.content'));
});