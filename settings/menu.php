<?php

return array(
        'menu_bg_color' => array(
            'default' => '#660000',
            'label' => __('Menu Background Color', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'type' => 'color',
        ),
        'menu_font_color' => array(
            'default' => '#ffffff',
            'label' => __('Menu Font Color', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'type' => 'color',
        ),
        'menu_hover_font_color' => array(
            'default' => '#660000',
            'label' => __('Menu Hover Font Color', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'type' => 'color',
        ),
        'menu_hover_bg_color' => array(
            'default' => '#ffffff',
            'label' => __('Menu Hover Background Color', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'type' => 'color',
        ),
        'menu_current_font_color' => array(
            'default' => '#000066',
            'label' => __('Menu Current Font Color', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'type' => 'color',
        ),
        'menu_current_bg_color' => array(
            'default' => '#ffffff',
            'label' => __('Menu Current Background Color', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'type' => 'color',
        ),
        'menu_vertical_padding' => array(
            'default' => 10,
            'label' => __('Vertical Menu Padding', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'description' => esc_html__('In Pixels'),
            'type' => 'number',
            'class' => 'my-class'
        ),
        'menu_font_size' => array(
            'default' => '',
            'label' => __('Menu Font Size', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'description' => esc_html__('Use unit (px, em ...)'),
            'type' => 'text',
        ),
        'menu_horizontal_padding' => array(
            'default' => 15,
            'label' => __('Horizontal Menu Padding', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'description' => esc_html__('In Pixels'),
            'type' => 'number',
        ),
        'menu_desktop_font_size' => array(
            'default' => '',
            'label' => __('Desktop Menu Font Size', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'description' => esc_html__('on devices less than 1200px, Use unit (px, em ...)'),
            'type' => 'text',
        ),
        'menu_desktop_horizontal_padding' => array(
            'default' => 0,
            'label' => __('Desktop Horzontal Menu Padding', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'description' => esc_html__('on devices less than 1200px'),
            'type' => 'number',
        ),
        'menu_tablet_font_size' => array(
            'default' => '',
            'label' => __('Tablet Menu Font Size', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'description' => esc_html__('on devices less than 900px. Use unit (px, em ...)'),
            'type' => 'text',
        ),
        'menu_tablet_horizontal_padding' => array(
            'default' => 0,
            'label' => __('Tablet Horzontal Menu Padding', 'jma_gbs'),
            'section' => 'jma_gbs_uagb_menu',
            'description' => esc_html__('on devices less than 900px'),
            'type' => 'number',
        ),
        'use_menu_root_dividers' => array(
            'default' => 1,
            'label' => __('Use Dividers on Menu Root?', 'jma_gbs'),
            'description' => esc_html__('Use a border between menu items'),
            'section' => 'jma_gbs_uagb_menu',
            'type' => 'radio',
            'choices' => array(
                1 => 'Yes',
                0 => 'No'
            )
        ),
        'use_menu_root_bg' => array(
            'default' => 1,
            'label' => __('Use Background on Menu Root?', 'jma_gbs'),
            'description' => esc_html__('If "yes" root menu items will get header font color'),
            'section' => 'jma_gbs_uagb_menu',
            'type' => 'radio',
            'choices' => array(
                1 => 'Yes',
                0 => 'No'
            )
        ),
        'menu_root_hover_font_color' => array(
            'default' => '',
            'label' => __('Menu Root Hover Font Color', 'jma_gbs'),
            'description' => esc_html__('Clear to inherit from main menu hover font option'),
            'section' => 'jma_gbs_uagb_menu',
            'type' => 'color',
        ),
        'menu_root_current_font_color' => array(
            'default' => '',
            'label' => __('Menu Root Current Font Color', 'jma_gbs'),
            'description' => esc_html__('Clear to inherit from main menu current font option'),
            'section' => 'jma_gbs_uagb_menu',
            'type' => 'color',
        ),
);
