<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

add_image_size('jma-gbs-featured-image', 1170, 630, true);
add_image_size('jma-gbs-grid', 640, 360, true);



function jma_gbs_custom_sizes($sizes)
{
    return array_merge($sizes, array(
        'jma-gbs-featured-image' => __('Featured'),
        'jma-gbs-grid' => __('Grid Image')
    ));
}
add_filter('image_size_names_choose', 'jma_gbs_custom_sizes');
