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
    'custom' => 'Custom Font Family'
);

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

    $config['genesis']['sections']['jma_gbs_uagb_menu']= array(
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

    $config['genesis']['sections']['jma_gbs_uagb_comps']= array(
        'title'          => __('--Ultimate Addons for Gutenberg', 'genesis'),
        'description'    => __('Settings for UAGB Components', 'genesis'),
        'panel'          => 'genesis',
        'priority'       => 57,
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
    wp_add_inline_style('uagb-block-common-editor-css', '.block-editor__container .wp-block[data-type*="uagb/section"], .block-editor__container .wp-block[data-type*="uagb/columns"], .wp-block {max-width: 1510px;}.block-editor-page #wpwrap .wp-block .wp-block-uagb-column .uagb-column__inner-wrap {padding: 0;}.wp-block[data-type*="jma-ghb/logo-block"] a, .wp-block[data-type*="jma-ghb/menu-block"] a {pointer-events: none;}');
}
add_action('admin_enqueue_scripts', 'jma_gbs_backend_custom_css');
