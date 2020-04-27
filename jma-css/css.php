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

$mods = jma_gbs_get_theme_mods('jma_gbs_');

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

    if ($mods["modular_{$value}"] == "yes") {
        ${$value . '_width_array'}["selector"] = ${$value . '_appearence_array'}["selector"] = ".site-{$value} .jma-gbs-inner";
        ${$value . '_appearence_array'}["border-radius"] = $mods["{$value}_border_radius"] . "px";
        if ($mods["{$value}_border_width"]) {
            ${$value . '_appearence_array'}["border-style"] = "solid";
            ${$value . '_appearence_array'}["border-width"] = $mods["{$value}_border_width"] . "px";
            ${$value . '_appearence_array'}["border-color"] = $mods["{$value}_border_color"];
        }
    } else {
        ${$value . '_appearence_array'}["selector"] = ".site-{$value}";
        ${$value . '_width_array'}["selector"] = ".site-{$value} .jma-gbs-inner > *, .site-{$value} .jma-gbs-inner .navbar div";
    }
}
/*
handle content options
*/
$content_width_array = array('selector' => '.site-inner .row', 'max-width' => ($site_width +30) . 'px');
$content_appearence_array = array(
    'selector' => '.site-inner .row',
    'background-color' => $mods['page_bg']
);
$content_appearence_array["border-radius"] = $mods["frame_border_radius"] . "px";
if ($mods["frame_border_width"]) {
    $content_appearence_array["border-style"] = "solid";
    $content_appearence_array["border-width"] = $mods["frame_border_width"] . "px";
    $content_appearence_array["border-color"] = $mods["frame_border_color"];
}
if ($mods['body_shape'] == 'gbs-full-content') {
    //$content_width_array['max-width'] = ($site_width +30) . 'px';
    if (!$mods['frame_content']) {
        $content_appearence_array['selector'] = '.site-inner';
    } else {
        $content_width_array['padding-left'] = '15px';
        $content_width_array['padding-right'] = '15px';
    }
}
if ($mods['body_shape'] == 'gbs-modular-content') {
    $content_appearence_array['selector'] = '.site-inner .jma-gbs-inner';
    unset($content_appearence_array['max-width']);
}
if ($mods['body_shape'] == 'gbs-boxed-content') {
    $content_appearence_array['selector'] = '.site-container';
    $content_width_array['selector'] = '.site-container';
    $content_width_array['max-width'] = ($site_width) . 'px';
}
if ($mods['frame_content']) {
    $content_width_array['max-width'] = $site_width . 'px';
}
/*
handle menu options
*/

$menu_bg_color_selector ='.navbar, .site-container .navbar ul ul, .jma-gbs-mobile-panel';
$menu_bg_current_color_selector = '.nav  li[class*="current"] > a, .nav  li[class*="current"] > a, .nav  li.current-menu-item > a:hover, .nav  li.current-menu-item > a:focus';
$menu_bg_hover_color_selector = '.nav  li  a:hover, .nav  li  a:focus';
if (!$mods['use_menu_root_bg']) {
    $menu_bg_color_selector = '.site-container .navbar ul ul, .nav-primary.fixed, .jma-gbs-mobile-panel';
    $menu_bg_current_color_selector = '.nav-primary ul ul li[class*="current"] > a, .nav-primary ul ul li.current-menu-item > a:hover, .nav-primary ul ul li.current-menu-item > a:focus';
    $menu_bg_hover_color_selector = '.site-container .nav-primary ul ul li  a:hover, .site-container .nav-primary ul ul li  a:focus';
}

$menu_root_values = array(
    'selector' => '.site-header .nav > li > a',
    'padding' => $mods['menu_vertical_padding'] . 'px ' . $mods['menu_horizontal_padding'] . 'px',
);


if (!$mods['use_menu_root_bg']) {
    $menu_root_hover_font_color = isset($mods['menu_root_hover_font_color']) && $mods['menu_root_hover_font_color']? $mods['menu_root_hover_font_color']: $mods['menu_hover_font_color'];

    $menu_root_current_font_color = isset($mods['menu_root_current_font_color']) && $mods['menu_root_current_font_color']? $mods['menu_root_current_font_color']: $mods['menu_current_font_color'];


    $menu_root_values['color'] = $mods['header_font_color'];
}

/* add supplemental_arrays beginning with the arrays creaated above
for conditional items */

$supplemental_arrays = array($menu_root_values, $header_width_array, $content_width_array, $footer_width_array, $header_appearence_array, $content_appearence_array, $footer_appearence_array);


if ($mods['body_shape'] == 'gbs-full-content' && !$mods['frame_content']) {
    $supplemental_arrays[] = array(
        'selector' => '.jma_gbs_full_block .entry-header, .jma_gbs_full_block .entry-content>*',
        'max-width' => $mods['site_width'] . 'px',
    );
}
if (!$mods['use_menu_root_bg']) {
    $supplemental_arrays[] = array(
        'selector' => '.site-header .nav > li > a:hover',
        'color' => $menu_root_hover_font_color,
    );
    $supplemental_arrays[] = array(
        'selector' => '.site-header .nav > div > ul > li[class*="current"] > a, .site-header .nav > div > ul > li[class*="current"] > a, .site-header .nav > div > ul > li.current-menu-item > a:hover, .site-header .nav > div > ul > li.current-menu-item > a:focus',
        'color' => $menu_root_current_font_color,
    );
}
if (isset($mods['menu_desktop_horizontal_padding']) && $mods['menu_desktop_horizontal_padding']) {
    $supplemental_arrays[] = array(
        'query' => '(min-width:900px) and (max-width:1200px)',
        'selector' => '.site-header .nav > li > a',
        'padding-right' =>  $mods['menu_desktop_horizontal_padding'] . 'px',
        'padding-left' =>  $mods['menu_desktop_horizontal_padding'] . 'px'
    );
}
if (isset($mods['menu_desktop_font_size']) && $mods['menu_desktop_font_size']) {
    $supplemental_arrays[] = array(
        'query' => '(min-width:900px) and (max-width:1200px)',
        'selector' => '.site-header .navbar .nav  li  a',
        'font-size' =>  $mods['menu_desktop_font_size']
    );
}
if (isset($mods['menu_tablet_horizontal_padding']) && $mods['menu_tablet_horizontal_padding']) {
    $supplemental_arrays[] = array(
        'query' => '(max-width:899px)',
        'selector' => '.site-header .nav > li > a',
        'padding-right' =>  $mods['menu_tablet_horizontal_padding'] . 'px',
        'padding-left' =>  $mods['menu_tablet_horizontal_padding'] . 'px'
    );
}
if (isset($mods['menu_tablet_font_size']) && $mods['menu_tablet_font_size']) {
    $supplemental_arrays[] = array(
        'query' => '(max-width:899px)',
        'selector' => '.site-header .navbar .nav  li  a',
        'font-size' =>  $mods['menu_tablet_font_size']
    );
}

/*
begin main array
*/
$css = array(
    array(
        'selector' => $menu_bg_color_selector,
        'background-color' => $mods['menu_bg_color'],
    ),
    array(
        'selector' => '.navbar .nav a',
        'color' => $mods['menu_font_color']
    ),
    array(
        'selector' => '.site-header .navbar .nav a',
        'font-size' => $mods['menu_font_size']
    ),
    array(
        'selector' => '.nav  li[class*="current"] > a, .nav  li[class*="current"] > a, .nav  li.current-menu-item > a:hover, .nav  li.current-menu-item > a:focus',
        'color' => $mods['menu_current_font_color'],
    ),
    array(
        'selector' => $menu_bg_current_color_selector,
        'background-color' => $mods['menu_current_bg_color'],
    ),
    array(
        'selector' => '.site-container .nav  li  a:hover, .site-container .nav  li  a:focus',
        'color' => $mods['menu_hover_font_color'],
    ),
    array(
        'selector' => $menu_bg_hover_color_selector,
        'background-color' => $mods['menu_hover_bg_color'],
    ),

    array(
        'selector' => '.site-container > .navbar > .jma-positioned',
        'max-width' => $mods['site_width'] . 'px',
    ),

    array(
        'selector' => '.banner-wrap .entry-title',
        'max-width' => ($mods['site_width'] + 40) . 'px',
    ),
    array(
        'selector' => 'h1,h2,h3,h4,h5,h6',
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
        'selector' => 'button, html input[type="button"], input[type="reset"], input[type="submit"], a.gbs-btn, .btn-default',
        'color' => $mods['button_font'],
        'border-color' => $mods['button_font'],
        'padding' => $mods['button_hor_padding'] . 'px ' . $mods['button_vert_padding'] . 'px',
        'font-size' => $mods['button_font_size'] . 'px',
        'border-radius' => $mods['button_border_radius'] . 'px',
        'border-width' => $mods['button_border_width'] . 'px',
        'background-color' => $mods['button_back'],
    ),
    array(
        'selector' => 'button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, a.gbs-btn:hover, .btn-default:hover',
        'color' => $mods['button_font_hover'],
        'border-color' => $mods['button_font_hover'],
        'background-color' => $mods['button_back_hover'],
    ),
    array(
        'selector' => '.comment-list .children li.comment',
        'border-color' => $mods['footer_bg_color']
    ),
    array(
        'selector' => '.site-footer a',
        'color' => $mods['footer_font_color']
    ),
);

/*
add back content and {$value} and footer options
*/

foreach ($supplemental_arrays as $supplemental_array) {
    $css[] = $supplemental_array;
}
//print_r($css);
