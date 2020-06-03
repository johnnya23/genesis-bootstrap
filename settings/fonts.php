<?php
global $families;


return array(
        'site_font_size' => array(
            'default' => '14px',
            'label' => __('Site Font Size', 'jma_gbs'),
            //'description' => esc_html__('include the unit (px, em ...)'),
            'section' => 'jma_gbs_fonts',
            'type' => 'text'
        ),
        'site_font_family' => array(
            'label' => __('Site Font Family', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'jma_gbs_fonts',
            'type' => 'select',
            'default' => 'georgia',
            'choices' => $families
        ),
        'site_custom_font_family' => array(
            'default' => '... , serif',
            'label' => __('Site Custom Font Family', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'jma_gbs_fonts',
            'type' => 'text'
        ),
        'site_font_color' => array(
            'default' => '#666666',
            'label' => __('Site Font Color', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'jma_gbs_fonts',
            'type' => 'color'
        ),
        'site_title_font_family' => array(
            'label' => __('Site Title Font Family', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'jma_gbs_fonts',
            'default' => 'georgia',
            'type' => 'select',
            'choices' => $families
        ),
        'site_custom_title_font_family' => array(
            'default' => '...., serif',
            'label' => __('Site Custom Title Font Family', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'jma_gbs_fonts',
            'type' => 'text'
        ),
        'title_size_adjust' => array(
            'default' => '100',
            'label' => __('Site Title Size Adjustment', 'jma_gbs'),
            'description' => esc_html__('Percentage title font size (Blank or 100 for no change - 120 for big - 80 for small)'),
            'section' => 'jma_gbs_fonts',
            'type' => 'number'
        ),
        'site_title_color' => array(
            'default' => '#004400',
            'label' => __('Site Title Color', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'jma_gbs_fonts',
            'type' => 'color'
        ),
        'site_font_link_color' => array(
            'default' => '#004400',
            'label' => __('Site Link Font Color', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'jma_gbs_fonts',
            'type' => 'color'
        ),
        'site_font_link_hover_color' => array(
            'default' => '#009900',
            'label' => __('Site Link Font Hover Color', 'jma_gbs'),
            //'description' => esc_html__('Page that will provide header contentxxx.'),
            'section' => 'jma_gbs_fonts',
            'type' => 'color'
        ),
);
