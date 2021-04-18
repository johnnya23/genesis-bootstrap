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
    $display_vals = jma_gbs_get_display_vals();

    if (! is_singular()) {
        return;
    }

    if (! has_post_thumbnail()) {
        return;
    }

    if ($display_vals['image_display'] == 'hide') {
        return;
    }

    $featured_image_attr = apply_filters('jma-gbs-featured-image-attr', array());

    $size = $display_vals['featured_size'];
    $size = apply_filters('jma-gbs-featured-image', 'jma-gbs-featured-image');

    echo '<figure class="single-featured-image align' . $display_vals['image_display'] . '">';
    if ($display_vals['lightbox_display'] == 'on') {
        echo '<a href="' . get_the_post_thumbnail_url(null, 'full') . '">';
    }
    the_post_thumbnail($size, $featured_image_attr);
    if ($display_vals['lightbox_display'] == 'on') {
        echo '</a>';
    }
    echo '</figure>';
}
