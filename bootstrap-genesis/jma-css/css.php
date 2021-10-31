<?php

/*
@media queries - ie 'query' => '(min-width:768px)', - translates to:
@media(min-width:768px)
identical queries will be combined at output

(min-width:768px) = tablets and desktops
(max-width:767px) = phones
(min-width:992px) = desktops
(max-width:991px) = tablets and phones
(min-width:768px) and (max-width:991px) = tablets

omit the query element to target all
*/

$mods = array();
$mods = jma_gbs_get_theme_mods('jma_gbs_');

global $families;
$site_width = $mods["site_width"];
/*
handle header and footer options
*/
$header_footer = array("header", "footer");
foreach ($header_footer as $value) {
    // code...
    ${$value . '_width_array'} = array('max-width' => $site_width . "px");
    ${$value . '_appearence_array'} = array(
        "background-color" => $mods["{$value}_bg_color"],
        "color" => $mods["{$value}_font_color"]
);

    if ($mods["modular_{$value}"]) {
        ${$value . '_width_array'}["selector"] = ${$value . '_appearence_array'}["selector"] = ".site-{$value} .jma-gbs-inner, .jma-sticky-menu.fixed .outer";
        ${$value . '_appearence_array'}["border-radius"] = $mods["{$value}_border_radius"] . "px";
        if ($mods["{$value}_border_width"]) {
            ${$value . '_appearence_array'}["border-style"] = "solid";
            ${$value . '_appearence_array'}["border-width"] = $mods["{$value}_border_width"] . "px";
            ${$value . '_appearence_array'}["border-color"] = $mods["{$value}_border_color"];
        }
    } else {
        ${$value . '_appearence_array'}["selector"] = ".site-{$value}";
        ${$value . '_width_array'}["selector"] = ".site-{$value} .jma-gbs-inner > *, .site-{$value} .jma-gbs-inner .navbar div, .jma-sticky-menu.fixed .outer";
    }
}
/*
handle content options
*/
$content_width_array = array('selector' => '.site-inner > .jma-gbs-inner', 'max-width' => ($site_width) . 'px');
$content_appearence_array = array(
    'selector' => '.site-inner .row',
    'background-color' => $mods['page_bg']
);
$content_appearence_array["border-radius"] = $mods["frame_border_radius"] . "px";
if ($mods['frame_border_width'] && $mods['frame_content']) {
    $content_appearence_array["border-style"] = "solid";
    $content_appearence_array["border-width"] = $mods["frame_border_width"] . "px";
    $content_appearence_array["border-color"] = $mods["frame_border_color"];
}
if ($mods['body_shape'] == 'gbs-full-content') {
    if (!$mods['frame_content']) {
        $content_width_array['max-width'] = ($site_width +30) . 'px';
        $content_appearence_array['selector'] = '.site-inner';
    } else {
        $content_appearence_array['selector'] = '.site-inner > .jma-gbs-inner';
        $content_width_array['padding-left'] = '15px';
        $content_width_array['padding-right'] = '15px';
    }
}
if ($mods['body_shape'] == 'gbs-modular-content') {
    $content_appearence_array['selector'] = '.site-inner .content-sidebar-wrap .jma-gbs-inner';
    $content_width_array['max-width'] = ($site_width +30) . 'px';
}
if ($mods['body_shape'] == 'gbs-boxed-content') {
    $content_appearence_array['selector'] = '.site-inner';
    $content_width_array['selector'] = '.site-container';
    $content_width_array['max-width'] = ($site_width) . 'px';
}
/*
handle menu options
*/

$menu_bg_color_selector ='.navbar, ul.nav ul, .jma-gbs-mobile-panel';
$menu_current_bg_color_selector = 'ul.nav li[class*="current"] > a, ul.nav li.current-menu-item > a:hover, ul.nav li.current-menu-item > a:focus';
$menu_hover_bg_color_selector = 'ul.nav li  a:hover, ul.nav li  a:focus';

$menu_root_values = array(
    'selector' => 'ul.nav > li > a',
    'padding' => $mods['menu_vertical_padding'] . 'px ' . $mods['menu_horizontal_padding'] . 'px',
);

$menu_root_non_bg_dividers = array();
$fixed_root_bg = jma_gbs_get_trans($mods['menu_bg_color'], 0.9);
$menu_root_values_color = isset($mods['menu_root_font_color']) && $mods['menu_root_font_color'] && !$mods['use_menu_root_bg']? $mods['menu_root_font_color']:$mods['menu_font_color'];

//no root background
if (!$mods['use_menu_root_bg']) {
    $menu_bg_color_selector = 'ul.nav ul, .jma-gbs-mobile-panel';
    $menu_current_bg_color_selector = 'ul.nav ul li[class*="current"] > a, ul.nav ul li.current-menu-item > a:hover, ul.nav ul li.current-menu-item > a:focus';
    $menu_hover_bg_color_selector = 'ul.nav ul li  a:hover, ul.nav ul li  a:focus';

    $fixed_root_bg = jma_gbs_get_trans($mods['header_bg_color'], 0.9);
    $menu_root_values['color'] = $menu_root_values_color;
    $menu_root_hover_font_color = isset($mods['menu_root_hover_font_color']) && $mods['menu_root_hover_font_color']? $mods['menu_root_hover_font_color']: $mods['menu_hover_font_color'];

    $menu_root_current_font_color = isset($mods['menu_root_current_font_color']) && $mods['menu_root_current_font_color']? $mods['menu_root_current_font_color']: $mods['menu_current_font_color'];


    $menu_root_non_bg_dividers = array(
        'query' => '(min-width:768px)',
        'selector' => '.jma_gbs_non_use_menu_root_bg .sf-menu > li > a:before',
        'border-color' => $menu_root_values_color
    );
} else {
    //with root background
    $menu_root_values['border-left-color'] = $menu_root_values_color;
}
/* add supplemental_arrays beginning with the arrays creaated above
for conditional items */

$supplemental_arrays = array($menu_root_values, $menu_root_non_bg_dividers, $header_width_array, $content_width_array, $footer_width_array, $header_appearence_array, $content_appearence_array, $footer_appearence_array);

if (isset($mods['title_size_adjust']) && $mods['title_size_adjust']) {
    $titles = array('h1'=> 2.5,'h2'=> 2,'h3'=> 1.75,'h4'=> 1.5,'h5'=> 1.25,'h6'=> 1);
    foreach ($titles as $sel => $size) {
        if ($mods['title_size_adjust'] != 100) {
            $supplemental_arrays[] = array(
            'selector' => $sel,
            'font-size' => ($size * ($mods['title_size_adjust']/100)) . 'rem'
        );
        }
        //smaller titles on mobile
        $supplemental_arrays[] = array(
            'query' => '(max-width:991px)',
            'selector' => $sel,
            'font-size' => ($size * ($mods['title_size_adjust']/133.33)) . 'rem'
        );
    }
}

if ($mods['body_shape'] == 'gbs-full-content' && !$mods['frame_content']) {
    $supplemental_arrays[] = array(
        'selector' => '.jma_gbs_full_block .entry-header',
        'max-width' => ($mods['site_width'] + 30) . 'px',
    );
}
$menu_border_attribute = $menu_current_border_value = $menu_hover_border_value = null;
if (!$mods['use_menu_root_bg']) {
    if ($mods['menu_highlight']) {
        $menu_border_attribute = 'border-' . $mods['menu_highlight'] . '-color';
        $menu_current_border_value = $menu_root_current_font_color;
        $menu_hover_border_value = $menu_root_hover_font_color;
    }
    $supplemental_arrays[] = array(
        'query' => '(min-width:768px)',
        'selector' => 'ul.nav > li[class*="menu-item"] > a:hover',
        'color' => $menu_root_hover_font_color,
        $menu_border_attribute => $menu_hover_border_value
    );
    $supplemental_arrays[] = array(
        'query' => '(min-width:768px)',
        'selector' => 'ul.nav > li[class*="current"] > a, ul.nav > li[class*="current"] > a, ul.nav > li.current-menu-item > a:hover, ul.nav > li.current-menu-item > a:focus',
        'color' => $menu_root_current_font_color,
        $menu_border_attribute => $menu_current_border_value
    );
    $supplemental_arrays[] = array(
        'query' => '(min-width:768px)',
        'selector' => 'ul.nav li li[class*="current"] > a, ul.nav li li[class*="current"] > a, ul.nav li li.current-menu-item > a:hover, ul.nav li li.current-menu-item > a:focus',
        'color' => $mods['menu_current_font_color']
    );
}else{
    $supplemental_arrays[] = array(
        'query' => '(min-width:768px)',
        'selector' => 'ul.nav  li[class*="current"] > a, ul.nav  li[class*="current"] > a, ul.nav  li.current-menu-item > a:hover, ul.nav  li.current-menu-item > a:focus',
        'color' => $mods['menu_current_font_color']
    );
}
if (isset($mods['menu_desktop_horizontal_padding']) && $mods['menu_desktop_horizontal_padding']) {
    $supplemental_arrays[] = array(
        'query' => '(min-width:900px) and (max-width:1200px)',
        'selector' => 'ul.nav > li > a',
        'padding-right' =>  $mods['menu_desktop_horizontal_padding'] . 'px',
        'padding-left' =>  $mods['menu_desktop_horizontal_padding'] . 'px'
    );
}
if (isset($mods['menu_desktop_font_size']) && $mods['menu_desktop_font_size']) {
    $supplemental_arrays[] = array(
        'query' => '(min-width:900px) and (max-width:1200px)',
        'selector' => 'ul.nav li  a',
        'font-size' =>  $mods['menu_desktop_font_size']
    );
}
if (isset($mods['menu_tablet_horizontal_padding']) && $mods['menu_tablet_horizontal_padding']) {
    $supplemental_arrays[] = array(
        'query' => '(max-width:899px)',
        'selector' => 'ul.nav > li > a',
        'padding-right' =>  $mods['menu_tablet_horizontal_padding'] . 'px',
        'padding-left' =>  $mods['menu_tablet_horizontal_padding'] . 'px'
    );
}
if (isset($mods['menu_tablet_font_size']) && $mods['menu_tablet_font_size']) {
    $supplemental_arrays[] = array(
        'query' => '(max-width:899px)',
        'selector' => 'ul.nav li  a',
        'font-size' =>  $mods['menu_tablet_font_size']
    );
}
/*
begin main array
*/

$main_family = $mods['site_font_family'] != 'custom'? $families[$mods['site_font_family']]: str_replace('\'', '"', $mods['site_custom_font_family']);
$title_family = $mods['site_title_font_family'] != 'custom'? $families[$mods['site_title_font_family']]: str_replace('\'', '"', $mods['site_custom_title_font_family']);
$bg_darker_hex_footer = jma_gbs_first_is_lighter($mods['footer_bg_color'], $mods['footer_font_color'])? $mods['footer_font_color']: $mods['footer_bg_color'];

$css = array(

    array(
        //'query' => '(min-width:768px)',
        'selector' => $menu_bg_color_selector,
        'background-color' => $mods['menu_bg_color'],
    ),
    array(
        'selector' => 'ul.nav a, body .jma-gbs-mobile-panel ul li a , body .jma-gbs-mobile-panel .add-to-panel *, body .jma-gbs-mobile-panel .add-to-panel * a',
        'color' => $mods['menu_font_color']
    ),
    array(
        'query' => '(min-width:768px)',
        'selector' => 'ul.nav a',
        'font-size' => $mods['menu_font_size']
    ),
    array(
        'query' => '(min-width:768px)',
        'selector' => 'ul.nav li[class*="menu-item"] a:hover',
        'color' => $mods['menu_hover_font_color'],
    ),
    array(
        'query' => '(min-width:768px)',
        'selector' => $menu_current_bg_color_selector,
        'background-color' => $mods['menu_current_bg_color'],
    ),
    array(
        'query' => '(min-width:768px)',
        'selector' => $menu_hover_bg_color_selector,
        'background-color' => $mods['menu_hover_bg_color'],
    ),
    array(
        'query' => '(min-width:768px)',
        'selector' => '.navbar-static-top.fixed ul ul',
        'background-color' => jma_gbs_get_trans($mods['menu_bg_color'], 0.9),
    ),
    array(
        'selector' => '.navbar-static-top.fixed',
        'background-color' => $fixed_root_bg,
    ),

    array(
        'selector' => '.site-container > ul.nav, .site-header > .jma-gbs-inner > .navbar > .outer',
        'max-width' => $mods['site_width'] . 'px',
    ),

    array(
        'selector' => '.banner-wrap .entry-title',
        'max-width' => ($mods['site_width'] + 40) . 'px',
    ),
    array(
        'selector' => 'h1,h2,h3,h4,h5,h6',
        'font-family' => $title_family,
        'color' => $mods['site_title_color']
    ),
    /* don't apply the link font color in header */
    array(
        'selector' => '.site-header a',
        'color' => $mods['header_font_color']
    ),

    array(
        'selector' => 'body',
        'color' => $mods['site_font_color'],
        'font-size' => $mods['site_font_size'],
        'font-family' => $main_family,
        'background-color' => $mods['site_bg']
    ),
    array(
        'selector' => 'a',
        'color' => $mods['site_font_link_color']
    ),
    array(
        'selector' => 'a:hover',
        'color' => $mods['site_font_link_hover_color']
    ),
    array(
        'selector' => 'button, html input[type="button"], input[type="reset"], input[type="submit"], a.gbs-btn, .btn-default, body .jma-gbs-pagination-numeric li a, .wp-block-button__link, .wp-block-button__link:visited',
        'color' => $mods['button_font'],
        'border-color' => $mods['button_font'],
        'padding' => $mods['button_vert_padding'] . 'px ' . $mods['button_hor_padding'] . 'px',
        'font-size' => $mods['button_font_size'] . 'px',
        'border-radius' => $mods['button_border_radius'] . 'px',
        'border-width' => $mods['button_border_width'] . 'px',
        'background-color' => $mods['button_back'],
    ),
    array(
        'selector' => 'button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, a.gbs-btn:hover, .btn-default:hover, body .jma-gbs-pagination-numeric li a:hover, .wp-block-button__link:hover',
        'color' => $mods['button_font_hover'],
        'border-color' => $mods['button_font_hover'],
        'background-color' => $mods['button_back_hover'],
    ),
    array(
        'selector' => 'body .uagb-post-grid .uagb-post-pagination-wrap .page-numbers',
        'color' => $mods['button_font'],
        'border-color' => $mods['button_font'],
        'font-size' => $mods['button_font_size'] . 'px',
        'border-radius' => $mods['button_border_radius'] . 'px',
        'border-width' => $mods['button_border_width'] . 'px',
        'background-color' => $mods['button_back'],
    ),
    array(
        'selector' => 'body .uagb-post-grid .uagb-post-pagination-wrap .page-numbers:hover',
        'color' => $mods['button_font_hover'],
        'border-color' => $mods['button_font_hover'],
        'background-color' => $mods['button_back_hover'],
    ),
    array(
        'selector' => '.comment-list .children li.comment',
        'border-color' => $bg_darker_hex_footer
    ),
    array(
        'selector' => '.site-footer a, .jma-local-menu a',
        'color' => $mods['footer_font_color']
    ),
    array(
        'selector' => 'html, .jma-local-menu a',
        'background-color' => $mods['footer_bg_color']
    ),
    array(
        'selector' => '.jma-local-menu a:hover',
        'color' => $mods['footer_bg_color']
    ),
    array(
        'selector' => '.site-inner a.overlay',
        'background-color' => $mods['page_bg']
    ),
    array(
        'selector' => '.site-inner a.overlay:hover',
        'background-color' => $bg_darker_hex_footer
    ),
    array(
        'selector' => '.site-inner a.overlay:hover:after',
        'color' => $bg_darker_hex_footer
    )
);

/*
add back content and {$value} and footer options    $bg_darker_hex_footer
*/

foreach ($supplemental_arrays as $supplemental_array) {
    $css[] = $supplemental_array;
}
$css = apply_filters('jma_gbs_css_array', $css, $mods);
//print_r($css);
