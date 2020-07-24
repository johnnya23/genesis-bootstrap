<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

add_action('genesis_entry_header', 'JMA_GBS_single_featured_image', 15);

function JMA_GBS_single_featured_image()
{
    global $post;
    if (!is_object($post)) {
        return;
    }
    $mods = jma_gbs_get_theme_mods();
    $display_vals = jma_gbs_get_display_vals($mods);

    if (! is_singular()) {
        return;
    }

    if (! has_post_thumbnail()) {
        return;
    }

    if ($display_vals['image_display'] == 'hide') {
        return;
    }

    $featured_image_attr = apply_filters('jma-gbs-featured-image-attr', array(
        'class' => 'single-featured-image align' . $display_vals['image_display']
    ));

    $size = apply_filters('jma-gbs-featured-image', 'jma-gbs-featured-image');

    the_post_thumbnail($size, $featured_image_attr);
}
