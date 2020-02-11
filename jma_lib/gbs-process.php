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
* structure_css_array creates nested array
*
*
* @param array $items items of be processed
* @return array $querys   [$query][$selector][$item][$attr] = $value
*/
function structure_css_array($items)
{
    $querys = array();
    foreach ($items as $item) {
        $query = 'none';
        //do we have a valid item
        if (is_array($item) && isset($item['selector']) && count($item) > 1) {
            if (isset($item['query']) && $item['query']) {
                $query = str_replace(array(' ', 'and'), array('', ' and '), $item['query']);
                unset($item['query']);
            }
            //open with selector(s)
            $selectors = explode(',', $item['selector']);
            unset($item['selector']);
            //the attr/value pairs plus selector and query elements
            foreach ($selectors as $selector) {
                $selectors_attr_vals = array();
                //echo $selector;
                $selector = trim(preg_replace('/\s+/', ' ', $selector));
                $selectors_attr_vals[$query][$selector] = $item;
                $querys = array_replace_recursive($querys, $selectors_attr_vals);
            }
        }
    }
    return $querys;
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
        $querys = structure_css_array($items);

        //step through all the queries
        foreach ($querys as $query => $selectors) {
            $text = $open = $close = '';
            //wrap it if there is a query
            if ($query != 'none') {
                $open = '@media ' . $query . '{';
                $close = '}';
            }
            //step through all the selectors
            foreach ($selectors as $selector => $item) {
                $text .= $selector . '{';
                foreach ($item as $attr => $value) {
                    //what's left are the attribute value pairs
                    $text .= $attr . ':' . $value . ';';
                }
                $text .='}';
            }
            $css .= $open . $text . $close;
        }
        $css .= '</style>';
    }

    return $css;
};
