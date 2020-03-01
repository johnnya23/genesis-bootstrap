<?php

return array(
        'body_shape' => array(
            'default' => 'full',
            'label' => __('Body Shape', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'genesis_layout',
            'type' => 'select',
            'choices' => array(
                'full' => 'Full Width',
                'boxed' => 'Boxed',
                'modular' => 'Modular (content only)'
            )
        ),
        'site_width' => array(
            'default' => '1200px',
            'label' => __('Site Width', 'jma_gbs'),
            'description' => esc_html__('In Pixels'),
            'section' => 'genesis_layout',
            'type' => 'number'
        ),
        'frame_content' => array(
            'default' => 'no',
            'label' => __('Frame Content', 'jma_gbs'),
            'description' => esc_html__('Frame the Site Content'),
            'section' => 'genesis_layout',
            'type' => 'radio',
            'choices' => array(
                'no' => 'No',
                'yes' => 'Yes'
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
        ),
        'site_title_color' => array(
            'default' => '#004400',
            'label' => __('Site Title Color', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_layout',
            'type' => 'color'
        ),
        'site_font_color' => array(
            'default' => '#666666',
            'label' => __('Site Font Color', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_layout',
            'type' => 'color'
        ),
        'site_font_link_color' => array(
            'default' => '#004400',
            'label' => __('Site Link Font Color', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_layout',
            'type' => 'color'
        ),
        'site_font_link_hover_color' => array(
            'default' => '#009900',
            'label' => __('Site Link Font Hover Color', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_layout',
            'type' => 'color'
        ),
        'site_font_size' => array(
            'default' => '14px',
            'label' => __('Site Font', 'jma_gbs'),
            'description' => esc_html__('include the unit (px, em ...)'),
            'section' => 'genesis_layout',
            'text' => 'text'
        ),
        'site_banner' => array(
            'default' => 0,
            'label' => __('Site Banner', 'jma_gbs'),
            'description' => esc_html__('show a site banner'),
            'section' => 'genesis_layout',
            'type' => 'radio',
            'choices' => array(
                0 => 'standard',
                1 => 'title',
                2 => 'custom text',
            )
        ),
        'site_logo' => array(
            'default' => '',
            'label' => __('Site Logo', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_layout',
            'type' => 'image'
        ),
);
