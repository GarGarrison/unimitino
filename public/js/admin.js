function formSuccess(resp){
    if (resp.success) {
        alert(resp.success);
        reloadTab();
    }
    else lightErrorsInForm(resp);
}

/*  инициализация  */
$(document).ready(function(){    
    reloadTab();
/* переключение бокового меню */
    url = document.location.href.split('/');
    $('.menu_item active').removeClass('active');
    $('#' + url[url.length -1].replace('#','')).addClass('active');
    searchResize();
});
/*   переключение табов */
$(document).on('click', '.tab', function(){
    url = $(this).children('a').attr('href');
    loadTab(url);
});
/* Запрос на удаление чего-либо */
$(document).on('click', '.delete-entity', function(event){
    event.preventDefault();
    if (confirm("Вы уверены?")){
        id = $(this).attr('name');
        url = $(this).attr('href');
        SendForm(url, {'id': id}, formSuccess);
    }
});
/* Отправка формы */
$(document).on('submit', '[id$="_form"]', function(event){
    event.preventDefault();
    id = $(this).attr('id');
    url = id.replace('_form','');
    data = serializeToObject($(this));
    SendForm(url, data, formSuccess);
});
/*   открыть инпут ввода нового имени рубрики  */
$(document).on('change', 'select', function(){
    rid = $(this).val();
    if (rid) {
        $('.on-change-input').slideDown('fast');
        $('.delete-entity').css({'display': 'block'}).attr('name', $(this).val());
    }
    else {
        $('.on-change-input').slideUp('fast');
        $('.delete-entity').hide().removeAttr('name');
    }
});
/*   просмотр редактируемой новости */
$(document).on('click', '.edit-news-item', function(){
    url = $(this).attr('href');
    $('.show-current-news').slideUp('fast', function(){$(this).remove()})
    $(this).after("<div class='show-current-news'></div>");
    $('.show-current-news').load(url + " #edit_news_form", function(){
        reloadSomeJS();
    })
});