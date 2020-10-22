jQuery(document).ready(function($) {
    $('.jma-scroll-to-top, .jma-scroll-to-top a').click(function(event) {
        event.preventDefault();
        $("html").animate({
            scrollTop: 0
        });
    });
    //search form
    function jma_gbs_open_search() {
        document.getElementById("jma_gbs_search_overlay").classList.add('open');
    }

    function jma_gbs_close_search() {
        document.getElementById("jma_gbs_search_overlay").classList.remove('open');
    }
    $('.jma-gbs-open-search, .jma-gbs-open-search a').each(function() {
        $(this).click(function(e) {
            e.preventDefault();
            jma_gbs_open_search();
        });
    });
    $('.jma-gbs-close-search, .jma-gbs-close-search a').each(function() {
        $(this).click(function(e) {
            e.preventDefault();
            jma_gbs_close_search();
        });
    });


    $site_inner = $('.site-inner');
    /* animation for local menu   */
    $site_inner.on('click', '.jma-local-menu  li  a', function(event) {
        event.preventDefault();
        scrollTopVal = $(this.hash).offset().top - 180;
        if ($(this).closest('li').hasClass('jma-scroll-to-top'))
            scrollTopVal = 0;
        $('html, body').animate({
            scrollTop: scrollTopVal
        }, 500);

    });


    $window = $(window);

    //add class for verical side menu (mobile)
    $('body .jma-gbs-mobile-panel ul.sf-menu').addClass('sf-vertical');

    $('.site-container ul.sf-menu, .jma-gbs-mobile-panel ul.sf-menu').superfish({

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

    var navVert = parseInt($('body').css('padding-top'), 10) + parseInt($('#site-header').css('padding-top'), 10);
    $navbar = $('.site-container').find('.site-header').find('.nav-primary');

    //clone the sticky menu
    $sticky_menu = $navbar.clone(true).prependTo(".site-container").addClass('sticky-menu');

    //add items from header to mobile (side) menu
    $('.add-to-panel').each(function() {
        $('<div/>', {
            style: 'clear:both'
        }).appendTo('#jma-gbs-mobile-panel');
        $this = $(this);
        if ($this.find('.uagb-columns__inner-wrap').length)
            $this.find('.uagb-columns__inner-wrap').find('.uagb-column__inner-wrap').each(function() {
                $(this).clone(true).appendTo('#jma-gbs-mobile-panel');
            });
        else
            $this.clone(true).appendTo('#jma-gbs-mobile-panel');
    });

    //add logo to sticky menu
    if ($sticky_menu && $('#site-header').data('sticky-header')) {
        $sticky_menu.addClass('has-image');
        $sticky_menu.find('.outer').prepend($('<a>', {
            href: window.location.protocol + '//' + window.location.host
        }).prepend($("<img>", {
            src: $('#site-header').data('sticky-header'),
        })));
    }
    //clone the mobile menu
    if ($('body').hasClass('default_moble_menu'))
        $navbar.clone(true).prependTo(".jma-gbs-mobile-panel").find('ul.sf-menu').addClass('sf-vertical');

    //handle the sticky menu position and the local menu
    function stickmainmenutotop() {
        window_top = $window.scrollTop();
        $wpadminbar = $('#wpadminbar');

        $sticky_menu.width($('.site-header').find('.jma-gbs-inner').outerWidth());
        admin_height = $wpadminbar.length && $wpadminbar.css('position') == 'fixed' ? $wpadminbar.height() : 0;
        if (($('.jma-gbs-mobile-panel').css('display') == 'none') && ($('.site-header').height() - 100) < $('body').height()) {
            if (window_top > navVert) {
                $sticky_menu.addClass('fixed');
                if (!$('body.sticky-header').length)
                    $sticky_menu.css('top', admin_height + 'px');
            } else {
                $sticky_menu.removeClass('fixed');
                $sticky_menu.css('top', '');
            }
        }


        sticky_menu_height = $sticky_menu.css('display') == 'block' ? $sticky_menu.outerHeight() : 0;
        pos = $('.site-inner').position();
        boxed_adjust = $('.gbs-boxed-content').length ? -20 : 0;

        //time to display local menu and sticky menu
        if (window_top > pos.top - parseInt($('body').css('padding-top'), 10) - sticky_menu_height - admin_height + parseInt($('.site-inner').css('margin-top'), 10)) {
            //local
            if ($('.jma-local-menu').length) {
                $jma_local_menu = $('.jma-local-menu');
                $jma_local_menu.addClass('fix-local');

                $jma_local_menu.css({
                    'top': (admin_height + sticky_menu_height) + 'px'
                });
            }
            //sticky menu when stick header is used

            if (($('.jma-gbs-mobile-panel').css('display') == 'none') && $('body.sticky-header').length) {
                $sticky_menu.addClass('push-forward');
                $sticky_menu.css('top', admin_height + 'px');
            }
        } else {
            //undue local
            if ($('.jma-local-menu').length) {
                $jma_local_menu = $('.jma-local-menu');
                $jma_local_menu.removeClass('fix-local');
                $jma_local_menu.css('top', '');
            }
            //undue sticky menu when stick header is used
            if ($('body.sticky-header').length) {
                $sticky_menu.removeClass('push-forward');
                $sticky_menu.css('top', '');

            }
        }

    }

    //make the menu slide under logo (presumably) when screen is too narrow
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
                $this = $(this);
                //don't include hidden elements in calculation
                if ($this.css('display') != 'none')
                    necessary_menu_width += $this.outerWidth();
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
        stickmainmenutotop();
        menuadjust();
        $('body').removeClass('open');
    });

});