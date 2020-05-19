<?php

return array(
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
            //'priority' => -5
        ),
        'title_display_pages' => array(
            'default' => 'show',
            'label' => __('Page Title Display', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'radio',
            'choices' => array(
                'show' => 'Show',
                'hide' => 'Hide'
            ),
            //'priority' => -25
        ),
        'image_display_pages' => array(
            'default' => 'full',
            'label' => __('Page Image Display', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'select',
            'choices' => array(
                'hide' => 'Hide',
                'full' => 'Full Width',
                'right' => 'Align Right',
                'left' => 'Align Left',
            ),
            //'priority' => -15
        ),
        'title_display_posts' => array(
            'default' => 'show',
            'label' => __('Post Title Display', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'radio',
            'choices' => array(
                'show' => 'Show',
                'hide' => 'Hide'
            ),
            //'priority' => -20
        ),
        'image_display_posts' => array(
            'default' => 'full',
            'label' => __('Post Image Display', 'jma_gbs'),
            'section' => 'genesis_single',
            'type' => 'select',
            'choices' => array(
                'hide' => 'Hide',
                'full' => 'Full Width',
                'right' => 'Align Right',
                'left' => 'Align Left',
            ),
            //'priority' => -10
        ),
);
