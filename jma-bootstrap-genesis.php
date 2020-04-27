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

if (! function_exists('get_plugin_data')) {
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

$plugin_data = get_plugin_data(__FILE__);

function JMA_GBS_admin_notice()
{
    if (!is_plugin_active('ultimate-addons-for-gutenberg/ultimate-addons-for-gutenberg.php')) {
        echo '<div class="notice notice-warning is-dismissible">
             <p>The Bootstrap with Genesis plugin recommends <a href="https://wordpress.org/plugins/ultimate-addons-for-gutenberg/" target="_blank">Ultimate Addons for Gutenberg</a> plugin</p>
         </div>';
    }
}
add_action('admin_notices', 'JMA_GBS_admin_notice');

define('JMA_GBS_VERSION', $plugin_data['Version']);

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

function jma_gbs_customizer_theme_settings_config($config)
{
    $config['genesis']['sections']['genesis_updates']['priority'] = 20;
    $config['genesis']['sections']['genesis_header']['priority'] = 30;

    $config['genesis']['sections']['genesis_layout']['priority'] = 50;
    $config['genesis']['sections']['genesis_breadcrumbs']['priority'] = 60;
    $config['genesis']['sections']['genesis_comments']['priority'] = 70;
    $config['genesis']['sections']['genesis_single']['priority'] = 80;
    $config['genesis']['sections']['genesis_archives']['priority'] = 90;
    $config['genesis']['sections']['genesis_footer']['priority'] = 100;
    $config['genesis']['sections']['genesis_scripts']['priority'] = 110;

    $config['genesis']['sections']['jma_uagb_menu']= array(
        'title'          => __('--Menu Settings', 'genesis'),
        //'description'    => __('all values are px', 'genesis'),
        'panel'          => 'genesis',
        'priority'       => 32,
        'controls'       => null
    );

    $config['genesis']['sections']['jma_uagb_buttons']= array(
        'title'          => __('--Button Settings', 'genesis'),
        'description'    => __('all values are px', 'genesis'),
        'panel'          => 'genesis',
        'priority'       => 52,
        'controls'       => null
    );

    $config['genesis']['sections']['jma_uagb_comps']= array(
        'title'          => __('--Ultimate Addons for Gutenberg', 'genesis'),
        'description'    => __('Settings for UAGB Components', 'genesis'),
        'panel'          => 'genesis',
        'priority'       => 54,
        'controls'       => null
    );
    return $config;
}
add_filter('genesis_customizer_theme_settings_config', 'jma_gbs_customizer_theme_settings_config');

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


function jma_gbs_backend_custom_css()
{
    wp_add_inline_style('uagb-block-common-editor-css', '.block-editor__container .wp-block[data-type*="uagb/section"], .block-editor__container .wp-block[data-type*="uagb/columns"], .wp-block {max-width: 1510px;}.block-editor-page #wpwrap .wp-block .wp-block-uagb-column .uagb-column__inner-wrap {padding: 0;}}');
}
add_action('admin_enqueue_scripts', 'jma_gbs_backend_custom_css');


function jma_gbs_open_div()
{
    echo '<div class="jma-gbs-inner">';
}

function jma_gbs_close_div()
{
    echo '</div>';
}

function jma_gbs_archive_banner_title()
{
    $title = '';
    global $wp_query;
    if (is_archive()) {
        $title = $wp_query->queried_object->name;
    } else {
        $id = get_option('page_for_posts');
        $title = get_the_title($id);
    }
    if ($title) {
        echo '<div class="banner-wrap">';
        printf('<h1 %s>%s</h1>', genesis_attr('archive-title'), esc_html(wp_strip_all_tags($title)));
        echo '</div>';
    }
}


function jma_gbs_template_redirect()
{
    $mods = jma_gbs_get_theme_mods();
    add_action('genesis_header', 'jma_gbs_open_div', 7);
    add_action('genesis_header', 'jma_gbs_close_div', 13);

    add_action('genesis_before_loop', 'jma_gbs_open_div');
    add_action('genesis_after_loop', 'jma_gbs_close_div');

    add_action('genesis_before_sidebar_widget_area', 'jma_gbs_open_div');
    add_action('genesis_after_sidebar_widget_area', 'jma_gbs_close_div');

    add_action('genesis_footer', 'jma_gbs_open_div', 7);
    add_action('genesis_footer', 'jma_gbs_close_div', 13);
    //move page title to header banner
    if ($mods['jma_gbs_site_banner']) {
        if (is_single() || is_page()) {
            remove_action('genesis_entry_header', 'genesis_do_post_title');

            add_action('genesis_header', function () {
                echo '<div class="banner-wrap">';
            }, 12);

            add_action('genesis_header', 'genesis_do_post_title', 12);

            add_action('genesis_header', function () {
                echo '</div>';
            }, 12);
        }
        if (is_archive() || is_home()) {
            remove_action('genesis_archive_title_descriptions', 'genesis_do_archive_headings_headline');
            add_action('genesis_header', 'jma_gbs_archive_banner_title', 12);
        }
    }
}
add_action('template_redirect', 'jma_gbs_template_redirect');

function jma_gbs_body_filter($cl)
{
    $border_items = array('jma_gbs_modular_header', 'jma_gbs_frame_content', 'jma_gbs_modular_footer', 'jma_gbs_use_menu_root_dividers', 'jma_gbs_site_banner');
    $mods = jma_gbs_get_theme_mods();
    foreach ($border_items as $key => $border_item) {
        if ($mods[$border_item]) {
            $cl[] = $border_item;
        } else {
            $cl[] = str_replace('jma_gbs_', 'jma_gbs_non_', $border_item);
        }
    }
    $cl[] = $mods['jma_gbs_body_shape'];
    if (jma_gbs_detect_block('', 'contentWidth', 'full_width') || jma_uagb_detect_block('', 'contentWidth', 'custom')) {
        $cl[] = 'jma_gbs_full_block';
    }
    return $cl;
}
add_filter('body_class', 'jma_gbs_body_filter');
