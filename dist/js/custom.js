jQuery(document).ready(function($) {



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
            $wrapping_col = $primary_nav.closest('.wp-block-uagb-column');
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
                $wrapping_cols.css('display', 'block');
                $wrapping_col.css({
                    'width': '100%',
                    'padding-top': '10px'
                });
            } else {
                $positioned.addClass('jma-positioned');
                $wrapping_cols.css('display', '');
                $wrapping_col.css({
                    'width': '',
                    'padding-top': ''
                });
            }
        }
    }







    $window = $(window);
    $window.load(function() {
        sticktothetop();
        menuadjust();
    });

    $window.scroll(function() {
        sticktothetop();
    });

    $window.bind('ghbresizeEnd', function() {

    });

    $window.resize(function() {
        menuadjust();
        $('body').removeClass('open');
        if (this.gbsresizeTO) clearTimeout(this.gbsresizeTO);
        this.gbsresizeTO = setTimeout(function() {
            $(this).trigger('ghbresizeEnd');
        }, 500);
    });

});