<?php
/**
 * BLOCK: Profile
 *
 * Gutenberg Custom Youtube List Box
 *
 * @since   2.0
 * @package JMA
 */



 defined('ABSPATH') || exit;

 /**
  * Enqueue the block's assets for the editor.
  *
  * `wp-blocks`: Includes block type registration and related functions.
  * `wp-element`: Includes the WordPress Element abstraction for describing the structure of your blocks.
  * `wp-i18n`: To internationalize the block's text.
  *
  * @since 1.0.0
  */
 function JMA_gbs_menu_block()
 {
     if (! function_exists('register_block_type')) {
         // Gutenberg is not active.
         return;
     }
     // Scripts.
     wp_register_script(
        'jma-gbs-menu-block-script', // Handle.
        plugins_url('block.js', __FILE__), // Block.js: We register the block here.
        array( 'wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor' ), // Dependencies, defined above.
        filemtime(plugin_dir_path(__FILE__) . 'block.js'),
        true
    );

     // Here we actually register the block with WP, again using our namespacing.
     // We also specify the editor script to be used in the Gutenberg interface.
     register_block_type('jma-gbs/menu-block', array(
        'attributes'      => array(
            'nav_val' => array(
                'type' => 'string',
            ),
            'use_bg' => array(
                'type' => 'string',
            ),
            'menu_bg' => array(
                'type' => 'string',
            ),
            'menu_font' => array(
                'type' => 'string',
            ),
            'menu_bg_hover' => array(
                'type' => 'string',
            ),
            'menu_font_hover' => array(
                'type' => 'string',
            ),
            'menu_bg_active' => array(
                'type' => 'string',
            ),
            'menu_font_active' => array(
                'type' => 'string',
            ),
            'align' => array(
                'type' => 'string',
            ),
            'className' => array(
                'type' => 'string',
            )
        ),
        'editor_script' => 'jma-gbs-menu-block-script',
        'render_callback' => 'jma_gbs_menu',
    ));
 } // End function JMA_gbs_block().

 // Hook: Editor assets.
 add_action('init', 'JMA_gbs_menu_block');

function jma_gbs_menu($input)
{
    ob_start();
    /*foreach ($input as $i => $item) {
        echo $i . '=>' . $item;
    }*/
    if (isset($input['nav_val'])) {//genesis_do_subnav();
        if ($input['nav_val'] == 'primary') {
            genesis_do_nav();
        } else {
            genesis_do_subnav();
        }
    }
    return ob_get_clean();
}
