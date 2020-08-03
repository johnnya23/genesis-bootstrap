<?php


if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/* Modify the Bootstrap Classes being applied
 * based on the Genesis template chosen
 */

// modify bootstrap classes based on genesis_site_layout
add_filter('jma-gbs-classes-to-add', 'JMA_GBS_modify_classes_based_on_template', 10, 3);

// remove unused layouts

function JMA_GBS_layout_options_modify_classes_to_add($classes_to_add)
{
    $layout = genesis_site_layout();

    // content-sidebar          // default

    // full-width-content       // supported
    if ('full-width-content' === $layout) {
        $classes_to_add['content'] = 'col-md-12';
    }

    // sidebar-content          // supported
    if ('sidebar-content' === $layout) {
        $classes_to_add['content'] = 'col-md-9 order-md-12';
        $classes_to_add['sidebar-primary'] = 'col-md-3 order-md-1';
    }

    // content-sidebar-sidebar  // supported
    if ('content-sidebar-sidebar' === $layout) {
        $classes_to_add['content'] = 'col-md-6';
        $classes_to_add['sidebar-primary'] = 'col-md-3';
        $classes_to_add['sidebar-secondary'] = 'col-md-3';
    }


    // sidebar-sidebar-content  // supported
    if ('sidebar-sidebar-content' === $layout) {
        $classes_to_add['content'] = 'col-md-6 order-md-12';
        $classes_to_add['sidebar-primary'] = 'col-md-3 order-1';
        $classes_to_add['sidebar-secondary'] = 'col-md-3 order-6';
    }


    // sidebar-content-sidebar  // supported
    if ('sidebar-content-sidebar' === $layout) {
        $classes_to_add['content'] = 'col-md-6 order-md-6';
        $classes_to_add['sidebar-primary'] = 'col-md-3 order-md-1';
        $classes_to_add['sidebar-secondary'] = 'col-md-3 order-md-12';
    }

    return apply_filters('jma_gbs_classes_to_add', $classes_to_add, $layout);
};

function JMA_GBS_modify_classes_based_on_template($classes_to_add, $context, $attr)
{
    $classes_to_add = JMA_GBS_layout_options_modify_classes_to_add($classes_to_add);

    return $classes_to_add;
}
