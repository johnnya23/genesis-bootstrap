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
function jma_gbs_settings_process($items, $wp_customize, $pre = 'jma_gbs_')
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

/**
* jma_gbs_process_css_array creates css string from array
*
*
* @param array $items items of be processed
* @return string $css   css for wp_head
*/
function jma_gbs_process_css_array($items)
{
    $css = '';
    if (is_array($items)) {
        $css .= '<style type="text/css" media="screen">';
        $querys = array();
        foreach ($items as $item) {
            $selectors_attr_vals = '';
            $query = 'none';
            //do we have a valid item
            if (is_array($item) && isset($item['selector']) && count($item) > 1) {
                //open with selector
                $selectors_attr_vals .= $item['selector'] . '{';
                //the attr/value pairs plus selector and query elements
                foreach ($item as $attr => $value) {
                    //we dont want to process these 2 below
                    if ($attr == 'query' || $attr == 'selector') {
                        //if a query is present we assign the value and we disregard the selector
                        if ($attr == 'query') {
                            $query = str_replace(' ', '', $value);
                        }
                    } else {
                        //what's left are the attribute value pairs
                        $selectors_attr_vals .= $attr . ':' . $value . ';';
                    }
                }
                //close it
                $selectors_attr_vals .= '}';
            }
            //build and array of all queries $query => $text
            $querys[$query] .= $selectors_attr_vals;
        }
        //step through all the queries
        foreach ($querys as $query => $text) {
            $open = $close = '';
            //wrap it if there is a query
            if ($query != 'none') {
                $open = '@media(' .$query . '){';
                $close = '}';
            }

            $css .= $open . $text . $close;
        }
        $css .= '</style>';
    }

    return $css;
};
