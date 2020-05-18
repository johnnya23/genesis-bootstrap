<?php

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
    foreach ($items as $item) {
        foreach ($item as $key => $values) {
            $key = $pre . $key;
            $setting = array('default' => '');
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


            if (count($setting) && count($control) > 1) {
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
