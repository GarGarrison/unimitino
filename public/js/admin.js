select_settings = {
    "arrow_color": "#195894",
    "need_legend": false
}
function formSuccess(resp){
    if (resp.success) {
        alert(resp.success);
        //reloadTab();
    }
    else lightErrorsInForm(resp);
}

/*  инициализация  */
$(document).ready(function(){    
/* переключение бокового меню */
    url = document.location.href.split('/');
    $('.menu_item active').removeClass('active');
    $('#' + url[url.length -1].replace('#','')).addClass('active');
    searchResize();
    reloadDatePicker();
    $('.custom-select').initCustomSelect(select_settings);
});
/* Запрос на удаление чего-либо */
// $(document).on('click', '.delete-entity', function(event){
//     event.preventDefault();
//     if (confirm("Вы уверены?")){
//         id = $(this).attr('name');
//         url = "/admin/del_rubric/" + id;
//         $.post(url, function(respText){
//             success = respText.success;
//             if (success) alert(success);
//         });
//     }
// });
$(document).on('click', '.delete-entity', function(event){
    if (!confirm("Вы уверены?")) return false;
});

/* Отправка формы */
// $(document).on('submit', '[id$="_form"]', function(event){
//     event.preventDefault();
//     id = $(this).attr('id');
//     url = id.replace('_form','');
//     data = serializeToObject($(this));
//     SendForm(url, data, formSuccess);
// });
/*   открыть инпут ввода нового имени рубрики  */
$(document).on('change', 'select[name="rubric-to-change"]', function(){
    var rid = $(this).val();
    var name = $(this).find("option:selected").text();
    link = $('.delete-entity').attr('data-href');
    $('.delete-entity').attr('href', link+rid);
    $("#relations_dict").val(rid);
    $("input[name='name']").val(name);
    var parent = $("#relations_dict option:selected").text();
    $('select[name="parent"]').val(parent);
    $('select[name="parent"]').trigger( "change" );
});
/*   просмотр редактируемой новости */
$(document).on('click', '.edit-news-item', function(){
    if (!$(this).hasClass("active")) {
        $(".edit-news-item.active").next(".edit-news-item-more").slideUp("fast");
        $(this).next(".edit-news-item-more").slideDown("fast");
        $(".edit-news-item.active").removeClass("active");
        $(this).addClass("active"); 
    }
});

$(document).on('click', '.order-table tr', function(){
    if ($(this).hasClass("filter-string")) return true;
    $('.order-table tr').removeClass("active");
    $(this).addClass("active");
    var uid = $(this).attr("data-id");
    var actions = $(".user-actions");
    var link = actions.find(".delete-entity");
    var form = actions.find("form");
    link.attr("href", link.attr("data-href") + uid);
    form.attr("action", form.attr("data-href") + uid);
    $(this).find("td").each(function(i){
        rel = $(this).attr("data-relation");
        val = $(this).text();
        if (rel == "name") actions.find("span[data-relation='name']").text(val);
        else if (rel) actions.find("select[data-relation='" + rel + "']").val(val);
        console.log(val);
    })
    actions.show();
    if ($(".user-actions").offset().top < window.scrollY) $('html,body').scrollTop($(".user-actions").prev("h5").offset().top - 100);
});