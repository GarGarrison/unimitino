// пересчитать размер поисковой строки
function searchResize(){
    w = $(".search-bar").width()
    // 160px - размер кнопки 
    $("#search").width(w-170);
}
$(window).resize(searchResize);

$(document).ready(function(){
    $(".button-collapse").sideNav();
    searchResize();
});

$(document).scroll(function(){
    var top_val = 73;
    var position = 'absolute'
    if (window.outerWidth < 992) {
        top_val = 0;
        position = 'initial';
    }

    var nav = $("nav.top-nav");
    if (window.scrollY > top_val) {
        nav.css({
            'position': "fixed",
            'top': 0,
        });
    }
    else {
        nav.css({
            'position': position,
            'top': top_val
        });
    }
});