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
    if ($('body').hasClass('default_moble_menu'))
        $navbar.clone(true).prependTo(".jma-gbs-mobile-panel").find('ul.sf-menu').addClass('sf-vertical').find('ul').css('display', 'none');
});


//handle the sticky menu position and the local menu

$site_body = jQuery('body');
site_body_pos = $site_body.offset();
wrapped_menu = 0;
sticky_menu_height = 0;
if (jQuery('.jma-sticky-menu').length) {
    $sticky_menu = jQuery('.jma-sticky-menu');
    sticky_menu_pos = $sticky_menu.offset();
    if ($sticky_menu.css('display') != 'none') sticky_menu_height = $sticky_menu.outerHeight();
    wrapped_menu = jQuery('.jma-ghb-featured-wrap .jma-sticky-menu').length;

    //if the menu is wrapped in the featured wrap then we need to to wrap the
    //menu to preserve structure of flex spacing (otherwise we can just used
    //next margin-top)
    if (wrapped_menu) {
        if (!jQuery('#jma-placeholder').length) {
            $sticky_menu.wrap(jQuery('<div/>', {
                style: "height:" + sticky_menu_height + "px;max-width:" + jQuery('.site-header .jma-gbs-inner').width() + "px;",
                id: 'jma-placeholder'
            }));
        }
    } else {
        if (!jQuery('#jma-placeholder-after').length) {
            $sticky_menu.after(jQuery('<div/>', {
                "class": "clearfix",
                id: 'jma-placeholder-after'
            }));
        }
    }
}

$visual_content = jQuery('.inner-visual');
visual_content_pos = $visual_content.offset();


function stickmainmenutotop() {
    var $ = jQuery.noConflict();
    window_scroll_top = $window.scrollTop();
    sticky_menu_height = 0;
    if (jQuery('.jma-sticky-menu').length) {
        if ($sticky_menu.css('display') != 'none') sticky_menu_height = $sticky_menu.outerHeight();

        if ($('.jma-gbs-mobile-panel').css('display') == 'none') {

            //sticky menu

            if (window_scroll_top > sticky_menu_pos.top - site_body_pos.top) {
                $sticky_menu.addClass('jma-fixed').css({
                    'top': site_body_pos.top + 'px',
                    'max-width': $('.site-header .jma-gbs-inner').width() + 'px',
                    'width': $('.site-header .jma-gbs-inner').width() + 'px'
                });
                //menu wrapped in featured
                if (wrapped_menu) {
                    $('#jma-placeholder').css({
                        'max-width': $('.site-header .jma-gbs-inner').width() + 'px',
                        'height': sticky_menu_height + 'px',
                    });
                } else {
                    //menu outside featured
                    $('#jma-placeholder-after').css('margin-top', sticky_menu_height + 'px');
                }
            } else {
                $sticky_menu.removeClass('jma-fixed').css({
                    'top': '',
                    'max-width': '',
                    'width': ''
                });
                //menu wrapped in featured
                if (wrapped_menu) {
                    $('#jma-placeholder').css({
                        'height': ''
                    });
                } else {
                    //menu outside featured
                    $('#jma-placeholder-after').css('margin-top', '');
                }
            }
        }

    }

    //sticky visual
    sticky_menu_adjust = wrapped_menu ? 0 : sticky_menu_height;
    if ($('.inner-visual.anchored').length) {

        if (window_scroll_top > visual_content_pos.top - (site_body_pos.top + sticky_menu_adjust)) {
            $visual_content.addClass('jma-fixed');
            $visual_content.css({
                'top': (site_body_pos.top + sticky_menu_adjust) + 'px',
                'max-width': $('.site-header .jma-gbs-inner').width() + 'px'
            });
        } else {
            $visual_content.removeClass('jma-fixed');
            $visual_content.css({
                'top': '',
                'max-width': ''
            });
        }
    }
    site_pos = $site_inner.position();

    //time to display local menu
    if ($('.jma-local-menu').length) {
        $jma_local_menu = $('.jma-local-menu');
        if ($('.jma-gbs-mobile-panel').css('display') != 'none') {
            sticky_menu_height = 0;
        }
        if (window_scroll_top > site_pos.top - parseInt($('body').css('padding-top'), 10) - sticky_menu_height - site_body_pos.top) {
            //local
            $jma_local_menu.addClass('fix-local');
            $jma_local_menu.css({
                'top': (site_body_pos.top + sticky_menu_height) + 'px'
            });
        } else {
            //undue local
            $jma_local_menu.removeClass('fix-local');
            $jma_local_menu.css('top', '');
        }
    }
}

$window.on('load', function() {
    stickmainmenutotop();
});

$window.on('scroll', function() {
    stickmainmenutotop();
});

$window.on('resize', function() {
    stickmainmenutotop();
    jQuery('body').removeClass('open');
});
