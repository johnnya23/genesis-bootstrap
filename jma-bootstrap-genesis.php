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
define('JMA_GBS_BASE_DIRECTORY', plugin_dir_path(__FILE__));

 /**
  * URI to Genesis Bootstrap base directory.
  */
define('JMA_GBS_BASE_URI', plugin_dir_url(__FILE__));



function JMA_GBS_load_files()
{
    $folders = array('lib', 'jma_lib');

    foreach ($folders as $key => $folder) {
        foreach (glob(JMA_GBS_BASE_DIRECTORY . '/' . $folder . '/*.php') as $file) {
            include $file;
        }
    }
}
add_action('genesis_setup', 'JMA_GBS_load_files', 15);


function jma_gbs_customizer_control($wp_customize)
{/*
    $wp_customize->add_section('jma_gbs_header_controls_section', array(
    'panel' => 'jma_gbs_header_controls_panel',
        'title'      => __('Page', 'jma_gbs'),
        'priority'   => 30,
    ));
    $wp_customize->add_panel('jma_gbs_header_controls_panel', array(
        'title'      => __('JMA Panel', 'jma_gbs'),
        'priority'   => 30,
    ));*/
    $items = array();
    foreach (glob(JMA_GBS_BASE_DIRECTORY . 'settings/*.php') as $file) {
        $new = include $file;
        array_push($items, $new);
    }
    jma_gbs_settings_process($items, $wp_customize);
}
add_action('customize_register', 'jma_gbs_customizer_control');

function jma_gbs_header_css()
{
    $raw_mods = get_theme_mods();
    foreach ($raw_mods as $key => $raw_mod) {
        $mods[$key] = apply_filters("theme_mod_{$key}", $raw_mod);
    }
    require_once(JMA_GBS_BASE_DIRECTORY . 'jma-css/css.php');
    echo jma_gbs_process_css_array($css);
}
add_action('wp_head', 'jma_gbs_header_css');

function jma_gbs_get_header()
{
    $mods = get_theme_mods();
    if (get_theme_mod('jma_gbs_site_banner') == 1 && (!is_archive())) {
        remove_action('genesis_entry_header', 'genesis_do_post_title');
    }
}
add_action('template_redirect', 'jma_gbs_get_header');
