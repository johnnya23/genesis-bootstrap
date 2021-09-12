<?php
/**
*Plugin Name: JMA Bootstrap with Genesis
*Description: Bootstap and customizations applied to Genesis Theme
*Version: 2.3
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

if (get_option('template') != 'genesis') {
    return;
}
if (! function_exists('get_plugin_data')) {
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
}
$plugin_data = array('Version' => 1.0);

if (function_exists('get_plugin_data')) {
    $plugin_data = get_plugin_data(__FILE__);
}

define('JMA_GBS_VERSION', $plugin_data['Version']);

define('JMA_GBS_ROOT_URI', trailingslashit(plugin_dir_url(__FILE__)));
define('JMA_GBS_ROOT_DIRECTORY', trailingslashit(plugin_dir_path(__FILE__)));

require('bootstrap-genesis/bootstrap-genesis.php');
