<?php

/**
 * compares theme mod vs page modifications a returns the value if
 * theme mod is over written -- zero is used in the page/post
 * form for "default" the other values on the page form and the customizer
 * match each other
 *
 * @param  array $mods theme mods from customize_register
 * @var array $meta the value from the page/post form
 * @return array $return key and modified value pairs
 */
function jma_gbs_get_display_vals($mods)
{
    $meta = array();
    $return = array('title_display' => 'show', 'image_display' => 'full');

    $context = is_page()? '_pages': '_posts';
    //the items we are checking/modifying
    $items = array('title_display', 'image_display');
    if (get_post_meta(get_the_ID(), '_jma_ghb_header_footer_key', true)) {
        //keys in meta match $items
        $meta =  get_post_meta(get_the_ID(), '_jma_ghb_header_footer_key', true);
    }
    foreach ($items as $item) {
        //modify keys to match those in $mod
        $mod_key = 'jma_ghb_' . $item . $context;
        if (isset($meta[$item]) && $meta[$item]) {
            $return[$item] = $meta[$item];
        } elseif (isset($mods[$mod_key])) {
            $return[$item] = $mods[$mod_key];
        }
    }
    return $return;
}

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
{//add_action('jma_gbs_local_menu');
    global $post;

    if (get_post_meta($post->ID, '_jma_gbs_page_options_key', true)) {
        $page_options = get_post_meta($post->ID, '_jma_gbs_page_options_key', true);
    }
    add_filter('body_class', 'jma_gbs_body_filter');
    add_action('genesis_header', 'jma_gbs_open_div', 7);
    add_action('genesis_header', 'jma_gbs_close_div', 13);

    add_action('genesis_before_content_sidebar_wrap', 'jma_gbs_open_div');
    if (isset($page_options['scroll_menu']) && $page_options['scroll_menu']) {
        add_action('genesis_before_content_sidebar_wrap', 'jma_gbs_local_menu');
    }
    add_action('genesis_after_content_sidebar_wrap', 'jma_gbs_close_div');

    add_action('genesis_before_loop', 'jma_gbs_open_div');
    add_action('genesis_after_loop', 'jma_gbs_close_div');

    add_action('genesis_before_sidebar_widget_area', 'jma_gbs_open_div');
    add_action('genesis_after_sidebar_widget_area', 'jma_gbs_close_div');

    add_action('genesis_before_sidebar_alt_widget_area', 'jma_gbs_open_div');
    add_action('genesis_after_sidebar_alt_widget_area', 'jma_gbs_close_div');

    add_action('genesis_footer', 'jma_gbs_open_div', 7);
    add_action('genesis_footer', 'jma_gbs_close_div', 13);

    if (is_singular()) {
        $mods = jma_gbs_get_theme_mods();
        // $display_vals['title_display'] and image_display with values
        $display_vals = jma_gbs_get_display_vals($mods);
        if ($display_vals['title_display'] == 'hide') {
            remove_action('genesis_entry_header', 'genesis_do_post_title');
        }
        //remove_action('genesis_entry_header', 'genesis_post_info', 12);
        //remove_action('genesis_entry_footer', 'genesis_post_meta');
    }

    //move page title to header banner
    if ($mods['jma_gbs_site_banner']) {
        if (is_singular() && $display_vals['title_display'] == 'show') {
            add_action('genesis_header', function () {
                echo '<div class="banner-wrap">';
            }, 12);
            remove_action('genesis_entry_header', 'genesis_do_post_title');
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
    global $post;

    if (get_post_meta($post->ID, '_jma_gbs_page_options_key', true)) {
        $page_options = get_post_meta($post->ID, '_jma_gbs_page_options_key', true);
    }
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

    if (isset($page_options['sticky-header']) && $page_options['sticky-header']) {
        $cl[] = 'sticky';
    }

    if (isset($page_options['scroll_menu']) && $page_options['scroll_menu']) {
        $cl[] = 'scroll_menu';
    }
    return $cl;
}
