<?php

/**
* jma_gbs_get_theme_mods uses wordpress get_theme_mods function
* to get all theme mods THEN filters each result with the
* theme_mod_{$key} to allow the results to be displayed
* immediately in the customizer
*
* @param string $pre optional prefix to be stripped from array keys
* @param array $clean_px mod indexs that need to have the string 'px' stgripped out
* @return array $mods the same array as get_theme_mods only filter is
* applied and (optionally) $prefix is stripped
*/
function jma_gbs_get_theme_mods($pre = '')
{
    $raw_mods = get_theme_mods();
    $mods = array();
    foreach ($raw_mods as $key => $raw_mod) {
        //if a prefix is passed we only process keys with that prefix
        if (!($pre && !(substr($key, 0, strlen($pre)) === $pre))) {
            $value = apply_filters("theme_mod_{$key}", $raw_mod);
            $key = str_replace($pre, '', $key);
            $mods[$key] = $value;
        }
    }
    return $mods;
}

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
                //get rid of any double spaces
                $selector = trim(preg_replace('/\s+/', ' ', $selector));
                //makes the selector the index of an array within the query
                //and leavves attr/value pairs as index/value pairs within the
                // $selector array
                $selectors_attr_vals[$query][$selector] = $item;
                //this will have the affect of combining like selectors
                //in output for this query
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
                    //make sure its not blank
                    if ($value) {
                        //what's left are the attribute value pairs
                        $text .= $attr . ':' . $value . ';';
                    }
                }
                $text .='}';
            }
            $css .= $open . $text . $close;
        }
    }

    return $css;
};

/**
 * function jma_uagb_detect_block Detect full width blocks
 * we don't have to drill down below the first level in detectin full width
 * @return boolean $return
 */
function jma_gbs_detect_block($name, $key = '', $value = '')
{
    global $post;
    $return = false;

    if (function_exists('has_blocks') && has_blocks($post->post_content)) {
        $blocks = parse_blocks($post->post_content);

        if (is_array($blocks)) {
            foreach ($blocks as $block) {
                if (!$name || $name == $block['blockName']) {
                    //if value is set for $key or $value we require a match
                    if ($key || $value) {
                        if (isset($block['attrs'][$key]) && $block['attrs'][$key] == $value) {
                            $return = true;
                        } elseif ($name && $name == $block['blockName']) {
                            // else matching the block name is good enough
                            $return = true;
                        }
                    }
                }
            }
        }
    }

    return $return;
}
