<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

if (class_exists('UberMenuStandard')) {
    return;
}
// add primary nav to top of the page
add_action('genesis_before_header', 'jma_gbs_panel_button', 9);
add_action('genesis_before', 'jma_gbs_open_panel');
add_action('genesis_before', 'jma_gbs_close_panel', 99);

function jma_gbs_panel_button()
{
    $mods = jma_gbs_get_theme_mods('jma_gbs_');
    $trigger_class = $trigger_html = '';
    if (isset($mods['custom_trigger_when_closed']) && $mods['custom_trigger_when_closed']) {

        $trigger_class = ' custom-trigger';

$when_open = isset($mods['custom_trigger_when_open']) && $mods['custom_trigger_when_open']?$mods['custom_trigger_when_open']:'X';
        $trigger_html = '<button class="navbar-toggle custom-triggers collapsed">';
        $trigger_html .= '<span class="trigger-default">';
        $trigger_html .= $mods['custom_trigger_when_closed'];
        $trigger_html .= '</span>';
        $trigger_html .= '<span class="triggered-text">';
        $trigger_html .= $when_open;
        $trigger_html .= '</span>';
        $trigger_html .= '</button>';
    }
    echo '<div class="jma-panel-button navbar-header container-fluid' . $trigger_class . '">
      <button class="hamburger navbar-toggle collapsed">
        <span class="hamb">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar top"></span>
        <span class="icon-bar middle"></span>
        <span class="icon-bar bottom"></span>
        </span>
      </button>' . $trigger_html . '
        </div><!-- jma-panel-button -->';
}

function jma_gbs_open_panel()
{
    echo '<div id="jma-gbs-mobile-panel" class="jma-gbs-mobile-panel">';
}

function jma_gbs_close_panel()
{
    echo '</div><!-- mypanel-->';
}

// filter menu args for bootstrap walker and other settings
add_filter('wp_nav_menu_args', 'JMA_GBS_nav_menu_args_filter');

// add bootstrap markup around the nav
add_filter('wp_nav_menu', 'JMA_GBS_nav_menu_markup_filter', 10, 3);

function JMA_GBS_nav_menu_args_filter($args)
{
    if (
        'primary' === $args['theme_location'] ||
        'secondary' === $args['theme_location']
    ) {
        $args['depth'] = 0;
        //$args['menu_class'] = 'nav sf-menu sf-arrows';
        $args['fallback_cb'] = 'wp_bootstrap_navwalker::fallback';
        $args['walker'] = new wp_bootstrap_navwalker();
    }

    return $args;
}

function JMA_GBS_nav_menu_markup_filter($html, $args)
{
    // only add additional Bootstrap markup to
    // primary and secondary nav locations

    if (
        'primary'   !== $args->theme_location &&
        'secondary' !== $args->theme_location
    ) {
        return $html;
    }
    
    return apply_filters('JMA_GBS_nav_menu_markup_filter_inner', $html, $args);
}
