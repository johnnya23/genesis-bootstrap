<?php

// replace style.css - Theme Information (no css)
// with css/style' . $min . '.css -  Compressed CSS for Theme
remove_action('genesis_meta', 'genesis_load_stylesheet');
add_action('wp_enqueue_scripts', 'JMA_GBS_enqueue_css_js');
add_action('customize_controls_enqueue_scripts', 'JMA_GBS_customize_controls_enqueue_scripts');

function JMA_GBS_enqueue_css_js()
{
    $min = WP_DEBUG? '': '.min';
    // wp_enqueue_style( $handle, $src, $deps, $ver, $media );
    wp_enqueue_style('JMA_GBS_combined_css', JMA_GBS_BASE_URI . 'css/css/style.css', array(), JMA_GBS_VERSION);
    wp_enqueue_style('JMA_GBS_superfish_css', JMA_GBS_BASE_URI . 'dist/css/superfish' . $min . '.css', array(), JMA_GBS_VERSION);
    wp_enqueue_style('JMA_GBS_custom_css', JMA_GBS_BASE_URI . 'css/custom-style' . $min . '.css', array(), JMA_GBS_VERSION);
    //wp_enqueue_style('JMA_GBS_fontawesome_css', JMA_GBS_BASE_URI . 'fonts/css/all' . $min . '.css', array(), JMA_GBS_VERSION);
    wp_enqueue_style('JMA_GBS_fontawesome_brands_css', JMA_GBS_BASE_URI . 'fonts/css/brands' . $min . '.css', array(), JMA_GBS_VERSION);
    wp_enqueue_style('JMA_GBS_fontawesome_solid_css', JMA_GBS_BASE_URI . 'fonts/css/solid' . $min . '.css', array(), JMA_GBS_VERSION);



    //wp_enqueue_script('JMA_GBS_fontawesome_js', JMA_GBS_BASE_URI . 'fonts/js/all' . $min . '.js', array('jquery'), JMA_GBS_VERSION);
    wp_enqueue_script('JMA_GBS_fontawesome_brands_js', JMA_GBS_BASE_URI . 'fonts/js/brands' . $min . '.js', array('jquery'), JMA_GBS_VERSION);
    wp_enqueue_script('JMA_GBS_fontawesome_solid_js', JMA_GBS_BASE_URI . 'fonts/js/solid' . $min . '.js', array('jquery'), JMA_GBS_VERSION);

    // wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
    // NOTE: this combined script is loading in the footer
    wp_enqueue_script('JMA_GBS_combined_js', JMA_GBS_BASE_URI . 'js/javascript' . $min . '.js', array('jquery'), JMA_GBS_VERSION, true);
    //wp_enqueue_script('JMA_GBS_fontawesome_js', 'https://kit.fontawesome.com/adfc710317.js', null, JMA_GBS_VERSION, true);
    wp_enqueue_script('JMA_GBS_hover_js', JMA_GBS_BASE_URI . 'dist/js/hoverIntent' . $min . '.js', array('jquery'), JMA_GBS_VERSION, true);
    wp_enqueue_script('JMA_GBS_superfish_js', JMA_GBS_BASE_URI . 'dist/js/superfish' . $min . '.js', array('jquery'), JMA_GBS_VERSION, true);
    wp_enqueue_script('JMA_GBS_supersubs_js', JMA_GBS_BASE_URI . 'dist/js/supersubs' . $min . '.js', array('jquery'), JMA_GBS_VERSION, true);
    wp_enqueue_script('JMA_GBS_custom_js', JMA_GBS_BASE_URI . 'dist/js/custom' . $min . '.js', array('jquery'), JMA_GBS_VERSION, true);

    $mods = jma_gbs_get_theme_mods('jma_gbs_');
    require_once(JMA_GBS_BASE_DIRECTORY . 'jma-css/css.php');
    
    //$css = apply_filters('jma_gbs_header_css', $css, $mods);
    $output = jma_gbs_process_css_array($css);
    wp_add_inline_style('JMA_GBS_combined_css', $output);
}
function JMA_GBS_customize_controls_enqueue_scripts()
{
    wp_enqueue_script('JMA_GBS_customizer_js', JMA_GBS_BASE_URI . 'dist/js/customizer.js', array('jquery'), JMA_GBS_VERSION, true);
}
