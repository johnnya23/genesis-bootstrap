<?php

return array(
        'header_bg_color' => array(
            'default' => '',
            'label' => __('Header Background', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_header',
            'type' => 'color'
        ),
        'header_font_color' => array(
            'default' => '',
            'label' => __('Header Font', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_header',
            'type' => 'color'
        ),
        'modular_header' => array(
            'default' => 'no',
            'label' => __('Modular Header', 'jma_gbs'),
            'description' => esc_html__('Use a border?'),
            'section' => 'genesis_header',
            'type' => 'radio',
            'choices' => array(
                'no' => 'No',
                'yes' => 'Yes'
            )
        ),
        'header_border_color' => array(
            'default' => '#660000',
            'label' => __('Header Border Color', 'jma_gbs'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
        'header_border_width' => array(
            'default' => '1',
            'label' => __('Header Border Width (zero for no border)', 'jma_gbs'),
            'description' => esc_html__('In Pixels'),
            'section' => 'genesis_header',
            'type' => 'text'
        ),
        'header_border_radius' => array(
            'default' => '1',
            'label' => __('Header Border Radius', 'jma_gbs'),
            'description' => esc_html__('In Pixels'),
            'section' => 'genesis_header',
            'type' => 'text'
        ),
        'menu_font_color' => array(
            'default' => '#ffffff',
            'label' => __('Menu Font Color', 'jma_gbs'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
        'menu_bg_color' => array(
            'default' => '#660000',
            'label' => __('Menu Background Color', 'jma_gbs'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
        'menu_hover_font_color' => array(
            'default' => '#660000',
            'label' => __('Menu Hover Font Color', 'jma_gbs'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
        'menu_hover_bg_color' => array(
            'default' => '#ffffff',
            'label' => __('Menu Hover Background Color', 'jma_gbs'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
        'menu_current_font_color' => array(
            'default' => '#000066',
            'label' => __('Menu Current Font Color', 'jma_gbs'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
        'menu_current_bg_color' => array(
            'default' => '#ffffff',
            'label' => __('Menu Current Background Color', 'jma_gbs'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
);
