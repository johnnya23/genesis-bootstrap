$window = jQuery(window);
window_scroll_top = $window.scrollTop();

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

    // $superselector to give the side menu superclick if necessary
    $superselector = $('.site-container ul.sf-menu, .jma-gbs-mobile-panel ul.sf-menu');
    if ($('body').hasClass('use_side_menu'))
        $superselector = $('.site-container ul.sf-menu');
    //reverse direstion of flyout when space is limited
    $superselector.superfish({

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

    if ($('body').hasClass('use_side_menu'))
        $('.jma-gbs-mobile-panel ul.sf-menu').superclick();

    $('.jma-panel-button button').on('click', function() {
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
        if ($this.find('.wp-block-getwid-section__content').length) {
            $html = $this.find('.wp-block-getwid-section__content').clone(true);
        } else if ($this.find('.kt-row-layout-inner').length) {
            $html = $this.find('.kt-row-column-wrap').clone(true);
        } else {
            $html = $this.clone(true);
        }
        $('<div/>', {
            style: 'clear:both;padding-left: 15px;padding-right: 15px',
            "class": 'add-to-panel',
            html: $html,
        }).appendTo('#jma-gbs-mobile-panel');
    });

    $navbar = $('.site-container').find('.site-header').find('.navbar-static-top');

    //clone the mobile menu
    if ($('body').hasClass('default_moble_menu')) {
        $navbar.clone(true).prependTo(".jma-gbs-mobile-panel").find('ul.sf-menu').addClass('sf-vertical mobile-menu').find('ul').css('display', 'none');
    }
    //helps the background display on what would have been focus
    $('.jma-gbs-mobile-panel a').on('click', function() {
        $(this).blur();
    });
});

//handle the sticky menu position and the local menu

$site_body = jQuery('body');
site_body_offset = $site_body.offset();
admin_bar_height = site_body_offset.top;
if (jQuery('#wpadminbar').css('position') == 'absolute')
    admin_bar_height = 0;
wrapped_menu = 0;
sticky_menu_height = 0;
if (jQuery('.jma-sticky-menu').length) {
    $sticky_menu = jQuery('.jma-sticky-menu');
    sticky_menu_offset = $sticky_menu.offset();
    if ($sticky_menu.css('display') != 'none') sticky_menu_height = $sticky_menu.outerHeight();

    wrapped_menu = jQuery('.jma-ghb-featured-wrap .jma-sticky-menu').length;

    //we need to to wrap the menu to preserve its height when it goes fixed
    if (!jQuery('#jma-placeholder').length) {
        $sticky_menu.wrap(jQuery('<div/>', {
            style: "min-height:" + sticky_menu_height + "px;",
            id: 'jma-placeholder'
        }));
    }
    handle_sticky_menu();
}

$visual_content = jQuery('.inner-visual');
visual_content_offset = $visual_content.offset();

function stickmainmenutotop() {
    var $ = jQuery.noConflict();
    window_scroll_top = $window.scrollTop();
    is_phone = $('.site-inner > .jma-gbs-inner').css('overflow-x') == 'hidden';
    resizing_sticky_menu_height = 0;

    //sticky menu
    if (jQuery('.jma-sticky-menu').length) {
        if ($sticky_menu.css('display') != 'none') resizing_sticky_menu_height = $sticky_menu.outerHeight();
        if ($sticky_menu.find('.navbar').css('display') != 'none') {
            handle_sticky_menu();
        }

    }

    //sticky visual
    sticky_menu_adjust = wrapped_menu ? 0 : resizing_sticky_menu_height;
    if (!is_phone && $('.inner-visual.anchored').length) {
        handle_sticky_visual();
    }

    //local menu
    jma_gbs_inner_offset = $site_inner.children('.jma-gbs-inner').offset();
    if ($('.jma-local-menu').length) {
        $jma_local_menu = $('.jma-local-menu');
        handle_local_menu();
    }
}

function handle_sticky_menu() {
    if (window_scroll_top > sticky_menu_offset.top - admin_bar_height) {
        $sticky_menu.addClass('jma-fixed').css({
            'top': admin_bar_height + 'px',
            'max-width': jQuery('.site-header .jma-gbs-inner').width() + 'px',
            'width': jQuery('.site-header .jma-gbs-inner').width() + 'px'
        });
        //menu wrapped in featured
        jQuery('#jma-placeholder').css({
            'max-width': jQuery('.site-header .jma-gbs-inner').width() + 'px',
            'min-height': sticky_menu_height + 'px',
        });
    } else {
        $sticky_menu.removeClass('jma-fixed').css({
            'top': '',
            'max-width': '',
            'width': ''
        });
    }
}

function handle_sticky_visual() {
    if (window_scroll_top > visual_content_offset.top - (admin_bar_height + sticky_menu_adjust)) {
        $visual_content.addClass('jma-fixed');
        $visual_content.css({
            'top': (admin_bar_height + sticky_menu_adjust) + 'px',
            'max-width': jQuery('.site-header .jma-gbs-inner').width() + 'px'
        });
    } else {
        $visual_content.removeClass('jma-fixed');
        $visual_content.css({
            'top': '',
            'max-width': ''
        });
    }

}

function handle_local_menu() {
    if (is_phone) resizing_sticky_menu_height = 0;
    if (window_scroll_top > jma_gbs_inner_offset.top - resizing_sticky_menu_height - admin_bar_height) {
        //local
        $jma_local_menu.addClass('fix-local');
        $jma_local_menu.css({
            'top': (admin_bar_height + resizing_sticky_menu_height) + 'px'
        });
    } else {
        //undue local
        $jma_local_menu.removeClass('fix-local');
        $jma_local_menu.css('top', '');
    }
}
$window.on('load scroll', function() {
    stickmainmenutotop();
});

$window.on('resize orientationchange', function() {
    if (jQuery('#wpadminbar').css('position') == 'absolute')
        admin_bar_height = 0;
    stickmainmenutotop();
    jQuery('body').removeClass('open');
});