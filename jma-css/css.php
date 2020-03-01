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
if ($mods['body_shape'] == 'full') {
    //$content_width_array['max-width'] = ($site_width +30) . 'px';
    if ($mods['frame_content'] == 'no') {
        $content_appearence_array['selector'] = '.site-inner';
    } else {
        $content_width_array['max-width'] = ($site_width) . 'px';
    }
}
if ($mods['body_shape'] == 'modular') {
    $content_appearence_array['selector'] = '.site-inner .jma-gbs-inner';
    unset($content_appearence_array['max-width']);
}
if ($mods['body_shape'] == 'boxed') {
    $content_appearence_array['selector'] = '.site-container';
    $content_width_array['selector'] = '.site-container';
    $content_width_array['max-width'] = ($site_width) . 'px';
}
/*
handle menu options
*/

$menu_bg_color_selector ='.navbar, .site-container .navbar ul ul, .jma-gbs-mobile-panel';
$menu_bg_current_color_selector = '.nav  li[class*="current"] > a, .nav  li[class*="current"] > a, .nav  li.current-menu-item > a:hover, .nav  li.current-menu-item > a:focus';
$menu_bg_hover_color_selector = '.nav  li  a:hover, .nav  li  a:focus';
if ($mods['use_menu_root_bg'] == 'no') {
    $menu_bg_color_selector = '.site-container .navbar ul ul, .nav-primary.fixed, .jma-gbs-mobile-panel';
    $menu_bg_current_color_selector = '.nav-primary ul ul li[class*="current"] > a, .nav-primary ul ul li.current-menu-item > a:hover, .nav-primary ul ul li.current-menu-item > a:focus';
    $menu_bg_hover_color_selector = '.nav-primary ul ul li  a:hover, .nav-primary ul ul li  a:focus';
}

$menu_root_values = array(
    'selector' => '.site-header .nav > li > a',
    'padding' => $mods['menu_vertical_padding'] . 'px ' . $mods['menu_horizontal_padding'] . 'px',
);
if ($mods['use_menu_root_bg'] == 'no') {
    $menu_root_values['color'] = $mods['header_font_color'];
}

$root_color_settings = array('.site-header .nav > li > a:hover' => 'menu_root_hover_font_color', '.site-header .nav > li[class*="current"] > a' => 'menu_root_current_font_color');
if ($mods['use_menu_root_bg'] == 'no') {
    foreach ($root_color_settings as $i => $root_setting) {
        $$root_setting = array();
        if (isset($mods[$root_setting]) && $mods[$root_setting]) {
            $$root_setting = array(
                'selector' => $i,
                'color' => $mods[$root_setting],
            );
        }
    }
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
        'selector' => '.site-header .nav > li > a.sf-with-ul',
        'padding-right' =>  ($mods['menu_horizontal_padding'] + 10) . 'px'
    ),
    array(
        'selector' => '.site-header .navbar .nav a',
        'font-size' => $mods['menu_font_size']
    ),
    array(
        'selector' => '.navbar .nav a',
        'color' => $mods['menu_font_color']
    ),
    array(
        'selector' => '.nav  li[class*="current"] > a, .nav  li[class*="current"] > a, .nav  li.current-menu-item > a:hover, .nav  li.current-menu-item > a:focus',
        'query' => '(min-width:768px)',
        'color' => $mods['menu_current_font_color'],
    ),
    array(
        'selector' => $menu_bg_current_color_selector,
        'query' => '(min-width:768px)',
        'background-color' => $mods['menu_current_bg_color'],
    ),
    array(
        'selector' => '.nav  li  a:hover, .nav  li  a:focus',
        'query' => '(min-width:768px)',
        'color' => $mods['menu_hover_font_color'],
    ),
    array(
        'selector' => $menu_bg_hover_color_selector,
        'query' => '(min-width:768px)',
        'background-color' => $mods['menu_hover_bg_color'],
    ),

    array(
        'selector' => 'h1,h2,h3,h4,h5,h6',
        'color' => $mods['site_title_color']
    ),
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
        'selector' => '.site-footer a',
        'color' => $mods['footer_font_color']
    ),
);

/*
add back content and {$value} and footer options
*/
$supplemental_arrays = array($menu_root_values, $content_appearence_array, $content_width_array, $header_width_array, $footer_width_array, $header_appearence_array, $footer_appearence_array);
foreach ($root_color_settings as $i => $root_setting) {
    $supplemental_arrays[] = $$root_setting;
}
foreach ($supplemental_arrays as $supplemental_array) {
    $css[] = $supplemental_array;
}
//print_r($css);
