<?php
/**
 * function jma_uagb_detect_block Detect full width blocks
 * we don't have to drill down below the first level in detectin full width
 * @return boolean $return
 */
function jma_gbs_detect_block($name, $key = '', $value = '')
{
    global $post;
    $return = false;

    if (function_exists('has_blocks') && has_blocks($post->post_content)) {
        $blocks = parse_blocks($post->post_content);

        if (is_array($blocks)) {
            foreach ($blocks as $block) {
                if (!$name || $name == $block['blockName']) {
                    //if value is set for $key or $value we require a match
                    if ($key || $value) {
                        if (isset($block['attrs'][$key]) && $block['attrs'][$key] == $value) {
                            $return = true;
                        } elseif ($name && $name == $block['blockName']) {
                            // else matching the block name is good enough
                            $return = true;
                        }
                    }
                }
            }
        }
    }

    return $return;
}
