jQuery(document).ready(function($) {
    if( rb_localize_data.animation ){
        new WOW().init();
    }

    var winWidth = $(window).width();

    $(".skills").addClass("active");
    $(".skills .skill .skill-bar span").each(function() {
        $(this).animate({
            "width": $(this).parent().attr("data-bar") + "%"
        }, 1000);
        $(this).append('<b>' + $(this).parent().attr("data-bar") + '%</b>');
    });
    setTimeout(function() {
        $(".skills .skill .skill-bar span b").animate({ "opacity": "1" }, 1000);
    }, 2000);

    //script for responsive menu
    if (winWidth < 1025) {
        $('.main-navigation ul li.menu-item-has-children').append('<span class="submenu-toggle"><i class="fa fa-angle-down"></i></span>');
        $('.main-navigation ul li .submenu-toggle').click(function() {
            $(this).prev().slideToggle();
            $(this).toggleClass('active');
        });

        $('#primary-toggle-button').click(function() {
            $('.responsive-menu-holder').slideToggle();
            $('.site-header .header-t').toggleClass("bg-color");
            $(this).toggleClass("close");
        });
    }

    //custom scroll bar
    if( $('.widget_rrtc_description_widget').length ){
        $('.description').each(function(){ 
            var ps = new PerfectScrollbar($(this)[0]); 
        });
    }
    
    if( $('.filter-grid div.element-item').length > 0 ){
        var origin_left;
        if( rb_localize_data.rtl == '1' ){
            origin_left = false;
        }else{
            origin_left = true; 
        }

        // init Isotope
        var $grid = $('.filter-grid').imagesLoaded( function(){  

            $grid.isotope({
              isOriginLeft: origin_left,
            });
            
            // filter items on button click
            $('.filter-button-group').on( 'click', 'button', function() {
              $('.filter-button-group button').removeClass('is-checked');
              $(this).addClass('is-checked');
              var filterValue = $(this).attr('data-filter');
              $grid.isotope({ filter: filterValue });
          });

        });
    }

    //accessible menu in IE
    $("#site-navigation ul li a").focus(function(){
        $(this).parents("li").addClass("focus");
    }).blur(function(){
        $(this).parents("li").removeClass("focus");
   });

});