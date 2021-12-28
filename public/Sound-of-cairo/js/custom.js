$(document).ready(function(){


// lofin register modal 


$('#open_login_modal').on('click', function() {
   $('#loginModal').modal({backdrop: 'static', keyboard: false}, 'show');
   $('#loginModal').addClass("show");
   $('#loginModal').css('display' , 'block');

});



$('#register_btn_loginPage').on('click', function() {

   $('#loginModal').modal('hide');
    $('#RegisterModal').modal('show');

});




// tabs hide show js ----------------------
  setTimeout(function(){
              $('.explore-tab-2-area').addClass('d-none'); 
              $('.explore-tab-3-area').addClass('d-none'); 
        },500); 
$('.tab-item').on('click', function() {
    $('.tab-item').removeClass('active');
    $(this).addClass('active');
});
$('.explore-tab-1').on('click', function() {
    $('.explore-tab-1-area').removeClass('d-none');
    $('.explore-tab-2-area').addClass('d-none');
    $('.explore-tab-3-area').addClass('d-none');
});
$('.explore-tab-2').on('click', function() {
    $('.explore-tab-2-area').removeClass('d-none');
    $('.explore-tab-1-area').addClass('d-none');
    $('.explore-tab-3-area').addClass('d-none');
});
$('.explore-tab-3').on('click', function() {
    $('.explore-tab-1-area').addClass('d-none');
    $('.explore-tab-2-area').addClass('d-none');
    $('.explore-tab-3-area').removeClass('d-none');
});

// slick slider js 	-------------------------
   // $(".regular1").slick({
   //      dots: false,
   //      infinite: true,
   //      slidesToShow: 6,
   //     //  prevArrow: false,
   //     // nextArrow: false,
   //      // autoplay:true,
   //      //   infinite: true,
   //      //  speed: 300,
   //       // variableWidth: true,
   //       // dots: true,
   //      // centerMode: true,
   //      navs:false,
   //      slidesToScroll: 3
   //    });
   $('.regular1').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 6,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 3,
      }
    },
  
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

   $(".regular2").slick({
        dots: false,
        infinite: true,
        slidesToShow: 5,
        navs:false,
        slidesToScroll: 3
      });
   $(".regular3").slick({
        dots: false,
        infinite: true,
        slidesToShow: 6,
        navs:false,
        slidesToScroll: 3
      });
   
  }); 
