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

    function panel_adjust() {
        admin_bar_height = $('#wpadminbar').length ? $('#wpadminbar').height() + 'px' : 0;
        $('#mypanel').css('top', admin_bar_height);
    }

    $window = $(window);
    $window.load(function() {});

    $window.scroll(function() {});

    $window.bind('baseresizeEnd', function() {});

    $window.resize(function() {
        if (this.gbsresizeTO) clearTimeout(this.gbsresizeTO);
        this.gbsresizeTO = setTimeout(function() {
            $(this).trigger('baseresizeEnd');
        }, 500);
    });
});