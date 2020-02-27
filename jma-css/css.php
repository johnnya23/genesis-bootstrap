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
        if ($mods["{$value}_border_width"]) {
            ${$value . '_appearence_array'}["border-style"] = "solid";
            ${$value . '_appearence_array'}["border-width"] = $mods["{$value}_border_width"] . "px";
            ${$value . '_appearence_array'}["border-color"] = $mods["{$value}_border_color"];
            ${$value . '_appearence_array'}["border-radius"] = $mods["{$value}_border_radius"] . "px";
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
if ($mods["frame_border_width"]) {
    $content_appearence_array["border-style"] = "solid";
    $content_appearence_array["border-width"] = $mods["frame_border_width"] . "px";
    $content_appearence_array["border-color"] = $mods["frame_border_color"];
    $content_appearence_array["border-radius"] = $mods["frame_border_radius"] . "px";
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
begin main array
*/
$css = array(
    array(
        'selector' => '.navbar, .site-container .navbar ul ul, .jma-gbs-mobile-panel',
        'background-color' => $mods['menu_bg_color'],
    ),
    array(
        'selector' => '.navbar .nav a',
        'color' => $mods['menu_font_color']
    ),
    array(
        'selector' => '.nav  li[class*="current"] > a, .nav  li[class*="current"] > a, .nav  li.current-menu-item > a:hover, .nav  li.current-menu-item > a:focus',
        'query' => '(min-width:768px)',
        'color' => $mods['menu_current_font_color'],
        'background-color' => $mods['menu_current_bg_color'],
    ),
    array(
        'selector' => '.nav  li  a:hover, .nav  li  a:focus',
        'query' => '(min-width:768px)',
        'color' => $mods['menu_hover_font_color'],
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
$css[] = $content_appearence_array;
$css[] = $content_width_array;
$css[] = $header_width_array;
$css[] = $footer_width_array;
$css[] = $header_appearence_array;
$css[] = $footer_appearence_array;
//print_r($css);
