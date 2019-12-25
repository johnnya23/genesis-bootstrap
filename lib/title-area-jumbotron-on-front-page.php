<?php

add_action( 'template_redirect', 'JMA_GBS_title_area_jumbotron_unit_on_front_page' );

function JMA_GBS_title_area_jumbotron_unit_on_front_page() {
    if ( is_front_page() ) {
        add_action( 'genesis_site_title', 'JMA_GBS_jumbotron_unit_open', 2 );
        add_action( 'genesis_site_description', 'JMA_GBS_jumbotron_unit_close', 30 );
    }
}


function JMA_GBS_jumbotron_unit_open() {
    echo '<div class="jumbotron">';
}

function JMA_GBS_jumbotron_unit_close() {
    echo '</div>';
}


