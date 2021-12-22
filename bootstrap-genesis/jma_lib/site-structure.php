<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

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
function jma_gbs_get_display_vals()
{
    $mods = jma_gbs_get_theme_mods();
    $meta = array();
    $return = array(
        'title_display' => 'show',
        'image_display' => 'full',
        'featured_size' => 'medium',
        'lightbox_display' => 'off'
    );

    $context = '_' . get_post_type();
    //the items we are checking/modifying
    $items = array('title_display', 'image_display', 'featured_size', 'lightbox_display');
    if (get_post_meta(get_the_ID(), '_jma_gbs_page_options_key', true)) {
        //keys in meta match $items
        $meta =  get_post_meta(get_the_ID(), '_jma_gbs_page_options_key', true);
    }
    foreach ($items as $item) {
        //modify keys to match those in $mod
        $mod_key = 'jma_gbs_' . $item . $context;
        if (isset($meta[$item]) && $meta[$item]) {
            $return[$item] = $meta[$item];
        } elseif (isset($mods[$mod_key])) {
            $return[$item] = $mods[$mod_key];
        }
    }
    return $return;
}


function jma_gbs_site_layout($pre)
{
    if (is_singular()) {
        global $post;
        $meta = get_post_meta($post->ID);

        $mods = jma_gbs_get_theme_mods('jma_gbs_');
        $post_type = get_post_type();
        if (isset($mods[$post_type . '_col_layout']) && $mods[$post_type . '_col_layout']) {
            $pre = $mods[$post_type . '_col_layout'];
        }
    }
    return $pre;
}
add_filter('genesis_site_layout', 'jma_gbs_site_layout', 40);

genesis_register_sidebar(array(
    'id'		=> 'page-edge-widget',
    'name'		=> 'Page Edge Widget',
    'description'	=> 'Mostly this is for follow icons'
));


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

//* Add the page widget in the content - HTML5

function jma_gbs_add_page_edge_content()
{
    genesis_widget_area('page-edge-widget', array(
        'before' => '<div class="page-edge-widget"><div class="wrap">',
        'after' => '</div></div>',
    ));
}

function jma_gbs_add_scroll_to_top()
{
    echo '<button class="jma-fixed-scroll jma-scroll-to-top"><i class="fas fa-chevron-up"></i></button>';
}


function jma_gbs_template_redirect()
{//add_action('jma_gbs_local_menu');
    global $post;
    $post_id = is_home()? get_option('page_for_posts'): $post->ID;
    if ((is_object($post) || is_home()) && get_post_meta($post_id, '_jma_gbs_page_options_key', true)) {
        $page_options = get_post_meta($post_id, '_jma_gbs_page_options_key', true);
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

    $mods = jma_gbs_get_theme_mods();
    if ($mods['jma_gbs_custom_mobile_menu'] != 'jma-none' && $mods['jma_gbs_custom_mobile_menu'] != 'jma-auto') {
        add_action('genesis_before', 'jma_gbs_custom_mobile', 80);
    }
    if ($mods['jma_gbs_use_desktop_side_menu']) {
        $priority = $mods['jma_gbs_desktop_side_mobile_display'] ;
        add_action('genesis_before', 'jma_gbs_custom_side', $priority);
    }

    if ($mods['jma_gbs_add_search']) {
        add_filter('JMA_GBS_nav_menu_markup_filter_inner', 'jma_gbs_nav_menu_markup_filter_inner', 10, 3);
    }

    if (is_singular()) {
        // $display_vals['title_display'] and image_display with values
        $display_vals = jma_gbs_get_display_vals();
        if ($display_vals['title_display'] == 'hide') {
            remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);
            remove_action('genesis_entry_header', 'genesis_do_post_title');
            remove_action('genesis_entry_header', 'genesis_entry_header_markup_close', 15);
        }
    }

    //move page title to header banner
    if ($mods['jma_gbs_site_banner']) {
        if (is_singular() && $display_vals['title_display'] == 'show') {
            add_action('genesis_before_content_sidebar_wrap', function () {
                echo '<div class="banner-wrap">';
            }, 4);
            remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);
            remove_action('genesis_entry_header', 'genesis_do_post_title');
            remove_action('genesis_entry_header', 'genesis_entry_header_markup_close', 15);
            add_action('genesis_before_content_sidebar_wrap', 'genesis_do_post_title', 4);

            add_action('genesis_before_content_sidebar_wrap', function () {
                echo '</div>';
            }, 4);
        }
        if (is_archive() || is_home()) {
            remove_action('genesis_archive_title_descriptions', 'genesis_do_archive_headings_headline');
            add_action('genesis_before_content_sidebar_wrap', 'jma_gbs_archive_banner_title', 4);
        }
    }
    add_action('genesis_after', 'jma_gbs_add_page_edge_content');
    add_action('genesis_after', 'jma_gbs_add_scroll_to_top');
}
add_action('template_redirect', 'jma_gbs_template_redirect');

function jma_gbs_body_filter($cl)
{
    global $post;
    $post_id = is_home()? get_option('page_for_posts'): $post->ID;

    if ((is_object($post) ||  is_home()) && get_post_meta($post_id, '_jma_gbs_page_options_key', true)) {
        $page_options = get_post_meta($post_id, '_jma_gbs_page_options_key', true);
    }
    $border_items = array('jma_gbs_modular_header', 'jma_gbs_frame_content', 'jma_gbs_modular_footer', 'jma_gbs_use_menu_root_dividers', 'jma_gbs_use_menu_root_bg', 'jma_gbs_site_banner');
    $mods = jma_gbs_get_theme_mods();
    foreach ($border_items as $key => $border_item) {
        if ($mods[$border_item]) {
            $cl[] = $border_item;
        } else {
            $cl[] = str_replace('jma_gbs_', 'jma_gbs_non_', $border_item);
        }
    }
    $cl[] = $mods['jma_gbs_body_shape'];
    if (jma_gbs_detect_block(array('name' => 'getwid/section')) || jma_gbs_detect_block(array('name' =>  'kadence/rowlayout'))) {
        $cl[] = 'jma_gbs_full_block';
    }

    if (isset($page_options['scroll_menu']) && $page_options['scroll_menu']) {
        $cl[] = 'scroll_menu';
    }
    if ($mods['jma_gbs_custom_mobile_menu'] != 'jma-none' || $mods['jma_gbs_desktop_side_mobile_display'] > 77) {
        $cl[] = 'use_mobile_menu';
    }
    if ($mods['jma_gbs_custom_mobile_menu'] == 'jma-auto') {
        $cl[] = 'default_moble_menu';
    }
    if ($mods['jma_gbs_use_desktop_side_menu']) {
        $cl[] = 'use_side_menu';
    }
    return $cl;
}



function jma_gbs_local_menu()
{
    global $post;
    $post_id = is_home()? get_option('page_for_posts'): $post->ID;

    if ((is_object($post) ||  is_home()) && get_post_meta($post_id, '_jma_gbs_page_options_key', true)) {
        $page_options =  get_post_meta($post_id, '_jma_gbs_page_options_key', true);
    }
    if (is_array($page_options) && isset($page_options['scroll_menu']) && $page_options['scroll_menu']) {
        $menuslug = $page_options['scroll_menu'];
    }
    echo wp_nav_menu(array( 'menu' => $menuslug, 'menu_class' => 'jma-local-menu', 'container' => null ));
}


function jma_gbs_footer_search_form()
{
    echo '<div id="jma_gbs_search_overlay" class="jma-gbs-overlay">';
    echo '<span class="jma-gbs-close-search" title="Close Overlay">×</span>';
    echo '<div class="jma-gbs-overlay-content">';
    get_search_form();
    echo '</div>';
    echo '</div>';
}
add_action('genesis_after', 'jma_gbs_footer_search_form');

function jma_gbs_custom_mobile()
{
    $mods = jma_gbs_get_theme_mods('jma_gbs_');
    jma_gbs_get_nav_menu(array(
        'menu_class'     => 'nav sf-menu sf-arrows sf-vertical mobile-menu',
        'menu' => $mods['custom_mobile_menu']
    ));
}

function jma_gbs_custom_side()
{
    $mobile = ' use-side-menu';
    $mods = jma_gbs_get_theme_mods('jma_gbs_');
    if ($mods['desktop_side_mobile_display'] > 77) {
        $mobile .= ' mobile-menu';
    }

    jma_gbs_get_nav_menu(array(
        'menu_class'     => 'nav sf-menu sf-arrows sf-vertical' . $mobile,
        'menu' => $mods['desktop_side_menu']
    ));
}

function jma_gbs_nav_menu_markup_filter_inner($out, $html, $args)
{
    if ('primary'   == $args->theme_location) {
        $search_html = '<li class="jma-gbs-open-search menu-item"><a title="search the site" href="#"><span><i class="fas fa-search"></i></span></a></li>';
        $out = str_replace('</ul></div>', $search_html . '</ul></div>', $out);
    }
    return $out;
}
