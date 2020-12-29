<?php
/*
 * Adds a box to the right column on the Post and Page edit screens.
 */

 if (! defined('ABSPATH')) {
     exit;
 } // Exit if accessed directly
function jma_gbs_image_input_box()
{
    $cpts = $screens = array();
    if (function_exists('jma_ghb_get_cpt')) {
        $cpts = jma_ghb_get_cpt();
    }
    foreach ($cpts as $slug => $obj) {
        $screens[] = $slug;
    }
    $screens = apply_filters('jma_gbs_image_input_screens_filter', $screens);
    foreach ($screens as $screen) {
        add_meta_box(
            'jma_gbs_image_input_section',
            __('Page Options', 'jma_textdomain'),
            'jma_gbs_page_options',
            $screen,
            'side'
        );
    }
}
add_action('add_meta_boxes', 'jma_gbs_image_input_box');

/*
 * Prints the box content
 *
 * @param WP_Post $post The object for the current post/page.
 */

    function jma_gbs_page_options($post)
    {
        // Add an nonce field so we can check for it later.
        wp_nonce_field('jma_gbs_page_options', 'jma_gbs_page_options_nonce');

        /*
         * Use get_post_meta() to retrieve an existing value
         * from the database and use the value for the form.
         */
        $page_options = array('show_amount' => '', 'use_full_image' => '');
        if (get_post_meta($post->ID, '_jma_gbs_page_options_key', true)) {
            $page_options = get_post_meta($post->ID, '_jma_gbs_page_options_key', true);
        }

        echo '<p></p>';

        echo '<label for="title_display">';
        _e('Toggle Title Display', 'jma_ghb_textdomain');
        echo '</label><br/><br/> ';
        echo '<select name="title_display">';
        echo '<option value="0"'.selected($page_options['title_display'], '0').'>Default</option>';
        echo '<option value="show"'.selected($page_options['title_display'], 'show').'>Show Title</option>';
        echo '<option value="hide"'.selected($page_options['title_display'], 'hide').'>Hide Title</option>';
        echo '</select><br/><br/>';

        echo '<label for="image_display">';
        _e('Change Featured Image Display within body', 'jma_ghb_textdomain');
        echo '</label><br/><br/> ';
        echo '<select name="image_display">';
        echo '<option value="0"'.selected($page_options['image_display'], '0').'>Default</option>';
        echo '<option value="hide"'.selected($page_options['image_display'], 'hide').'>Hide</option>';
        echo '<option value="full"'.selected($page_options['image_display'], 'full').'>Full Width</option>';
        echo '<option value="right"'.selected($page_options['image_display'], 'right').'>Align Right</option>';
        echo '<option value="left"'.selected($page_options['image_display'], 'left').'>Align Left</option>';
        echo '</select><br/><br/>';

        $menus = get_terms('nav_menu');

        echo '<label for="scroll_menu">';
        _e('Menu to Display at for Scroll', 'jma_textdomain');
        echo '</label><br/><br/> ';
        echo '<select name="scroll_menu">';
        echo '<option value=""'.selected($page_options['scroll_menu'], '').'>Select...</option>';
        foreach ($menus as $menu) {
            echo '<option value="'.$menu->slug.'"'.selected($page_options['scroll_menu'], $menu->slug).'>'.$menu->name.'</option>';
        }
        echo '</select><br/><br/>';
    }
/*
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */

    function jma_save_full_image_postdata($post_id)
    {
        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if (!isset($_POST['jma_gbs_page_options_nonce'])) {
            return $post_id;
        }

        $nonce = $_POST['jma_gbs_page_options_nonce'];

        // Verify that the nonce is valid.
        if (!wp_verify_nonce($nonce, 'jma_gbs_page_options')) {
            return $post_id;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // Check the user's permissions.
        if ('page' === $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }

        /* OK, its safe for us to save the data now. */

        // Sanitize user input.  htmlspecialchars($_POST['_right_sb_wysiwyg']);
        $values = $_POST;
        //$values['widget_area'] = $_POST[ '_jma_ghb_widget_area'];
        $clean_data = array();
        foreach ($values as $i => $value) {
            if (is_string($value)) {
                $clean_data[$i] = wp_kses_post($value);
            }
        }

        // Update the meta field in the database.
        update_post_meta($post_id, '_jma_gbs_page_options_key', $clean_data);
    }
add_action('save_post', 'jma_save_full_image_postdata');
