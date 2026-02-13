var $s = jQuery.noConflict();

/*Ativacao Hamburger Menu Icons*/
$s(document).ready(function () {
    $s(".regular").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: false,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-arrow-right"></i></button>',
        responsive: [{           
                breakpoint: 1024,            
                settings: {            
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                }
              }, {
                breakpoint: 600,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  infinite: true,
                }
              }]
            
    });

    $s('.regular').simpleLightbox();
});