"use strict";
$(window).scroll(function(){
    "use strict";
    if($(this).scrollTop()>400){
       $('.navbar').addClass('scrollTop');
    }
    else{
         $('.navbar').removeClass('scrollTop');
      
    }
})

$('html').smoothScroll();

$(function(){
    "use strict";
    new WOW().init();
});