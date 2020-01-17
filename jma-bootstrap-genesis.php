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

add_action('genesis_setup', 'JMA_GBS_load_lib_files', 15);

function JMA_GBS_load_lib_files()
{
    foreach (glob(JMA_GBS_BASE_DIRECTORY . '/lib/*.php') as $file) {
        include $file;
    }
}
function jma_gbs_add_blocks()
{
    require_once JMA_GBS_BASE_DIRECTORY . 'blocks/menu/index.php';
    require_once JMA_GBS_BASE_DIRECTORY . 'blocks/logo/index.php';
}
add_action('after_setup_theme', 'jma_gbs_add_blocks');

function jma_gbs_customizer($wp_customize)
{
    $wp_customize->add_section('jma_gbs_header_controls_section', array(
        'title'      => __('Header', 'jma_gbs'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting(
        'jma_gbs_header_page',
        array(
            'default' => '',
            'transport' => 'refresh'
        )
    );
    $wp_customize->add_control(
            'jma_gbs_header_page_control',
            array(
                'label' => __('Page for Header', 'jma_gbs'),
                'description' => esc_html__('Page that will provide header content.'),
                'section' => 'jma_gbs_header_controls_section',
                'settings'   => 'jma_gbs_header_page',
                'type' => 'dropdown-pages'
            )
    );
}
add_action('customize_register', 'jma_gbs_customizer', 9999);

/**
 *

 */
function bsg_unload_framework()
{
    //echo get_theme_mod('jma_gbs_header_page'). 'dddd';
    if (defined('GENESIS_LOADED_FRAMEWORK') && get_theme_mod('jma_gbs_header_page') != 0) {
        remove_action('genesis_after_header', 'genesis_do_subnav');
        remove_action('genesis_after_header', 'genesis_do_nav');

        remove_action('genesis_header', 'genesis_do_header');

        if (!is_page(get_theme_mod('jma_gbs_header_page'))) {
            add_action('genesis_header', 'jma_gbs_do_header');
        }
    }
}
add_action('genesis_init', 'bsg_unload_framework', 99);

function jma_gbs_do_header()
{
    echo apply_filters('the_content', get_the_content(null, false, get_theme_mod('jma_gbs_header_page')));
}
