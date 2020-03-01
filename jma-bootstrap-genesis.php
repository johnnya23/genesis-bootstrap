<?php
/**
*Plugin Name: Bootstrap with Genesis
*Description: child theme to plugin
*Version: 1.0
*Author: John Antonacci
*Author URI: https://gist.github.com/theandystratton/5924570
*License: GPL2
 */
/**
 * Include all php files in the /includes directory
 *
 * https://gist.github.com/theandystratton/5924570
 */

 /**
  * Absolute file path to Genesis Bootstrap base directory.
  */
define('JMA_GBS_BASE_DIRECTORY', trailingslashit(plugin_dir_path(__FILE__)));

 /**
  * URI to Genesis Bootstrap base directory.
  */
define('JMA_GBS_BASE_URI', trailingslashit(plugin_dir_url(__FILE__)));



function JMA_GBS_load_files()
{
    $folders = array('lib', 'jma_lib');

    foreach ($folders as $key => $folder) {
        foreach (glob(JMA_GBS_BASE_DIRECTORY . $folder . '/*.php') as $file) {
            include $file;
        }
    }
}
add_action('genesis_setup', 'JMA_GBS_load_files', 15);

/**
* jma_gbs_customizer_control pulls values from seetings folder and
* uses jma_gbs_settings_process to register customizer settings
* on the customize_register hook
*
* @param object $wp_customize
*/
function jma_gbs_customizer_control($wp_customize)
{
    $items = array();
    foreach (glob(JMA_GBS_BASE_DIRECTORY . 'settings/*.php') as $file) {
        $new = include $file;
        array_push($items, $new);
    }
    jma_gbs_settings_process($items, $wp_customize);
}
add_action('customize_register', 'jma_gbs_customizer_control');

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

function jma_gbs_header_css()
{
    $clean_px = array('site_width', 'frame_border_width', 'frame_border_radius', 'header_border_width', 'header_border_radius', 'footer_border_width', 'footer_border_radius');
    $mods = jma_gbs_get_theme_mods('jma_gbs_');
    require_once(JMA_GBS_BASE_DIRECTORY . 'jma-css/css.php');
    //$css = apply_filters('jma_gbs_header_css', $css, $mods);
    echo jma_gbs_process_css_array($css);
}
add_action('wp_head', 'jma_gbs_header_css');



function jma_gbs_open_div()
{
    echo '<div class="jma-gbs-inner">';
}

function jma_gbs_close_div()
{
    echo '</div>';
}


function jma_gbs_template_redirect()
{
    add_action('genesis_header', 'jma_gbs_open_div', 7);
    add_action('genesis_header', 'jma_gbs_close_div', 13);

    add_action('genesis_before_loop', 'jma_gbs_open_div');
    add_action('genesis_after_loop', 'jma_gbs_close_div');

    add_action('genesis_before_sidebar_widget_area', 'jma_gbs_open_div');
    add_action('genesis_after_sidebar_widget_area', 'jma_gbs_close_div');

    add_action('genesis_footer', 'jma_gbs_open_div', 7);
    add_action('genesis_footer', 'jma_gbs_close_div', 13);

    if ($mods['jma_gbs_site_banner'] == 1 && (!is_archive())) {
        remove_action('genesis_entry_header', 'genesis_do_post_title');
        add_action('genesis_header', 'genesis_do_post_title', 9);
    }
}
add_action('template_redirect', 'jma_gbs_template_redirect');

function jma_gbs_body_filter($cl)
{
    $border_items = array('jma_gbs_modular_header', 'jma_gbs_frame_content', 'jma_gbs_modular_footer', 'jma_gbs_use_menu_root_dividers');
    $mods = jma_gbs_get_theme_mods();
    foreach ($border_items as $key => $border_item) {
        if ($mods[$border_item] === 'yes') {
            $cl[] = $border_item;
        } else {
            $cl[] = str_replace('jma_gbs_', 'jma_gbs_non_', $border_item);
        }
    }
    $cl[] = $mods['jma_gbs_body_shape'];
    return $cl;
}
add_filter('body_class', 'jma_gbs_body_filter');
