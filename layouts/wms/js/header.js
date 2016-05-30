$(window).scroll(function() {
    var winHeight = $(window).scrollTop(),
        menuBar = $("nav.main-header-nav"),
        headerHeight = $("#header-banner").height();
        bodyContent = $("#body-content");
    if(winHeight > headerHeight){
        menuBar.addClass('show-nav');
        bodyContent.css({'margin-top':menuBar.height()});
    }else{
        menuBar.removeClass('show-nav');
        bodyContent.css({'margin-top':'initial'});
    }
});
$(document).ready(function(){
	$(".side-nav-bar-dropdown-button").dropdown({hover:true,belowOrigin:true});
	$(".dropdown-button").dropdown({hover:false,belowOrigin:true});
});