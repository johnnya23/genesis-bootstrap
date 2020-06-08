<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

add_filter('comment_form_defaults', 'JMA_GBS_comment_form_modifications');

function JMA_GBS_comment_form_modifications($fields)
{
    //Remove Form Allowed Tags Box
    $fields['comment_notes_after'] = '';

    return $fields;
}
