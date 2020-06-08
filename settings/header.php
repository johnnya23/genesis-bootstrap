<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

return array(
        'header_bg_color' => array(
            'default' => '',
            'label' => __('Header Background', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_header',
            'type' => 'color',
            'show_opacity' => true
        ),
        'header_font_color' => array(
            'default' => '',
            'label' => __('Header Font', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_header',
            'type' => 'color'
        ),
        'modular_header' => array(
            'default' => 0,
            'label' => __('Modular Header', 'jma_gbs'),
            'description' => esc_html__('Use a border?'),
            'section' => 'genesis_header',
            'type' => 'radio',
            'choices' => array(
                0 => 'No',
                1 => 'Yes'
            )
        ),
        'header_border_color' => array(
            'default' => '#660000',
            'label' => __('Header Border Color', 'jma_gbs'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
        'header_border_width' => array(
            'default' => 1,
            'label' => __('Header Border Width (zero for no border)', 'jma_gbs'),
            'description' => esc_html__('In Pixels'),
            'section' => 'genesis_header',
            'type' => 'number'
        ),
        'header_border_radius' => array(
            'default' => 0,
            'label' => __('Header Border Radius', 'jma_gbs'),
            'description' => esc_html__('In Pixels'),
            'section' => 'genesis_header',
            'type' => 'number'
        )
);
