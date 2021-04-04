<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

function jma_gbs_customize_save_after()
{
    delete_transient('jma_gbs_general_css');

    global $wpdb;

    $plugin_options = $wpdb->get_results("SELECT option_name FROM $wpdb->options WHERE option_name LIKE '_transient_jma_gbs_get_theme_mods%' OR option_name LIKE '_transient_timeout_jma_gbs_get_theme_mods%'");

    foreach ($plugin_options as $option) {
        delete_option($option->option_name);
    }
}
add_action('customize_save_after', 'jma_gbs_customize_save_after');
//add_action('customize_controls_print_scripts', 'jma_gbs_customize_save_after', 10);

function JMA_GBS_enqueue_css_js()
{
    $min = WP_DEBUG? '': '.min';
    // wp_enqueue_style( $handle, $src, $deps, $ver, $media );
    wp_enqueue_style('JMA_GBS_superfish_css', JMA_GBS_BASE_URI . 'dist/css/superfish' . $min . '.css', array(), JMA_GBS_VERSION);
    wp_enqueue_style('JMA_GBS_combined_css', JMA_GBS_BASE_URI . 'css/style.css', array(), JMA_GBS_VERSION);
    if ( ! wp_style_is( 'kadence-blocks-rowlayout', 'enqueued' ) ) {
			wp_enqueue_style( 'kadence-blocks-rowlayout' );
		}

    // wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
    // NOTE: this combined script is loading in the footer

    wp_enqueue_script('JMA_GBS_combined_js', JMA_GBS_BASE_URI . 'js/javascript' . $min . '.js', array('jquery'), JMA_GBS_VERSION, true);

    wp_enqueue_script('JMA_GBS_hover_js', JMA_GBS_BASE_URI . 'dist/js/hoverIntent' . $min . '.js', array('jquery'), JMA_GBS_VERSION, true);
    wp_enqueue_script('JMA_GBS_superfish_js', JMA_GBS_BASE_URI . 'dist/js/superfish' . $min . '.js', array('jquery'), JMA_GBS_VERSION, true);
    wp_enqueue_script('JMA_GBS_supersubs_js', JMA_GBS_BASE_URI . 'dist/js/supersubs' . $min . '.js', array('jquery'), JMA_GBS_VERSION, true);

    wp_enqueue_script('JMA_GBS_custom_js', JMA_GBS_BASE_URI . 'dist/js/custom' . $min . '.js', array('jquery'), JMA_GBS_VERSION, true);
    wp_enqueue_script('JMA_GBS_bootstrap_js', JMA_GBS_BASE_URI . 'js/vendor/bootstrap/bootstrap.bundle.min.js', array('jquery'), JMA_GBS_VERSION, false);

    $output = get_transient('jma_gbs_general_css');
    if (false == $output) {
        // It wasn't there, so regenerate the data and save the transient
        $mods = jma_gbs_get_theme_mods('jma_gbs_');
        $css = array();
        require_once(JMA_GBS_BASE_DIRECTORY . 'jma-css/css.php');

        $output = jma_gbs_process_css_array($css);
        set_transient('jma_gbs_general_css', $output);
    }
    wp_add_inline_style('JMA_GBS_combined_css', $output);
}
add_action('wp_enqueue_scripts', 'JMA_GBS_enqueue_css_js');

function JMA_GBS_admin_enqueue_css_js()
{
    $min = WP_DEBUG? '': '.min';
    wp_enqueue_style('JMA_GBS_superfish_css', JMA_GBS_BASE_URI . 'dist/css/superfish' . $min . '.css', array(), JMA_GBS_VERSION);
    wp_enqueue_style('JMA_GBS_combined_css', JMA_GBS_BASE_URI . 'css/style.css', array(), JMA_GBS_VERSION);
}
add_action('admin_enqueue_scripts', 'JMA_GBS_admin_enqueue_css_js');

function JMA_GBS_customizer_live_preview()
{
    jma_gbs_customize_save_after();
}
add_action('customize_preview_init', 'JMA_GBS_customizer_live_preview', -1);

function JMA_GBS_customize_controls_enqueue_scripts()
{
    wp_enqueue_script('JMA_GBS_customizer_js', JMA_GBS_BASE_URI . 'dist/js/customizer.js', array('jquery'), JMA_GBS_VERSION, true);
}
add_action('customize_controls_enqueue_scripts', 'JMA_GBS_customize_controls_enqueue_scripts');

function JMA_GBS_enqueue_admin_styles()
{
    $output = '.customize-control input[type=number] {max-width:100px}';

    wp_add_inline_style('genesis_admin_css', $output);
}
add_action('admin_print_styles', 'JMA_GBS_enqueue_admin_styles');
