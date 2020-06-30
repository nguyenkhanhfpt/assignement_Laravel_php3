$(document).ready(function(){
    $(".nav__search a").click(function(){
        $('.nav__box-search form').fadeToggle('slow');
    });

    $(".nav__cart").click(function(){
        $('.nav__cart-mini').fadeToggle();
    });
});


$(document).ready(function() {
    $(window).scroll(function() {
        var scroll = $(this).scrollTop();

        if(scroll > 150) {
            $('.nav__bottom').addClass(' scroll-down');
        }
        else {
            $('.nav__bottom').removeClass('scroll-down');
        }
    });
});