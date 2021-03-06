<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/**
 * function jma_gbs_detect_block Detect full width blocks
 * we don't have to drill down below the first level in detectin full width
* );
 * @return boolean $return
 */
function jma_gbs_detect_block($args)
{
    if (!is_array($args)) {
        return false;
    }
    global $post;

    $defaults = array(
        'name' => '',
        'post' => $post,
        'key' => '',
        'value' => ''
    );
    $blocks = array();
    $args = wp_parse_args($args, $defaults);

    if (function_exists('has_blocks')) {
        if (is_int($args['post'])) {
            $args['post'] = get_post($args['post']);
        }
        if (is_object($args['post']) && has_blocks($args['post']->post_content)) {
            $blocks = parse_blocks($args['post']->post_content);
        }
    }

    if (count($blocks)) {
        foreach ($blocks as $block) {
            //recursively run reusable blocks
            if (isset($block['blockName']) && 'core/block' == $block['blockName'] && isset($block['attrs']['ref']) && $block['attrs']['ref']) {
                $subargs = $args;
                $subargs['post'] = $block['attrs']['ref'];
                if (jma_gbs_detect_block($subargs)) {
                    return true;
                }
            }
            if (!$args['name'] || (isset($block['blockName']) && $args['name'] == $block['blockName'])) {
                //if value is set for $args['key'] or $args['value'] we require a match
                if ($args['key'] || $args['value']) {
                    if (isset($block['attrs'][$args['key']]) && $block['attrs'][$args['key']] == $args['value']) {
                        return true;
                    }
                } elseif ($args['name'] && $args['name'] == $block['blockName']) {
                    // else matching the block name is good enough
                    return true;
                }
            }
        }
    }
    return false;
}
