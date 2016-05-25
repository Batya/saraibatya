$(window).scroll(function() {
    var winHeight = $(window).scrollTop(),
        headerHeight = 130,
        menuIcon = $(".menu"),
        menuBar = $(".menuBar");
    if(winHeight >= headerHeight){
        menuIcon.css({color: 'lightgray'});
        menuBar.show();
    }else{
        menuIcon.css({color: 'white'});
        menuBar.fadeOut(200);
    }
});