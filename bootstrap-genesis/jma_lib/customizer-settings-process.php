<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
/**
* jma_gbs_settings_process creates customizer settings
*
*
* @param array $items items of be processed
* @param object $wp_customize
* @return $control  control members of $wp_customize
* @return $setting  setting members of $wp_customize
*/
function jma_gbs_settings_process($items, $wp_customize, $pre = '')
{
    $mods = jma_gbs_get_theme_mods();
    foreach ($items as $item) {
        foreach ($item as $key => $values) {
            $key = $pre . $key;
            //if the mod is not set and the default is we set the mod to default
            if ((!(isset($mods[$key]) && ($mods[$key] || $mods[$key] == 0))) && isset($values['default']) && $values['default']) {
                set_theme_mod($key, $values['default']);
            }
            switch ($values['type']) {
                case 'text':
                case 'textarea':
                case 'radio':
                case 'checkbox':
                case 'select':
                    $sanitizer = 'wp_filter_nohtml_kses';
                    break;
                case 'image':
                    $sanitizer = 'esc_url_raw';
                    break;
                case 'color':
                    $sanitizer = 'sanitize_hex_color';
                    break;
                    //this will catch number
                default:
                    $sanitizer = 'absint';
            }
            $setting = array('default' => '', 'sanitize_callback' => $sanitizer);
            $control = array('settings' => $key);
            if (is_array($values)) {
                foreach ($values as $index => $value) {
                    if ($index != 'default') {
                        $control[$index] = $value;
                    } else {
                        $setting[$index] = $value;
                    }
                }
            }


            if (count($control) > 1) {
                $wp_customize->add_setting(
                $key,
                $setting
            );
                if (isset($control['type'])) {
                    if ($control['type'] == 'color') {
                        $wp_customize->add_control(
                            new WP_Customize_Color_Control(
                                $wp_customize,
                                $key . '_control',
                                $control
                            )
                        );
                    } elseif ($control['type'] == 'image') {
                        $wp_customize->add_control(
                            new WP_Customize_Image_Control(
                                $wp_customize,
                                $key . '_control',
                                $control
                            )
                        );
                    } else {
                        $wp_customize->add_control(
                            $key . '_control',
                            $control
                        );
                    }
                }
            }
        }
    }
}
