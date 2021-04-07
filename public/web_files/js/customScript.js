$(window).on('scroll', function() {
    const scrollValue = $(window).scrollTop();

    if (scrollValue > 140 && scrollValue < 200) {
        $('header').addClass('scrolled');
    } else if (scrollValue >= 200) {
        $('header').addClass('fixed');
    } else {
        $('header').removeClass('scrolled').removeClass('fixed');
    }
});



