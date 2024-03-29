<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

$types = array();
if (function_exists('jma_ghb_get_cpt')) {
    $types = jma_ghb_get_cpt();
}
foreach ($types as $slug => $obj) {
    $name = $obj->label;
    $page_post_array['title_display_' . $slug] = array(
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
    //image display for products in handled in woocommerce
    if ($slug != 'product') {
        $page_post_array['image_display_' . $slug] = array(
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
        $page_post_array['lightbox_display_' . $slug] = array(
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
        $page_post_array['featured_size_' . $slug] = array(
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
        ),
        'site_banner_bg_color' => array(
            'default' => 0,
            'label' => __('Site Banner Background Color', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'color'
        ),
        'site_banner_font_color' => array(
            'default' => 0,
            'label' => __('Site Banner Font Color', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'color'
        ),
        'site_banner_font_size' => array(
            'default' => 0,
            'label' => __('Site Banner Font Size', 'jma_gbs'),
            'description' => esc_html__('Percentage title font size FOR BANNERS (Blank or 100 for no change - 120 for big - 80 for small)'),
            'section' => 'genesis_single',
            'type' => 'number'
        ),
        'site_banner_align' => array(
            'default' => 'left',
            'label' => __('Site Banner Alignment', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'radio',
            'choices' => array(
                'left' => 'Left',
                'center' => 'Center',
                'right' => 'Right'
            ),
        ),
        'site_banner_vertical' => array(
            'default' => 5,
            'label' => __('Site Banner Vertical Padding', 'jma_gbs'),
            'description' => esc_html__('Top and Bottom in px'),
            'section' => 'genesis_single',
            'type' => 'number'
        ),

);
return array_merge($page_post_choices, $page_post_array);
