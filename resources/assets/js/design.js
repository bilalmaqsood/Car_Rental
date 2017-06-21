jQuery(document).ready(function ($) {

    $(window).scroll(function () {
        if ($(".navbar").offset().top > 50) {
            $(".navbar-fixed-top").addClass("top-nav-collapse");
        } else {
            $(".navbar-fixed-top").removeClass("top-nav-collapse");
        }
    });

    $(document).on('click', 'a.page-scroll', function (event) {
        let $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    $(".owl-slider").owlCarousel({
        items: 1,
        lazyLoad: true,
        navigation: false,
        margin: 0
    });
});
