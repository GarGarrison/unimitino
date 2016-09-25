/* TODO 
    убрать из SendForm $('body').append(resp.responseText);
    может оставить console.log

*/
function serializeToObject(form) {
    arr = form.serializeArray();
    tmp = {};
    $.each(arr, function(){
        tmp[this.name]=this.value;
    });
    return tmp;
}

function lightErrorsInForm(errors) {
    for (var k in errors) {
        $("form[id$='_form']").find('label[for="' + k + '"]').after("<span class='error-block'>" + errors[k] + "</span>");
    }
}

function reloadSomeJS(){
    $('select').material_select();
    $('.datepicker').pickadate({
        today: 'Сегодня',
        clear: '',
        close: 'Закрыть',
        onSet: function(context) {this.close();}
    });
}
function loadTab(url) {
    $(".tab-container").load(url, function(){reloadSomeJS();})
}
function reloadTab() {
    url = $(".tab a.active").attr("href");
    loadTab(url);
}

function standartSuccess(resp) { console.log(resp);}

function SendForm(url, data, success=standartSuccess) {
    if (!data['_token']) data['_token'] = $('input[name="_token"]').val();
    $.ajax({
        'url': url,
        'type': 'post',
        'data': data,
        'success': function(resp){
            success(resp)
        },
        'error': function(resp) {
            $('body').prepend(resp.responseText);
        }
    })
}