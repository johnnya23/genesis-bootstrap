<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

$jmamenus = array(0 => 'select');
$menu_objects = wp_get_nav_menus();
foreach ($menu_objects as  $menu_object) {
    $jmamenus[$menu_object->slug] = $menu_object->name;
}
return array(
        'use_custom_mobile_menu' => array(
            'default' => 0,
            'label' => __('Use Custom Mobile Menu', 'jma_gbs'),
            'description' => esc_html__('If no selected a mobile menu will be generated with jquery(if possible). FOR TYPICAL SINGLE HEADER MENU SITE TRY LEAVING THIS AS NO AND IGNORE CUSTOM SIDE MENU'),
            'section' => 'jma_gbs_menu',
            'type' => 'radio',
            'choices' => array(
                0 => 'No',
                1 => 'Yes',
            )
        ),
        'custom_mobile_menu' => array(
            'default' => 0,
            'label' => __('Menu to use for mobile', 'jma_gbs'),
            'description' => esc_html__('Select a menu'),
            'section' => 'jma_gbs_menu',
            'type' => 'select',
            'choices' => $jmamenus
        ),
        'use_desktop_side_menu' => array(
            'default' => 0,
            'label' => __('Desktop Side Menu', 'jma_gbs'),
            'description' => esc_html__('Add a menu that slides out from the right on desktop and tablet'),
            'section' => 'jma_gbs_menu',
            'type' => 'radio',
            'choices' => array(
                0 => 'No',
                1 => 'Yes',
            )
        ),
        'desktop_side_menu' => array(
            'default' => 0,
            'label' => __('Menu to use for Desktop Side', 'jma_gbs'),
            'description' => esc_html__('This menu will slide out'),
            'section' => 'jma_gbs_menu',
            'type' => 'select',
            'choices' => $jmamenus
        ),
        'desktop_side_mobile_display' => array(
            'default' => 0,
            'label' => __('Diplay Choices', 'jma_gbs'),
            'description' => esc_html__('Either just desktop or add to mobile (if applicable)'),
            'section' => 'jma_gbs_menu',
            'type' => 'select',
            'choices' => array(
                0 => 'Desktop Only',
                78 => 'Desktop and Mobile Top',
                82 => 'Desktop and Mobile Bottom',
            )
        ),
        'menu_font_color' => array(
            'default' => '#ffffff',
            'label' => __('Menu Font Color', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'type' => 'color',
        ),
        'menu_bg_color' => array(
            'default' => '#660000',
            'label' => __('Menu Background Color', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'type' => 'color',
        ),
        'menu_hover_font_color' => array(
            'default' => '#660000',
            'label' => __('Menu Hover Font Color', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'type' => 'color',
        ),
        'menu_hover_bg_color' => array(
            'default' => '#ffffff',
            'label' => __('Menu Hover Background Color', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'type' => 'color',
        ),
        'menu_current_font_color' => array(
            'default' => '#000066',
            'label' => __('Menu Current Font Color', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'type' => 'color',
        ),
        'menu_current_bg_color' => array(
            'default' => '#ffffff',
            'label' => __('Menu Current Background Color', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'type' => 'color',
        ),
        'menu_vertical_padding' => array(
            'default' => 10,
            'label' => __('Vertical Menu Padding', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'description' => esc_html__('In Pixels'),
            'type' => 'number',
            'class' => 'my-class'
        ),
        'menu_font_size' => array(
            'default' => '',
            'label' => __('Menu Font Size', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'description' => esc_html__('Use unit (px, em ...)'),
            'type' => 'text',
        ),
        'menu_horizontal_padding' => array(
            'default' => 15,
            'label' => __('Horizontal Menu Padding', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'description' => esc_html__('In Pixels'),
            'type' => 'number',
        ),
        'menu_desktop_font_size' => array(
            'default' => '',
            'label' => __('Desktop Menu Font Size', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'description' => esc_html__('on devices less than 1200px, Use unit (px, em ...)'),
            'type' => 'text',
        ),
        'menu_desktop_horizontal_padding' => array(
            'default' => 0,
            'label' => __('Desktop Horzontal Menu Padding', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'description' => esc_html__('on devices less than 1200px'),
            'type' => 'number',
        ),
        'menu_tablet_font_size' => array(
            'default' => '',
            'label' => __('Tablet Menu Font Size', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'description' => esc_html__('on devices less than 900px. Use unit (px, em ...)'),
            'type' => 'text',
        ),
        'menu_tablet_horizontal_padding' => array(
            'default' => 0,
            'label' => __('Tablet Horzontal Menu Padding', 'jma_gbs'),
            'section' => 'jma_gbs_menu',
            'description' => esc_html__('on devices less than 900px'),
            'type' => 'number',
        ),
        'use_menu_root_dividers' => array(
            'default' => 1,
            'label' => __('Use Dividers on Menu Root?', 'jma_gbs'),
            'description' => esc_html__('Use a border between menu items'),
            'section' => 'jma_gbs_menu',
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
            'section' => 'jma_gbs_menu',
            'type' => 'radio',
            'choices' => array(
                1 => 'Yes',
                0 => 'No'
            )
        ),
        'menu_root_font_color' => array(
            'default' => '',
            'label' => __('Menu Root Font Color', 'jma_gbs'),
            'description' => esc_html__('Clear to inherit from main menu font option'),
            'section' => 'jma_gbs_menu',
            'type' => 'color',
        ),
        'menu_root_hover_font_color' => array(
            'default' => '',
            'label' => __('Menu Root Hover Font Color', 'jma_gbs'),
            'description' => esc_html__('Clear to inherit from main menu hover font option'),
            'section' => 'jma_gbs_menu',
            'type' => 'color',
        ),
        'menu_root_current_font_color' => array(
            'default' => '',
            'label' => __('Menu Root Current Font Color', 'jma_gbs'),
            'description' => esc_html__('Clear to inherit from main menu current font option'),
            'section' => 'jma_gbs_menu',
            'type' => 'color',
        ),
        'menu_highlight' => array(
            'default' => '',
            'label' => __('Add a highlight bar above or below the current and hover menu items', 'jma_gbs'),
            'description' => '',
            'section' => 'jma_gbs_menu',
            'type' => 'radio',
            'choices' => array(
                0 => 'None',
                'top' => 'Top',
                'bottom' => 'Bottom'
            )
        ),
        'add_search'  => array(
            'default' => '',
            'label' => __('add search icon to right of main menu', 'jma_gbs'),
            'description' => '',
            'section' => 'jma_gbs_menu',
            'type' => 'radio',
            'choices' => array(
                0 => 'No',
                1 => 'Yes'
            )
        )
);
