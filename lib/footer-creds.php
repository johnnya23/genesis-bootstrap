<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

//add_filter('genesis_pre_get_option_footer_text', 'JMA_GBS_footer_creds_filter');

function JMA_GBS_footer_creds_filter($creds)
{
    $rel = is_front_page() ? '' : 'rel="nofollow"';
    $creds = "<a {$rel} href=\"http://ironcodestudio.com/bootstrap-genesis-theme/\">Bootstrap Genesis Theme</a> by <a {$rel} href=\"http://ironcodestudio.com/\">Iron Code Studio</a>";
    return $creds;
}
