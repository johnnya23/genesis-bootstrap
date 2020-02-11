<?php

/*
@media queries - ie 'query' => 'min-width:768px', - translates to:
@media(min-width:768px)
identical queries will be combined at output

(min-width:768px) = tablets and desktops
(max-width:767px) = phones
(min-width:992px) = desktops
(max-width:991px) = tablets and phones
(min-width:768px) and (max-width:991px) = tablets

omit the query element to target all
*/
$css = array(
    array(
        'selector' => 'h1,h2,h3,h4,h5,h6',
        'color' => get_theme_mod('jma_gbs_site_title_color')
    ),
    array(
        'selector' => 'body',
        'color' => $mods['jma_gbs_site_font_color'],
        'font-size' => $mods['jma_gbs_site_font_size']
    )
);
