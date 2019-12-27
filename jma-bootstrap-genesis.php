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
    foreach (glob(dirname(__FILE__) . '/lib/*.php') as $file) {
        include $file;
    }
}
function jma_gbs_add_customizer()
{
    require_once trailingslashit(dirname(__FILE__)) . 'customizer/functions.php';
}
//add_action('after_setup_theme', 'jma_gbs_add_customizer');

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
