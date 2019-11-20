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
    var nav = $("nav.top-nav");
    if (window.scrollY > 73) {
        nav.css({
            'position': "fixed",
            'top': '0',
        });
    }
    else {
        nav.css({
            'position': 'absolute',
            'top': 73
        });
    }
});