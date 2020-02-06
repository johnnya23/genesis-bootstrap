<?php
/**
 * Add class "jma-gbs-pagination-numeric" or "jma-gbs-pagination-prev-next" depending on
 * the pagination style selected in the Genesis theme options
 *
 * @since 0.7.0
 */
remove_filter( 'genesis_attr_archive-pagination', 'genesis_attributes_pagination' );

add_filter( 'jma-gbs-add-class', 'JMA_GBS_prev_next_or_numeric_archive_pagination', 10, 2 );

function JMA_GBS_prev_next_or_numeric_archive_pagination( $classes_array, $context ) {
    if ( 'archive-pagination' !== $context ) {
        return $classes_array;
    }

    if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
        $classes_array[] = 'jma-gbs-pagination-numeric';
    } else {
        $classes_array[] = 'jma-gbs-pagination-prev-next';
    }

    return $classes_array;

}
