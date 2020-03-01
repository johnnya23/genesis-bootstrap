jQuery(document).ready(function($) {
    $('body .jma-gbs-mobile-panel ul.sf-menu').addClass('sf-vertical');
    $('ul.sf-menu').superfish({
        animation: {
            height: 'show'
        }, // slide-down effect without fade-in
        delay: 800 // 0.8 second delay on mouseout
    });

    $('.jma-panel-button a').click(function() {
        $('body').toggleClass('open');
    });

    var navVert = parseInt($('body').css('padding-top'), 10);
    $navbar = $('.site-container').find('.site-header').find('.nav-primary');
    $navbar.clone(true).prependTo(".site-container");
    $navbar.clone(true).prependTo(".jma-gbs-mobile-panel").find('ul.sf-menu').addClass('sf-vertical');

    function sticktothetop() {
        var window_top = $(window).scrollTop();
        $wpadminbar = $('#wpadminbar');

        admin_height_adjust = $wpadminbar.length && $wpadminbar.css('position') == 'fixed' ? $wpadminbar.height() + 'px' : 0;
        $sticky = $('.site-container >.nav-primary');
        $sticky.width($('.site-header').find('.jma-gbs-inner').outerWidth());
        if (window_top > navVert) {
            $sticky.addClass('fixed');
            $sticky.css('top', admin_height_adjust);
        } else {
            $sticky.removeClass('fixed');
            $sticky.css('top', '');
        }
    }

    $window = $(window);
    $window.load(function() {
        sticktothetop();
    });

    $window.scroll(function() {
        sticktothetop();
    });

    $window.bind('baseresizeEnd', function() {});

    $window.resize(function() {
        $('body').removeClass('open');
        if (this.gbsresizeTO) clearTimeout(this.gbsresizeTO);
        this.gbsresizeTO = setTimeout(function() {
            $(this).trigger('baseresizeEnd');
        }, 500);
    });
});