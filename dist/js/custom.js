jQuery(document).ready(function($) {
    $site_inner = $('.site-inner');

    $site_inner.on('click', '.jma-local-menu  li  a', function(event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $(this.hash).offset().top - 180
        }, 500);

    });

    if ($('.jma-local-menu').length) {
        $jma_local_menu = $('.jma-local-menu');
        jma_local_menu_offset = $jma_local_menu.offset().top;
    }

    $window = $(window);

    //add class for verical side menu (mobile)
    $('body .jma-gbs-mobile-panel ul.sf-menu').addClass('sf-vertical');

    $('.site-container ul.sf-menu').superfish({
        animation: {
            height: 'show'
        }, // slide-down effect without fade-in

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
            var subMenuRight = parentLi.window_top().left + parentWidth + subMenuWidth;
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
        delay: 800 // 0.8 second delay on mouseout
    });

    $('.jma-panel-button a').click(function() {
        $('body').toggleClass('open');
    });

    var navVert = parseInt($('body').css('padding-top'), 10);
    $navbar = $('.site-container').find('.site-header').find('.nav-primary');
    //clone the sticky menu
    $navbar.clone(true).prependTo(".site-container");
    //clone the mobile menu
    $navbar.clone(true).prependTo(".jma-gbs-mobile-panel").find('ul.sf-menu').addClass('sf-vertical');

    function sticktothetop() {
        window_top = $window.scrollTop();
        $wpadminbar = $('#wpadminbar');
        admin_bar_height = $wpadminbar.length ? $wpadminbar.height() : 0;
        //if (($('.site-header').height() + 100) > $('body').height()) {

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
        //}
        //header_adjustment = $body.hasClass('constrict-header') ? $top.height() + main_showing_by : main_showing_by;
        //console.log(window_top + '>' + ($('.site-header').height() - $sticky.height() - admin_bar_height));
        padding_top = parseInt($('.site-inner').css('padding-top'), 10);
        if (window_top > $('.site-header').outerHeight() + padding_top - $sticky.height() - admin_bar_height) {
            if ($('.jma-local-menu').length) {
                $jma_local_menu.addClass('fix-local');
                $jma_local_menu.css('margin-top', (admin_bar_height + $sticky.height()) + 'px');
            }
            if ($('body.sticky').length) {
                $sticky.addClass('push-forward');
                $sticky.css('z-index', 35);
            }
        } else {
            if ($('.jma-local-menu').length) {
                $jma_local_menu.removeClass('fix-local');
                $jma_local_menu.css('margin-top', '');
            }
            if ($('body.sticky').length) {
                $.when($sticky.removeClass('push-forward')).then(function() {
                    $sticky.css('z-index', '').delay(800);
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
        sticktothetop();
        menuadjust();
    });

    $window.scroll(function() {
        sticktothetop();
    });

    $window.resize(function() {
        menuadjust();
        $('body').removeClass('open');
    });

});