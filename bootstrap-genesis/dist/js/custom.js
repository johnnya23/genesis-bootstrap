$window = jQuery(window);

$site_inner = jQuery('.site-inner');

jQuery(document).ready(function($) {
    $('.jma-scroll-to-top, .jma-scroll-to-top a').on('click', function(event) {
        event.preventDefault();
        $("html").animate({
            scrollTop: 0
        });
    });


    //overlays
    $site_inner.find('a').each(function() {
        $this = $(this);
        href = $this.attr('href');
        if (typeof href != 'undefined')
            var extension = href.substr((href.lastIndexOf('.') + 1));
        lightbox = (extension == 'jpg' || extension == 'png') ? ' lightbox' : '';
        png = (extension == 'png') ? ' png' : '';
        external = (typeof $this.attr('target') != 'undefined' && $this.attr('target').length) && $this.attr('target') != '_self' ? ' external' : '';
        if (typeof $this.find('img') != 'undefined' && $this.find('img').length) {
            $this.addClass('overlay' + external + lightbox);
        }
    });


    //search form
    function jma_gbs_open_search() {
        document.getElementById("jma_gbs_search_overlay").classList.add('open');
    }

    function jma_gbs_close_search() {
        document.getElementById("jma_gbs_search_overlay").classList.remove('open');
    }
    $('.jma-gbs-open-search, .jma-gbs-open-search a').each(function() {
        $(this).on('click', function(e) {
            e.preventDefault();
            jma_gbs_open_search();
        });
    });
    $('.jma-gbs-close-search, .jma-gbs-close-search a').each(function() {
        $(this).on('click', function(e) {
            e.preventDefault();
            jma_gbs_close_search();
        });
    });


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


    //reverse direstion of flyout when space is limited
    $('.site-container ul.sf-menu, .jma-gbs-mobile-panel ul.sf-menu').superfish({

        onBeforeShow: function() {
            var windowWidth;
            windowWidth = $(window).width();
            var parentWidth = 0;
            $ul = $(this);
            var $parentLi = $ul.parent();
            if (!this.is('.sf-js-enabled>li>ul')) {
                parentWidth = $parentLi.width();
            }
            var subMenuWidth = $ul.width();
            subMenuRight = 0;
            if ($parentLi.length)
                var subMenuRight = $parentLi.offset().left + parentWidth + subMenuWidth;
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

    $('.jma-panel-button a').on('click', function() {
        $('body').toggleClass('open');
    });


    //add class for verical side menu (mobile)
    $('body .jma-gbs-mobile-panel ul.sf-menu').addClass('sf-vertical');


    //add items from header to mobile (side) menu
    $('.add-to-panel').each(function() {
        $('<div/>', {
            style: 'clear:both;padding-bottom: 15px'
        }).appendTo('#jma-gbs-mobile-panel');
        $this = $(this);
        if ($this.find('.wp-block-columns').length) {
            $this.find('.wp-block-columns').find('.wp-block-column').each(function() {
                $html = $(this).clone(true);
            });
        } else if ($this.find('.wp-block-getwid-section__content').length) {
            $html = $this.find('.wp-block-getwid-section__content');
        } else {
            $html = $this;
        }
        $('<div/>', {
            style: 'clear:both;padding-left: 15px;padding-right: 15px',
            html: $html
        }).appendTo('#jma-gbs-mobile-panel');
    });

    $navbar = $('.site-container').find('.site-header').find('.nav-primary');
    $sticky_class = 'sticky-menu';

    if ($('.sticky-menu-wrap').length) {
        $sticky_class += ' from-wrap';
        $navbar = $('.sticky-menu-wrap');
    }


    //clone the sticky menu
    $sticky_menu = $navbar.clone(true).prependTo(".site-container").addClass($sticky_class);


    //add logo to sticky menu
    if ($sticky_menu && $('#site-header').data('sticky-header') && !$('.sticky-menu-wrap').length) {
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
});


//handle the sticky menu position and the local menu
function stickmainmenutotop() {
    var $ = jQuery.noConflict();
    window_top = $window.scrollTop();
    $wpadminbar = $('#wpadminbar');
    $sticky_menu = $('.sticky-menu');

    $sticky_menu.width($('.site-header').find('.jma-gbs-inner').outerWidth());
    admin_height = $wpadminbar.length && $wpadminbar.css('position') == 'fixed' ? $wpadminbar.height() : 0;
    if (($('.jma-gbs-mobile-panel').css('display') == 'none') && ($('.site-header').height() - 100) < $('body').height()) {
        var navVert = parseInt($('body').css('padding-top'), 10) + parseInt($('#site-header').css('padding-top'), 10);
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
    pos = $site_inner.position();
    boxed_adjust = $('.gbs-boxed-content').length ? -20 : 0;

    //time to display local menu and sticky menu
    if (window_top > pos.top - parseInt($('body').css('padding-top'), 10) - sticky_menu_height - admin_height + parseInt($site_inner.css('margin-top'), 10)) {
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


//$primary_nav is the <nav> element
$primary_nav = jQuery('.site-header').find('.nav-primary');
$positioned = $primary_nav.children();

$wrapping_col = $primary_nav.closest('.wp-block-column');
$wrapping_cols = $wrapping_col.closest('.wp-block-columns');


//make the menu slide under logo (presumably) when screen is too narrow
function menuadjust() {
    //gives us a 20px cushion
    necessary_menu_width = 20;
    //check to see if menu is in a column
    if ($wrapping_col.length) {
        //find the space our menu needs before wrapping
        $primary_nav.find('.sf-menu >li, .mega-menu>li').each(function() {
            $this = jQuery(this);
            //don't include hidden elements in calculation
            if ($this.css('display') != 'none')
                necessary_menu_width += $this.outerWidth();
        });
        $wrapping_col.css('min-width', necessary_menu_width);
        wrapping_col_percent = parseFloat($wrapping_col.css('flex-basis'), 10);

    }
    if (necessary_menu_width > 20) {

        if (necessary_menu_width > (($wrapping_cols.width() * wrapping_col_percent) / 100)) {
            $positioned.removeClass('jma-positioned');
            $wrapping_cols.css('display', 'block');
            $wrapping_col.css({
                'width': 'inherit',
                'margin-top': '3px',
                'margin-left': '0'
            });
        } else {
            $positioned.addClass('jma-positioned');
            $wrapping_cols.css('display', '');
            $wrapping_col.css({
                'width': '',
                'margin-top': '',
                'margin-left': ''
            });
        }
    }
}


//duplicate menu for sticky header
if (jQuery('body').hasClass('sticky-header')) {
    if (!jQuery('.mega-menu-wrap').length) {
        $original_navbars = jQuery('body.sticky-header').find('.site-header').find('.nav');
    } else {
        $original_navbars = jQuery('body.sticky-header').find('.site-header').find('.nav-primary').find('#mega-menu-wrap-primary');
    }

    //clone the main menu ul(s)
    $double_menu = [];
    $original_navbars.each(function(i, x) {
        $this = jQuery(this);
        $double_menu[i] = $this.clone(true).prependTo(".site-container").addClass('double-menu');
        menu_pos = $this.offset();
        menu_top_pos = menu_pos.top - window.pageYOffset;
        //position the double(s)
        $double_menu[i].css({
            'top': menu_top_pos + 'px',
            'left': menu_pos.left + 'px',
            'width': ($this.width() + 1) + 'px',
            "opacity": 1,
            'position': 'fixed'
        });
    });

    menu_resize_pos();
}


//the diplicate menu for sticky headers
function menu_resize_pos() {
    $original_navbars.each(function(i, x) {
        $this = jQuery(this);
        menu_pos = $this.offset();
        menu_top_pos = menu_pos.top - window.pageYOffset;
        //position the double(s)
        $double_menu[i].css({
            'top': menu_top_pos + 'px',
            'left': menu_pos.left + 'px',
            'width': ($this.width() + 1) + 'px',
            "opacity": 1,
            'position': 'fixed'
        });
        site_pos = $site_inner.offset();
        if (menu_pos.top + $double_menu[i].height() > site_pos.top) {
            $double_menu[i].addClass('hide-double');
        } else {
            $double_menu[i].removeClass('hide-double');
        }
    });
}

$window.on('load', function() {
    if (jQuery('.jma-gbs-mobile-panel').css('display') == 'none' && jQuery('body').hasClass('sticky-header')) {
        menu_resize_pos();
    }
    stickmainmenutotop();
    menuadjust();
});

$window.on('scroll', function() {
    stickmainmenutotop();
    if (jQuery('.jma-gbs-mobile-panel').css('display') == 'none' && jQuery('body').hasClass('sticky-header')) {
        menu_resize_pos();
    }
});

$window.on('resize', function() {
    stickmainmenutotop();
    menuadjust();
    jQuery('body').removeClass('open');
    if (jQuery('.jma-gbs-mobile-panel').css('display') == 'none' && jQuery('body').hasClass('sticky-header')) {
        menu_resize_pos();
    }
});