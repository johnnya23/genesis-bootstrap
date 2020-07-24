<?php

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

function jma_gbs_minifyCss($css)
{
    // some of the following functions to minimize the css-output are directly taken
    // from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
    // all credits to Christian Schaefer: http://twitter.com/derSchepp
    // remove comments
    $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
    // backup values within single or double quotes
    preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
    for ($i=0; $i < count($hit[1]); $i++) {
        $css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
    }
    // remove traling semicolon of selector's last property
    $css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
    // remove any whitespace between semicolon and property-name
    $css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
    // remove any whitespace surrounding property-colon
    $css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
    // remove any whitespace surrounding selector-comma
    $css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
    // remove any whitespace surrounding opening parenthesis
    $css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
    // remove any whitespace between numbers and units
    $css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
    // shorten zero-values
    $css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
    // constrain multiple whitespaces
    $css = preg_replace('/\p{Zs}+/ims', ' ', $css);
    // remove newlines
    $css = str_replace(array("\r\n", "\r", "\n"), '', $css);
    // Restore backupped values within single or double quotes
    for ($i=0; $i < count($hit[1]); $i++) {
        $css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
    }
    return $css;
}

/**
* structure_css_array creates nested array
*
*
* @param array $items items of be processed
* @return array $querys   [$query][$selector][$item][$attr] = $value
*/
function structure_css_array($items)
{
    $querys = array();
    foreach ($items as $item) {
        $query = 'none';
        //do we have a valid item
        if (is_array($item) && isset($item['selector']) && count($item) > 1) {
            if (isset($item['query']) && $item['query']) {
                $query = str_replace(array(' ', 'and'), array('', ' and '), $item['query']);
                unset($item['query']);
            }
            //open with selector(s)
            $selectors = explode(',', $item['selector']);
            unset($item['selector']);
            //the attr/value pairs plus selector and query elements
            foreach ($selectors as $selector) {
                $selectors_attr_vals = array();
                //echo $selector;
                //get rid of any double spaces
                $selector = trim(preg_replace('/\s+/', ' ', $selector));
                //makes the selector the index of an array within the query
                //and leavves attr/value pairs as index/value pairs within the
                // $selector array
                $selectors_attr_vals[$query][$selector] = $item;
                //this will have the affect of combining like selectors
                //in output for this query
                $querys = array_replace_recursive($querys, $selectors_attr_vals);
            }
        }
    }
    return $querys;
}

/**
* jma_gbs_process_css_array creates css string from array
*
*
* @param array $items items of be processed
* @return string $css   css for wp_head
*/
function jma_gbs_process_css_array($items, $customizer = false)
{
    $css = '';
    if (is_array($items)) {
        $querys = structure_css_array($items);

        //step through all the queries
        foreach ($querys as $query => $selectors) {
            $text = $open = $close = '';
            //wrap it if there is a query
            if ($query != 'none') {
                $open = '@media ' . $query . '{';
                $close = '}';
            }
            //step through all the selectors
            foreach ($selectors as $selector => $item) {
                if ($customizer) {
                    if (strpos($selector, 'body') === 0) {
                        $selector = str_replace('body', 'body.customize-partial-edit-shortcuts-shown', $selector);
                    } else {
                        $selector = 'body.customize-partial-edit-shortcuts-shown ' . $selector;
                    }
                }
                $text .= $selector . '{';
                foreach ($item as $attr => $value) {
                    //make sure its not blank
                    if ($value) {
                        //what's left are the attribute value pairs
                        $text .= $attr . ':' . $value . ';';
                    }
                }
                $text .='}';
            }
            $css .= $open . $text . $close;
        }
    }

    return $css;
};
