jQuery(document).ready(function($) {
    $site_inner = $('.site-inner');
    /* animation for local menu */
    $site_inner.on('click', '.jma-local-menu  li  a', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $(this.hash).offset().top - 180
        }, 500);

    });


    $window = $(window);

    //add class for verical side menu (mobile)
    //$('body .jma-gbs-mobile-panel ul.sf-menu').addClass('sf-vertical');

    $('.site-container ul.sf-menu').superfish({
        /*animation: {
            height: 'show'
        }, */ // slide-down effect without fade-in

        //reverse direstion of flyout when space is limited
        onBeforeShow: function() {
            var windowWidth;
            windowWidth = $(window).width();
            var parentWidth = 0;
            $ul = $(this);
            var parentLi = $ul.parent();
            if (!this.is('.sf-js-enabled>li>ul')) {
                parentWidth = parentLi.width();
            }
            var subMenuWidth = $ul.width();
            var subMenuRight = parentLi.offset().left + parentWidth + subMenuWidth;
            if (subMenuRight > windowWidth) {
                $ul.closest('li').addClass('reverse');
                $ul.css({
                    'left': 'auto',
                    'right': parentWidth + 'px'
                });
            } else {
                $ul.closest('li').removeClass('reverse');
                $ul.css({
                    'left': '',
                    'right': ''
                });
            }

        },
        delay: 600 // 0.6 second delay on mouseout
    });

    $('.jma-panel-button a').click(function() {
        $('body').toggleClass('open');
    });

    var navVert = parseInt($('body').css('padding-top'), 10);
    $navbar = $('.site-container').find('.site-header').find('.nav-primary');
    //clone the sticky menu
    $sticky_menu = $navbar.clone(true).prependTo(".site-container");
    //clone the mobile menu
    $navbar.clone(true).prependTo(".jma-gbs-mobile-panel").find('ul.sf-menu').addClass('sf-vertical');

    function stickmainmenutotop() {
        window_top = $window.scrollTop();
        $wpadminbar = $('#wpadminbar');


        admin_height_adjust = $wpadminbar.length && $wpadminbar.css('position') == 'absolute' ? $wpadminbar.height() : 0;
        admin_height = $wpadminbar.length && $wpadminbar.css('position') == 'fixed' ? $wpadminbar.height() : 0;

        if (($('.site-header').height() - 100) < $('body').height()) {
            $sticky_menu.width($('.site-header').find('.jma-gbs-inner').outerWidth());
            if (window_top > navVert) {
                $sticky_menu.addClass('fixed');
                $sticky_menu.css('top', admin_height + 'px');
            } else {
                $sticky_menu.removeClass('fixed');
                $sticky_menu.css('top', '');
            }
        }


        padding_top = parseInt($('.site-inner').css('padding-top'), 10);
        sticky_menu_height = $sticky_menu.css('display') == 'block' ? $sticky_menu.height() : 0;
        //console.log(admin_height);
        if (window_top > $('.site-header').outerHeight() + admin_height_adjust + padding_top - sticky_menu_height) {
            if ($('.jma-local-menu').length) {
                $jma_local_menu = $('.jma-local-menu');
                $jma_local_menu.addClass('fix-local');
                console.log(admin_height + '+' + sticky_menu_height);
                $jma_local_menu.css({
                    'top': (admin_height + sticky_menu_height) + 'px'
                });
            }
            if ($('body.sticky').length) {
                $sticky_menu.addClass('push-forward');
                $sticky_menu.css('z-index', 35);
            }
        } else {
            if ($('.jma-local-menu').length) {
                $jma_local_menu = $('.jma-local-menu');
                $jma_local_menu.removeClass('fix-local');
                $jma_local_menu.css('top', '');
            }
            if ($('body.sticky').length) {
                $.when($sticky_menu.removeClass('push-forward')).then(function() {
                    $sticky_menu.css('z-index', '').delay(400);
                });

            }
        }

    }


    function menuadjust() {
        //gives us a 20px cushion
        necessary_menu_width = 20;
        //$primary_nav is the <nav> element
        $primary_nav = $('.site-header').find('.nav-primary');
        $positioned = $primary_nav.children();

        $wrapping_col = $primary_nav.closest('.wp-block-uagb-column');
        //check to see if menu is in a column
        if ($wrapping_col.length) {
            //find the space our menu needs before wrapping
            $primary_nav.find('.sf-menu >li').each(function() {
                necessary_menu_width += $(this).outerWidth();
            });
            //use the sibling because they will not be altered
            sibling_width = 0;
            $wrapping_col.siblings('.wp-block-uagb-column').each(function() {
                sibling_width += $(this).outerWidth();
            });
            //$wrapping_cols spans the content section
            $wrapping_cols = $wrapping_col.parent();
            //in the math below we will "invert" the sibling persent to get a
            //stable value to the parent column percent
            sibling_percent = sibling_width / $wrapping_cols.width();
            target_cols_width = (necessary_menu_width * (1 / (1 - sibling_percent)));
            //change the wrap display from flex to block (and back)
            //expand menu wrap and give some top padding

            if (target_cols_width > $wrapping_cols.width()) {
                $positioned.removeClass('jma-positioned');
                $wrapping_cols.css('flex-wrap', 'wrap');
                $wrapping_col.css({
                    'width': '100%',
                    'padding-top': '10px'
                });
            } else {
                $positioned.addClass('jma-positioned');
                $wrapping_cols.css('flex-wrap', '');
                $wrapping_col.css({
                    'width': '',
                    'padding-top': ''
                });
            }
        }
    }
    $window.load(function() {
        stickmainmenutotop();
        menuadjust();
    });

    $window.scroll(function() {
        stickmainmenutotop();
    });

    $window.resize(function() {
        menuadjust();
        $('body').removeClass('open');
    });

});