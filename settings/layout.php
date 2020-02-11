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
                'boxed' => 'boxed'
            )
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
            'label' => __('Site Title Font', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'genesis_layout',
            'type' => 'color'
        ),
        'site_font_color' => array(
            'default' => '#666666',
            'label' => __('Site Font', 'jma_gbs'),
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
        'site_width' => array(
            'default' => 1200,
            'label' => __('Site Width', 'jma_gbs'),
            'description' => esc_html__('in pixels'),
            'section' => 'genesis_layout',
            'type' => 'number'
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
