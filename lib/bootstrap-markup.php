<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

// add bootstrap classes
add_filter('genesis_attr_nav-primary', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_nav-secondary', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_site-header', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_site-inner', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_content-sidebar-wrap', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_content', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_sidebar-primary', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_sidebar-secondary', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_archive-pagination', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_entry-content', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_entry-pagination', 'JMA_GBS_add_markup_class', 10, 2);
add_filter('genesis_attr_site-footer', 'JMA_GBS_add_markup_class', 10, 2);

function JMA_GBS_add_markup_class($attr, $context)
{
    // default classes to add
    $classes_to_add = apply_filters(
        'jma-gbs-classes-to-add',
        // default bootstrap markup values
        array(
            'nav-primary'               => 'navbar navbar-default navbar-static-top',
            'nav-secondary'             => 'navbar navbar-inverse navbar-static-top',
            'site-header'               => 'container',
            'site-inner'                => 'container',
            'site-footer'               => 'container',
            'content-sidebar-wrap'      => 'row',
            'content'                   => 'col-sm-9',
            'sidebar-primary'           => 'col-sm-3',
            'archive-pagination'        => 'clearfix',
            'entry-content'             => 'clearfix',
            'entry-pagination'          => 'clearfix jma-gbs-pagination-numeric',
        ),
        $context,
        $attr
    );

    // populate $classes_array based on $classes_to_add
    $value = isset($classes_to_add[ $context ]) ? $classes_to_add[ $context ] : array();

    if (is_array($value)) {
        $classes_array = $value;
    } else {
        $classes_array = explode(' ', (string) $value);
    }

    // apply any filters to modify the class
    $classes_array = apply_filters('jma-gbs-add-class', $classes_array, $context, $attr);

    $classes_array = array_map('sanitize_html_class', $classes_array);

    // append the class(es) string (e.g. 'span9 custom-class1 custom-class2')
    $attr['class'] .= ' ' . implode(' ', $classes_array);

    return $attr;
}
