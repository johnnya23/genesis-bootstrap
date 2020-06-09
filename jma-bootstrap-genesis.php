<?php
/**
*Plugin Name: JMA Bootstrap with Genesis
*Description: Bootstap and customizations applied to Genesis Theme
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
if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly


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

define('JMA_GBS_ROOT_URI', trailingslashit(plugin_dir_url(__FILE__)));
define('JMA_GBS_ROOT_DIRECTORY', trailingslashit(plugin_dir_path(__FILE__)));

require('bootstrap-genesis/bootstrap-genesis.php');
