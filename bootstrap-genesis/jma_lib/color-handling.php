<?php

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

function jma_gbs_get_trans($color_in, $trans_amount = 0.6)
{
    $raw = str_replace('#', '', $color_in);
    // Convert string to 3 decimal values (0-255)
    $rgb = array_map('hexdec', str_split($raw, 2));
    if (is_array($rgb) && count($rgb) > 2) {
        return ' rgba(' . $rgb[0] . ',' . $rgb[1] . ',' . $rgb[2] . ',' . $trans_amount . ')';
    }
}

function jma_gbs_get_lightness_from_hex($hex)
{
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    return (0.2126 * $r + 0.7152 * $g + 0.0722 * $b) / 255;
}

function jma_gbs_first_is_lighter($first, $second)
{
    return jma_gbs_get_lightness_from_hex($first) > jma_gbs_get_lightness_from_hex($second);
}

function jma_gbs_get_tint($color_in, $tint_amount = 0.5)
{
    $raw = str_replace('#', '', $color_in);
    // Convert string to 3 decimal values (0-255)
    $rgb = array_map('hexdec', str_split($raw, 2));
    $return['str_split'] = $rgb;
    // Modify colors
    $lighten[0] = round(($rgb[0] + 255) * $tint_amount);
    $lighten[1] = round(($rgb[1] + 255) * $tint_amount);
    $lighten[2] = round(($rgb[2] + 255) * $tint_amount);
    $darken[0] = str_pad(round(($rgb[0] + 0) / 1.2), 2, '0', STR_PAD_LEFT);
    $darken[1] = str_pad(round(($rgb[1] + 0) / 1.2), 2, '0', STR_PAD_LEFT);
    $darken[2] = str_pad(round(($rgb[2] + 0) / 1.2), 2, '0', STR_PAD_LEFT);
    $return['light_str_split'] = $lighten;
    $return['dark_str_split'] = $darken;
    // Convert back
    $return['light_hex'] = '#' . implode('', array_map('dechex', $lighten));
    $return['dark_hex'] = '#' . implode('', array_map('dechex', $darken));
    return $return;
}
