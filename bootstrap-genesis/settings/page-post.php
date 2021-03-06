<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

$types = array('_pages' => 'Page', '_posts' => 'Post');

foreach ($types as $slug => $name) {
    $page_post_array['title_display' . $slug] = array(
        'default' => 'show',
        'label' => __($name . ' Title Display', 'jma_gbs'),
        'section' => 'genesis_single',
        'type' => 'radio',
        'choices' => array(
            'show' => 'Show',
            'hide' => 'Hide'
        ),
        //'priority' => -25
    );
    $page_post_array['image_display' . $slug] = array(
        'default' => 'full',
        'label' => __($name . ' Image Display', 'jma_gbs'),
        'section' => 'genesis_single',
        'type' => 'select',
        'choices' => array(
            'hide' => 'Hide',
            'full' => 'Full Width',
            'right' => 'Align Right',
            'left' => 'Align Left',
        ),
        //'priority' => -15
    );
    $page_post_array['lightbox_display' . $slug] = array(
        'default' => 'off',
        'label' => __($name . ' Lightbox Display', 'jma_gbs'),
        'section' => 'genesis_single',
        'type' => 'select',
        'choices' => array(
            'off' => 'Off',
            'on' => 'On'
        ),
        //'priority' => -15
    );
    $page_post_array['featured_size' . $slug] = array(
        'default' => 'full',
        'label' => __('Featured Image Size on ' . $name, 'jma_gbs'),
        'section' => 'genesis_single',
        'type' => 'select',
        'choices' => array(
            'full' => 'Full',
            'large' => 'Large',
            'medium' => 'Medium',
            'jma-gbs-grid' => 'Grid (649x360)'
        ),
        //'priority' => -15
    );
}

$page_post_choices = array(
        'site_banner' => array(
            'default' => 0,
            'label' => __('Site Banner', 'jma_gbs'),
            'description' => esc_html__('show the title in a banner'),
            'section' => 'genesis_single',
            'type' => 'radio',
            'choices' => array(
                0 => 'standard',
                1 => 'title'
            ),
            //'priority' => -5
        ),
        /*'title_display_pages' => array(
            'default' => 'show',
            'label' => __('Page Title Display', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'radio',
            'choices' => array(
                'show' => 'Show',
                'hide' => 'Hide'
            ),
            //'priority' => -25
        ),
        'image_display_pages' => array(
            'default' => 'full',
            'label' => __('Page Image Display', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'select',
            'choices' => array(
                'hide' => 'Hide',
                'full' => 'Full Width',
                'right' => 'Align Right',
                'left' => 'Align Left',
            ),
            //'priority' => -15
        ),
        'title_display_posts' => array(
            'default' => 'show',
            'label' => __('Post Title Display', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'radio',
            'choices' => array(
                'show' => 'Show',
                'hide' => 'Hide'
            ),
            //'priority' => -20
        ),
        'image_display_posts' => array(
            'default' => 'full',
            'label' => __('Post Image Display', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'select',
            'choices' => array(
                'hide' => 'Hide',
                'full' => 'Full Width',
                'right' => 'Align Right',
                'left' => 'Align Left',
            ),
            //'priority' => -10
        ),*/
);
return array_merge($page_post_choices, $page_post_array);
