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