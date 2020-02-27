<?php

// replace style.css - Theme Information (no css)
// with css/style.min.css -  Compressed CSS for Theme
remove_action('genesis_meta', 'genesis_load_stylesheet');
add_action('wp_enqueue_scripts', 'JMA_GBS_enqueue_css_js');
add_action('customize_controls_enqueue_scripts', 'JMA_GBS_customize_controls_enqueue_scripts');

function JMA_GBS_enqueue_css_js()
{
    $version = wp_get_theme()->Version;

    // wp_enqueue_style( $handle, $src, $deps, $ver, $media );
    wp_enqueue_style('JMA_GBS_combined_css', JMA_GBS_BASE_URI . 'css/css/style.css', array(), $version);
    wp_enqueue_style('JMA_GBS_superfish_css', JMA_GBS_BASE_URI . 'dist/css/superfish.min.css', array(), $version);
    wp_enqueue_style('JMA_GBS_custom_css', JMA_GBS_BASE_URI . 'css/custom-style.min.css', array(), $version);

    // wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
    // NOTE: this combined script is loading in the footer
    wp_enqueue_script('JMA_GBS_combined_js', JMA_GBS_BASE_URI . 'js/javascript.min.js', array('jquery'), $version, true);
    wp_enqueue_script('JMA_GBS_superfish_js', JMA_GBS_BASE_URI . 'dist/js/superfish.min.js', array('jquery'), $version, true);
    wp_enqueue_script('JMA_GBS_hover_js', JMA_GBS_BASE_URI . 'dist/js/hoverIntent.min.js', array('jquery'), $version, true);
    wp_enqueue_script('JMA_GBS_custom_js', JMA_GBS_BASE_URI . 'dist/js/custom.js', array('jquery'), $version, true);
}
function JMA_GBS_customize_controls_enqueue_scripts()
{
    wp_enqueue_script('JMA_GBS_customizer_js', JMA_GBS_BASE_URI . 'dist/js/customizer.js', array('jquery'), $version, true);
}
