<?php

define('JMA_GBS_BASE_DIRECTORY', trailingslashit(plugin_dir_path(__FILE__)));

 /**
  * URI to Genesis Bootstrap base directory.
  */
define('JMA_GBS_BASE_URI', trailingslashit(plugin_dir_url(__FILE__)));

// $content_width is a "reserved" variable which is used by Ultimate Addons
// to set inner width when "inherit from theme" is selected in Sections
if (! isset($content_width)) {
    $content_width = get_theme_mod('jma_gbs_site_width');
}

$families = array(
    'georgia' => 'Georgia, serif',
    'palatino' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
    'times' => '"Times New Roman", Times, serif',
    'arial' => 'Arial, Helvetica, sans-serif',
    'comic' => '"Comic Sans MS", cursive, sans-serif',
    'impact' => 'Impact, Charcoal, sans-serif',
    'lucinda' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
    'tahoma' => 'Tahoma, Geneva, sans-serif',
    'trebuchet' => '"Trebuchet MS", Helvetica, sans-serif',
    'verdana' => 'Verdana, Geneva, sans-serif',
    'courier' => '"Courier New", Courier, monospace',
    'console' => '"Lucida Console", Monaco, monospace',
    //'custom' => 'Custom Font Family',
);

function jma_gbs_get_settngs()
{
    $return = array();
    $defaults = array();
    $pages = array();


    foreach (glob(JMA_GBS_BASE_DIRECTORY . 'settings/*.php') as $file) {
        $new = include $file;
        array_push($pages, $new);
    }
    foreach ($pages as $settings) {
        foreach ($settings as $key => $setting) {
            if (isset($setting['default'])) {
                $defaults['jma_gbs_' . $key] = $setting['default'];
            } else {
                $defaults['jma_gbs_' . $key] = '';
            }
        }
    }

    /*echo '<pre>www';
    print_r($defaults);
    echo '</pre>';*/
    return array('settings' => $pages, 'defaults' => $defaults);
}

/**
* jma_gbs_customizer_control pulls values from seetings folder and
* uses jma_gbs_settings_process to register customizer settings
* on the customize_register hook
*
* @param object $wp_customize
*/
function jma_gbs_customizer_control($wp_customize)
{
    $pages_array = jma_gbs_get_settngs();
    $items = $pages_array['settings'];
    //adds the prefix
    jma_gbs_settings_process($items, $wp_customize, 'jma_gbs_');
}

function JMA_GBS_load_files()
{
    $folders = array('lib', 'jma_lib');

    foreach ($folders as $key => $folder) {
        foreach (glob(JMA_GBS_BASE_DIRECTORY . $folder . '/*.php') as $file) {
            include $file;
        }
    }

    add_action('customize_register', 'jma_gbs_customizer_control');
}
add_action('genesis_setup', 'JMA_GBS_load_files', 15);


/**
 * prioritize existing sections and add new ones
 * @param  array $config filtered val
 * @return array $config val after filtering
 *
 */
function jma_gbs_customizer_theme_settings_config($config)
{
    $config['genesis']['sections']['genesis_updates']['priority'] = 20;
    $config['genesis']['sections']['genesis_header']['priority'] = 30;

    $config['genesis']['sections']['genesis_layout']['priority'] = 50;
    $config['genesis']['sections']['genesis_breadcrumbs']['priority'] = 60;
    $config['genesis']['sections']['genesis_comments']['priority'] = 70;
    $config['genesis']['sections']['genesis_single']['priority'] = 80;
    $config['genesis']['sections']['genesis_single']['title'] = 'Pages/Posts';
    $config['genesis']['sections']['genesis_archives']['priority'] = 90;
    $config['genesis']['sections']['genesis_footer']['priority'] = 100;
    $config['genesis']['sections']['genesis_scripts']['priority'] = 110;

    $config['genesis']['sections']['jma_gbs_menu']= array(
        'title'          => __('--Menu Settings', 'genesis'),
        //'description'    => __('all values are px', 'genesis'),
        'panel'          => 'genesis',
        'priority'       => 32,
        'controls'       => null
    );

    $config['genesis']['sections']['jma_gbs_fonts']= array(
        'title'          => __('--Font Settings', 'genesis'),
        'description'    => __('all values are px', 'genesis'),
        'panel'          => 'genesis',
        'priority'       => 52,
        'controls'       => null
    );

    $config['genesis']['sections']['jma_gbs_buttons']= array(
        'title'          => __('--Button Settings', 'genesis'),
        'description'    => __('all values are px', 'genesis'),
        'panel'          => 'genesis',
        'priority'       => 54,
        'controls'       => null
    );
    return $config;
}
add_filter('genesis_customizer_theme_settings_config', 'jma_gbs_customizer_theme_settings_config');

/**
 * adds width to backend display
 *
 */
 function jma_gbs_backend_custom_css()
 {
     wp_add_inline_style('JMA_ghb_superfish_css', '.wp-block {max-width: 1510px;}[data-type*="jma-ghb/logo-block"] a, [data-type*="jma-ghb/menu-block"] a {pointer-events: none;} [data-type*="jma-ghb/logo-block"], [data-type="jma-ghb/menu-block"] {min-height: 75px}');
 }
 add_action('admin_enqueue_scripts', 'jma_gbs_backend_custom_css');

/* add a reusabel blocks button */
function jma_gbs_reuseable_url()
{
    add_menu_page('jma_gbs_reuseable_url', 'Reuseable Blocks', 'read', 'reuseable_url', '', 'dashicons-smiley', 7);
}
add_action('admin_menu', 'jma_gbs_reuseable_url');


function jma_gbs_reuseable_url_function()
{
    global $menu;
    $menu[7][2] = site_url('wp-admin/edit.php?post_type=wp_block');
}
add_action('admin_menu', 'jma_gbs_reuseable_url_function');

/* disables fullscreen mode as default interface */
if (is_admin()) {
    function jma_gbs_disable_editor_fullscreen_by_default()
    {
        $script = "window.addEventListener('load', (event) => { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
        wp_add_inline_script('wp-blocks', $script);
    }
    add_action('enqueue_block_editor_assets', 'jma_gbs_disable_editor_fullscreen_by_default');
}
