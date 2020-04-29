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
            'priority' => -5
        ),
);
