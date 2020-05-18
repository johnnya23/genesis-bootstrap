<?php


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
function jma_gbs_process_css_array($items)
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
