<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

$jma_ghb_cpt = array();
if (function_exists('jma_ghb_get_cpt')) {
    $jma_ghb_cpt = jma_ghb_get_cpt();
}
$post_type_array = array();
$default = array(0 => 'default');
foreach ($jma_ghb_cpt as $slug => $obj) {
    $post_type_array[$slug . '_col_layout'] = array(
        'default' => 0,
        'label' => __('Site Layout for ' . $obj->label, 'jma_gbs'),
        'description' => esc_html__('Default Site Layout for your ' . $obj->label . '.'),
        'section' => 'genesis_layout',
        'type' => 'select',
        'choices' => array_merge($default, genesis_get_layouts_for_customizer())
    );
}

$layout_choices = array(
        'body_shape' => array(
            'default' => 'gbs-full-content',
            'label' => __('Body Shape', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'genesis_layout',
            'type' => 'select',
            'choices' => array(
                'gbs-full-content' => 'Full Width',
                'gbs-boxed-content' => 'Boxed',
                'gbs-modular-content' => 'Modular (content only)'
            )
        ),
        'site_width' => array(
            'default' => 1200,
            'label' => __('Site Width', 'jma_gbs'),
            'description' => esc_html__('In Pixels'),
            'section' => 'genesis_layout',
            'type' => 'number'
        ),
        'frame_content' => array(
            'default' => 0,
            'label' => __('Frame Content', 'jma_gbs'),
            'description' => esc_html__('Frame the Site Content'),
            'section' => 'genesis_layout',
            'type' => 'radio',
            'choices' => array(
                0 => 'No',
                1 => 'Yes'
            )
        ),
        'frame_border_color' => array(
            'default' => '#660000',
            'label' => __('Site Border Color', 'jma_gbs'),
            'section' => 'genesis_layout',
            'type' => 'color',
        ),
        'frame_border_width' => array(
            'default' => '1',
            'label' => __('Site Border Width (0 for no border)', 'jma_gbs'),
            'description' => esc_html__('in px'),
            'section' => 'genesis_layout',
            'type' => 'number'
        ),
        'frame_border_radius' => array(
            'default' => '1',
            'label' => __('Header Border Radius', 'jma_gbs'),
            'description' => esc_html__('in px'),
            'section' => 'genesis_layout',
            'type' => 'number'
        ),
        'site_bg' => array(
            'default' => '#ffffff',
            'label' => __('Site Background', 'jma_gbs'),
            'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'genesis_layout',
            'type' => 'color'
        ),
        'page_bg' => array(
            'default' => '#ffffff',
            'label' => __('Page Background', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_layout',
            'type' => 'color'
        )
);
return array_merge($post_type_array, $layout_choices);
