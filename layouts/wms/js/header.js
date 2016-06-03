var header = {
    headerBkg: $("#header-banner"),
    headerPosition: -350
};

var __window = {
    width: $(window).width(),
    height: $(window).height()
};

if(__window.width <= 960 && __window.width >= 600) {
    header.headerPosition = -250;
}else if(__window.width <= 599) {
    header.headerPosition = -150;
}

$(window).resize(function() {
    __window.width = $(this).width();
    if(__window.width <= 960 && __window.width >= 600) {
        header.headerPosition = -250;
    }else if(__window.width <= 599) {
        header.headerPosition = -150;
    }
    header.headerBkg.css({'background-position-y':header.headerPosition});
});


$(window).scroll(function() {
    var height = $(this).scrollTop(),
        title = $("#wms-title"),
        menuBar = $("nav.main-header-nav"),
        headerHeight = header.headerBkg.height();
        bodyContent = $("#body-content");
    header.headerBkg.css({'background-position-y': header.headerPosition + (0.2*height) + 'px'});
    title.css({'margin-top':(0.8*height) + 'px'});
    if(height > headerHeight){
        menuBar.addClass('show-nav');
        bodyContent.css({'margin-top':menuBar.height()});
    }else{
        menuBar.removeClass('show-nav');
        bodyContent.css({'margin-top':'initial'});
    }
});



$(document).ready(function(){
    header.headerBkg.css({'background-position-y':header.headerPosition});
    $(".side-nav-bar-dropdown-button").dropdown({hover:true,belowOrigin:true});
    $(".dropdown-button").dropdown({hover:false,belowOrigin:true});
});