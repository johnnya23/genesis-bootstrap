<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

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
    $mods = get_transient('jma_gbs_get_theme_mods' . $pre);
    if (false == $mods) {
        $raw_mods = get_theme_mods();
        foreach ($raw_mods as $key => $raw_mod) {
            //if a prefix is passed we only process keys with that prefix
            if (!($pre && !(substr($key, 0, strlen($pre)) === $pre))) {
                $value = apply_filters("theme_mod_{$key}", $raw_mod);
                $key = str_replace($pre, '', $key);
                $mods[$key] = $value;
                $settings_array = jma_gbs_get_settngs();
                $defaults = $settings_array['defaults'];
                //grab all the defaults and cycle through
                foreach ($defaults as $default_key => $default) {
                    $key_adjust = str_replace($pre, '', $default_key);
                    if (!isset($mods[$key_adjust])) {
                        $mods[$key_adjust] = $defaults[$default_key];
                    }
                }
            }
        }
        set_transient('jma_gbs_get_theme_mods' . $pre, $mods);
    }
    return $mods;
}
