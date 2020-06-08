<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

return array(
        'button_hor_padding' => array(
            'default' => '20',
            'label' => __('Button Padding Horitontal', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'jma_gbs_buttons',
            'type' => 'number'
        ),
        'button_vert_padding' => array(
            'default' => '12',
            'label' => __('Button Padding Vertical', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'jma_gbs_buttons',
            'type' => 'number'
        ),
        'button_font_size' => array(
            'default' => '12',
            'label' => __('Button Font Size', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'jma_gbs_buttons',
            'type' => 'number'
        ),
        'button_border_radius' => array(
            'default' => '',
            'label' => __('Button Border Radius', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'jma_gbs_buttons',
            'type' => 'number'
        ),
        'button_border_width' => array(
            'default' => '2',
            'label' => __('Button Border Width', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'jma_gbs_buttons',
            'type' => 'number'
        ),
        'button_back' => array(
            'default' => '#c5e8e2',
            'label' => __('Button Background', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'jma_gbs_buttons',
            'type' => 'color'
        ),
        'button_font' => array(
            'default' => '#4c3639',
            'label' => __('Button Font Color', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'jma_gbs_buttons',
            'type' => 'color'
        ),
        'button_back_hover' => array(
            'default' => '#cccccc',
            'label' => __('Button Hover Background', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'jma_gbs_buttons',
            'type' => 'color'
        ),
        'button_font_hover' => array(
            'default' => '#000044',
            'label' => __('Button Hover Font Color', 'jma_gbs'),
            //'description' => esc_html__('Won\'t be very prominent on a full-width site.'),
            'section' => 'jma_gbs_buttons',
            'type' => 'color'
        ),
);
