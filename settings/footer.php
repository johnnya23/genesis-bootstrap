<?php

return array(
        'footer_bg_color' => array(
            'default' => '',
            'label' => __('Footer Background Color', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_footer',
            'type' => 'color'
        ),
        'footer_font_color' => array(
            'default' => '',
            'label' => __('Footer Font', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_footer',
            'type' => 'color'
        ),
        'modular_footer' => array(
            'default' => 0,
            'label' => __('Modular Footer', 'jma_gbs'),
            'section' => 'genesis_footer',
            'type' => 'radio',
            'choices' => array(
                0 => 'No',
                1 => 'Yes'
            )
        ),
        'footer_border_color' => array(
            'label' => __('Footer Border Color', 'jma_gbs'),
            'section' => 'genesis_footer',
            'type' => 'color',
        ),
        'footer_border_width' => array(
            'default' => '1px',
            'label' => __('Footer Border Width (zero for no border)', 'jma_gbs'),
            'description' => esc_html__('In Pixels'),
            'section' => 'genesis_footer',
            'type' => 'number'
        ),
        'footer_border_radius' => array(
            'default' => '1px',
            'label' => __('Footer Border Radius', 'jma_gbs'),
            'description' => esc_html__('In Pixels'),
            'section' => 'genesis_footer',
            'type' => 'number'
        ),
);
