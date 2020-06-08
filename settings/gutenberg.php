<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

if (!is_plugin_active('ultimate-addons-for-gutenberg/ultimate-addons-for-gutenberg.php')) {
    return array();
}

return array(
        'element_vert' => array(
            'default' => 60,
            'label' => __('Element Vertical Spacing', 'jma_gbs'),
            'description' => esc_html__('for rows within UAGB sections.'),
            'section' => 'jma_gbs_uagb_comps',
            'type' => 'number'
        ),
        'section_vert' => array(
            'default' => 40,
            'label' => __('Section Vertical Spacing', 'jma_gbs'),
            'description' => esc_html__('for UAGB sections.'),
            'section' => 'jma_gbs_uagb_comps',
            'type' => 'number'
        ),
        'uagb_gutter' => array(
            'default' => 20,
            'label' => __('Gutters', 'jma_gbs'),
            'description' => esc_html__('for UAGB columns.'),
            'section' => 'jma_gbs_uagb_comps',
            'type' => 'number'
        ),
);
