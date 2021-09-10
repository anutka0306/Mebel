// выпадашки при наведении
jQuery('ul.navbar-nav > li').hover(function() {
    jQuery(this).find('.dropdown-menu-hover').stop(true, true).delay(200).css('display', 'flex');
}, function() {
    jQuery(this).find('.dropdown-menu-hover').stop(true, true).fadeOut();
});

//
jQuery(function($) {
    $(window).scroll(function(){
        if($(this).scrollTop()>150){
            $('.header_fix').addClass('show_block');
        }
        else if ($(this).scrollTop()<150){
            $('.header_fix').removeClass('show_block');
        }
    });
});

//masonry

    $(".grid").imagesLoaded(function() {
    $(".grid").masonry({
        itemSelector: ".grid-item"
    });
});

// изменение container на container-fluid
$(window).resize(function(e){
    if ($(window).width() < 1400) {
        $(".top-menu > .container").removeClass("container").addClass("container-fluid");
        $(".top-menu__fixed > .container").removeClass("container").addClass("container-fluid");
    }
    else if($(window).width() > 1400) {
        $(".top-menu > .container-fluid").removeClass("container-fluid").addClass("container");
        $(".top-menu__fixed > .container-fluid").removeClass("container-fluid").addClass("container");
    }
});

$( document ).ready(function() {
    /*Кнопка неверх*/
    let button = $('#button-up');
    $(window).scroll (function () {
        if ($(this).scrollTop () > 300) {
            button.fadeIn();
        } else {
            button.fadeOut();
        }
    });
    button.on('click', function(){
        $('body, html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    if ($(window).width() < 1400) {
        $(".top-menu > .container").removeClass("container").addClass("container-fluid");
        $(".top-menu__fixed > .container").removeClass("container").addClass("container-fluid");
    }
    else if($(window).width() > 1400) {
        $(".top-menu > .container-fluid").removeClass("container-fluid").addClass("container");
        $(".top-menu__fixed > .container-fluid").removeClass("container-fluid").addClass("container");
    }

    /* На мобилках - показать еще в разделе О нас*/
    $(".load-more-btn .loaded").css('display', 'none');
    $(".about__show-more").css('display', 'none');
    $(".unloaded").click(function (){
        $(".about__show-more").fadeIn();
        $(".load-more-btn .unloaded").css('display', 'none');
        $(".load-more-btn .loaded").css('display', 'flex');
    });
    $(".loaded").click(function (){
        $(".about__show-more").fadeOut();
        $(".load-more-btn .unloaded").css('display', 'flex');
        $(".load-more-btn .loaded").css('display', 'none');
    });

    /* Seo контент - показать еще*/

        $('.seo-btn').click(function(){
        $('.seo-btn').css('display','none');
        $('.seo-text-none').css('display','block');
    });

});

/* AOS*/
AOS.init({
    // Global settings:
    disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
    startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
    initClassName: 'aos-init', // class applied after initialization
    animatedClassName: 'aos-animate', // class applied on animation
    useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
    disableMutationObserver: false, // disables automatic mutations' detections (advanced)
    debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
    throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


    // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
    offset: 150, // offset (in px) from the original trigger point
    delay: 50, // values from 0 to 3000, with step 50ms
    duration: 400, // values from 0 to 3000, with step 50ms
    easing: 'ease', // default easing for AOS animations
    once: false, // whether animation should happen only once - while scrolling down
    mirror: false, // whether elements should animate out while scrolling past them
    anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});





