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
            'type' => 'number'
        ),
        'header_border_radius' => array(
            'default' => '0',
            'label' => __('Header Border Radius', 'jma_gbs'),
            'description' => esc_html__('In Pixels'),
            'section' => 'genesis_header',
            'type' => 'number'
        ),
        'menu_bg_color' => array(
            'default' => '#660000',
            'label' => __('Menu Background Color', 'jma_gbs'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
        'menu_font_color' => array(
            'default' => '#ffffff',
            'label' => __('Menu Font Color', 'jma_gbs'),
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
        'menu_font_size' => array(
            'default' => '#ffffff',
            'label' => __('Menu Font Size', 'jma_gbs'),
            'section' => 'genesis_header',
            'description' => esc_html__('Use unit (px, em ...)'),
            'type' => 'text',
        ),
        'menu_vertical_padding' => array(
            'default' => '10',
            'label' => __('Vertical Menu Padding', 'jma_gbs'),
            'section' => 'genesis_header',
            'description' => esc_html__('In Pixels'),
            'type' => 'number',
        ),
        'menu_horizontal_padding' => array(
            'default' => '15',
            'label' => __('Horizontal Menu Padding', 'jma_gbs'),
            'section' => 'genesis_header',
            'description' => esc_html__('In Pixels'),
            'type' => 'number',
        ),
        'use_menu_root_dividers' => array(
            'default' => 'yes',
            'label' => __('Use Dividers on Menu Root?', 'jma_gbs'),
            'description' => esc_html__('Use a border between menu items'),
            'section' => 'genesis_header',
            'type' => 'radio',
            'choices' => array(
                'yes' => 'Yes',
                'no' => 'No'
            )
        ),
        'use_menu_root_bg' => array(
            'default' => 'yes',
            'label' => __('Use Background on Menu Root?', 'jma_gbs'),
            'description' => esc_html__('If "yes" root menu items will get header font color'),
            'section' => 'genesis_header',
            'type' => 'radio',
            'choices' => array(
                'yes' => 'Yes',
                'no' => 'No'
            )
        ),
        'menu_root_hover_font_color' => array(
            'default' => '',
            'label' => __('Menu Root Hover Font Color', 'jma_gbs'),
            'description' => esc_html__('Clear to inherit from main menu hover font option'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
        'menu_root_current_font_color' => array(
            'default' => '',
            'label' => __('Menu Root Current Font Color', 'jma_gbs'),
            'description' => esc_html__('Clear to inherit from main menu current font option'),
            'section' => 'genesis_header',
            'type' => 'color',
        ),
);
