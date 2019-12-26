<?php
add_action( 'genesis_entry_header', 'JMA_GBS_single_featured_image', 5 );

function JMA_GBS_single_featured_image() {
    global $post;

    if ( ! is_singular() ) {
        return;
    }

    if ( ! has_post_thumbnail() ) {
        return;
    }

    $featured_image_attr = apply_filters( 'jma-gbs-featured-image-attr', array(
        'class' => 'single-featured-image'
    ) );

    $size = apply_filters( 'jma-gbs-featured-image', 'jma-gbs-featured-image' );

    the_post_thumbnail( $size, $featured_image_attr );

}
