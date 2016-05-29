$(window).scroll(function() {
    var winHeight = $(window).scrollTop(),
        menuBar = $("nav.main-header-nav");
    if(winHeight > 0){
        menuBar.addClass('show-nav');
    }else{
        menuBar.removeClass('show-nav');
    }
});