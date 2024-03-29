<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

// Add HTML5 markup structure
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );


// Remove structural Wraps
remove_theme_support('genesis-structural-wraps');

//avoid confussion by using plugin title toggling only
remove_post_type_support( 'page', 'genesis-title-toggle' );

// Remove item(s) from genesis admin screens
add_action('genesis_admin_before_metaboxes', 'JMA_GBS_remove_genesis_theme_metaboxes', 999);
//$config['genesis']['sections']['genesis_single']


// Remove item(s) from genesis customizer
//add_action('customize_register', 'JMA_GBS_remove_genesis_customizer_controls', 999);

/**
 * Remove selected Genesis metaboxes from the Theme Settings and SEO Settings pages.
 *
 * @param string $hook The unique pagehook for the Genesis settings page
 */

function JMA_GBS_remove_genesis_theme_metaboxes($hook)
{
    /** Theme Settings metaboxes */
    //remove_meta_box( 'genesis-theme-settings-version',  $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-feeds',    $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-layout',   $hook, 'main' );
    remove_meta_box('genesis-theme-settings-header', $hook, 'main');
    //remove_meta_box( 'genesis-theme-settings-nav',      $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-breadcrumb', $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-comments', $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-posts',    $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-blogpage', $hook, 'main' );
    //remove_meta_box( 'genesis-theme-settings-scripts',  $hook, 'main' );

    /** SEO Settings metaboxes */
    //remove_meta_box( 'genesis-seo-settings-doctitle',   $hook, 'main' );
    //remove_meta_box( 'genesis-seo-settings-homepage',   $hook, 'main' );
    //remove_meta_box( 'genesis-seo-settings-dochead',    $hook, 'main' );
    //remove_meta_box( 'genesis-seo-settings-robots',     $hook, 'main' );
    //remove_meta_box( 'genesis-seo-settings-archives',   $hook, 'main' );
}

/**
 * Filter to remove selected Genesis Customizer Menu controls
 *
 * @param instance of WP_Customize_Manager $wp_customize
 */
function JMA_GBS_remove_genesis_customizer_controls($wp_customize)
{
    // remove Site Title/Logo: Dynamic Text or Image Logo option from Customizer
    //$wp_customize->remove_control('genesis_blog_title');
    return $wp_customize;
}
