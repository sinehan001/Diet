/*................
 ====> Testimonials Slider Area 
 .................*/
  "use strict";
(function () {
  "use strict";

  var carousels = function () {
    $(".owl-carousel1").owlCarousel({
      loop: true,
      center: true,
      margin: 0,
      responsiveClass: true,
      nav: false,
      responsive: {
        0: {
          items: 1,
          nav: false,
        },
        680: {
          items: 2,
          nav: false,
          loop: false,
        },
        1000: {
          items: 3,
          nav: true,
        },
      },
    });
  };

  (function ($) {
        "use strict";
    carousels();
  })(jQuery);
})();

/*................
 ====> Header menu 
 .................*/

 $(document).ready(function () {
       "use strict";
  if ($(window).width() > 992) {
    var navbar_height = $(".navbar").outerHeight();

    $(window).scroll(function () {
      if ($(this).scrollTop() > 300) {
        $(".navbar-wrap").css("height", navbar_height + "px");
        $("#navbar_top").addClass("fixed-top");
      } else {
        $("#navbar_top").removeClass("fixed-top");
        $(".navbar-wrap").css("height", "auto");
      }
    });
  }
});

/*................
 ====> Gallery 
 .................*/

 $(".gallery-item").magnificPopup({
  type: "image",
  gallery: {
    enabled: true,
  },
});

/*................
 ====> Pre Loader 
 .................*/

 var preloader = document.getElementById("loading");

 function myFunction() {
   preloader.style.display = "none";
 }




