$(window).scroll(function() {
    var winHeight = $(window).scrollTop(),
        menuBar = $("nav.main-header-nav");
    if(winHeight > 0){
        menuBar.css({'background-color':'#6ECFEE'});
    }else{
        menuBar.css({'background-color':'transparent'});
    }
});