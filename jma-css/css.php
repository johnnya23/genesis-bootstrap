<?php

/*
@media queries - ie 'query' => 'min-width:768px', - translates to:
@media(min-width:768px)
identical queries will be combined at output

min-width:768px = tablets and desktops
max-width:767px = phones
min-width:992px = desktops
max-width:991px = tablets and phones

omit the query element to target all
*/
$css = array(
    array(
        'selector' => 'h2',
        'query' => 'min-width:768px',
        'color' => 'blue'
    )
);
