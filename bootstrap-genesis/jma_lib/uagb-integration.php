<?php
//return null;
if (! defined('ABSPATH')) {
    exit;
}

function jma_gbs_uagb_template_redirect()
{
    add_action('wp_enqueue_scripts', 'jma_gbs_uagb_css', 99);
}
add_action('template_redirect', 'jma_gbs_uagb_template_redirect');



function jma_spacing_handler($block, $first, $last, $full, $wrapped)
{
    $att_map = array(
        'topmargin' => array('margin-top'),
        'bottommargin' => array('margin-bottom'),
        'leftmargin' => array('margin-left'),
        'rightmargin' => array('margin-right'),

        'toppadding' => array('padding-top'),
        'bottompadding' => array('padding-bottom'),
        'leftpadding' => array('padding-left'),
        'rightpadding' => array('padding-right'),

        'innerwidth' => array('max-width'),

        'borderwidth' => array('border-width'),
        'btnhpadding' => array('padding-left', 'padding-right'),
        'btnvpadding' => array('padding-top', 'padding-bottom'),
        'hpadding' => array('padding-left', 'padding-right'),
        'vpadding' => array('padding-top', 'padding-bottom'),
        'btnhrpadding' => array('padding-left', 'padding-right'),
        'btnvertpadding' => array('padding-top', 'padding-bottom'),
        'bordercolor' => array('border-color'),
        'borderhcolor' => array('border-color'),
        'borderhovercolor' => array('border-color'),
        'borderradius' => array('border-radius'),
        'borderwidth' => array('border-width'),
        'borderstyle' => array('border-style'),
        'fontsize' => array('font-size'),
        'size' => array('font-size'),
        'color' => array('color'),
        'btnlinkcolor' => array('color'),
        'hcolor' => array('color'),
        'linkhovercolor' => array('color'),
        'bgcolor' => array('background-color'),
        'background' => array('background-color'),
        'hbackground' => array('background-color'),
        'bghovercolor' => array('background-color'),
        'bghcolor' => array('background-color'),

    );


    $mods = jma_gbs_get_theme_mods('jma_gbs_');

    $layout = genesis_site_layout();

    $selectors = $pairs = array();
    $uagb_sel_id = $selector = '';
    if (isset($block['attrs']['block_id'])) {
        $uagb_sel_id = ' body .uagb-block-' . $block['attrs']['block_id'];
    }

    switch ($block['blockName']) {
        case 'uagb/section': {
            $selector = $uagb_sel_id . '.uagb-section__wrap';

            if (!$wrapped) {
                $pairs = array(
                    'topPadding' => $mods['section_vert'] . 'px',
                    'bottomPadding' => $mods['section_vert'] . 'px'
                );
                if ($full) {
                    $pairs['leftPadding'] = '20px';
                    $pairs['rightPadding'] = '20px';
                    $pairs['leftPaddingMobile'] = '20px';
                    $pairs['rightPaddingMobile'] = '20px';
                    if (isset($block['attrs']['themeWidth']) && $block['attrs']['themeWidth'] && !$wrapped) {
                        $selector_inner = $selector . ' > .uagb-section__inner-wrap';
                        $pairs_inner = array(
                            'innerWidth' => $mods['site_width'] . 'px',
                            'leftMargin' => 'auto',
                            'rightMargin' => 'auto'
                        ) ;
                        $selectors[$selector_inner] = $pairs_inner;
                    }
                }
            } else {
                $pairs['bottomMargin'] = $mods['element_vert'] . 'px';

                if ($last) {
                    $pairs['bottomMargin'] = '0';
                }
            }
            $selectors[$selector] = $pairs;

            break;
        }

        case 'uagb/columns': {
            $selector = $uagb_sel_id . '.uagb-columns__wrap';
            $pairs = array(
                'topPadding' => ($mods['element_vert']/2) . 'px',
                'bottomPadding' => ($mods['element_vert']/2) . 'px'
            );
            $selector_not_full = $uagb_sel_id . '.uagb-columns__wrap';
            $pairs_not_full = array(
                'leftPadding' => '0',
                'rightPadding' => '0'
            );
            //if cols not wraped in section treat like section
            if (!$wrapped) {
                $pairs_not_full['bottomPadding'] = '0';
                $pairs_not_full['topPadding'] = '0';
                if ($layout != 'full-width-content') {
                    $pairs_not_full['bottomMargin'] = '20px';
                    $pairs_not_full['topMargin'] = '20px';
                }
            }
            if (isset($block['attrs']['contentWidth']) && $block['attrs']['contentWidth'] != 'custom') {
                $selector_inner = $selector . ' > .uagb-columns__inner-wrap';
                $pairs_inner = array(
                    'innerWidth' => $mods['site_width'] . 'px',
                    'rightMargin' => 'auto',
                    'leftMargin' => 'auto',
                );
            } else {
                $pairs['innerwidth'] = '150%';
            }
            if (isset($selector_inner)) {
                $selectors[$selector_inner] = $pairs_inner;
            }
            $selectors[$selector_not_full] = $pairs_not_full;
            $selectors[$selector] = $pairs;
            break;
        }
        case 'uagb/column': {
            $selector = $uagb_sel_id . '.uagb-column__wrap';
            $pairs = array(
                    'topMarginMobile' => '0',
                    'bottomMarginMobile' => '20px',
                    'leftMarginMobile' => '0',
                    'rightMarginMobile' => '0',
                    'leftPaddingMobile' => '20px',
                    'rightPaddingMobile' => '20px',
                    'topPadding' => '20px',
                    'bottomPadding' => '20px',
                    'leftMargin' => ($mods['uagb_gutter']/2) . 'px',
                    'rightMargin' => ($mods['uagb_gutter']/2) . 'px',
                );
            if ($first) {
                $pairs['leftMargin'] = '0';
            }
            if ($last) {
                $pairs['rightMargin'] = '0';
            }
            if (isset($block['attrs']['className']) && strpos($block['attrs']['className'], 'full-size-content') !== false) {
                $pairs['toppadding'] = '0';
                $pairs['bottompadding'] = '0';
                $pairs['leftpadding'] = '0';
                $pairs['rightpadding'] = '0';
                $pairs['toppaddingMobile'] = '0';
                $pairs['bottompaddingMobile'] = '0';
                $pairs['leftpaddingMobile'] = '0';
                $pairs['rightpaddingMobile'] = '0';
                $selector_full = $selector . '  .uagb-column__inner-wrap';
                $pairs_full = array(
                    'leftpadding' => '0',
                    'rightpadding' => '0',
                    'toppadding' => '0',
                    'bottompadding' => '0'
                );
                $selector_full_inner = $selector . ' .uagb-column__inner-wrap > *';
                $pairs_full_inner = array(
                    'leftMargin' => '0',
                    'rightMargin' => '0',
                    'topMargin' => '0',
                    'bottomMargin' => '0'
                );
                $selectors[$selector_full] = $pairs_full;
                $selectors[$selector_full_inner] = $pairs_full_inner;
            }

            $selector_full_width_class = $uagb_sel_id . '.uagb-column__wrap';
            $pairs_full_width_class = array();

            if (!$wrapped) {
                $pairs_full_width_class['leftMargin'] = '0';
                $pairs_full_width_class['rightMargin'] = '0';
                $pairs_full_width_class['bottomMarginMobile'] = '0';
            }
            $selectors[$selector_full_width_class] = $pairs_full_width_class;
            $selectors[$selector] = $pairs;
            break;
        }



        case 'uagb/buttons-child': {
                $selector_outer = $uagb_sel_id . ' .uagb-buttons-repeater';
                $pairs_outer = array(
                    'background' => $mods['button_back'],
                    'borderColor' => $mods['button_font'],
                    'borderWidth' => $mods['button_border_width'] . 'px',
                    'borderRadius' => $mods['button_border_radius'] . 'px',
                    'borderStyle' => 'solid'
                );
                $selector = $uagb_sel_id . ' .uagb-buttons-repeater  a.uagb-button__link';
                $pairs = array(
                    'size' => $mods['button_font_size'] . 'px',
                    'vPadding' => $mods['button_vert_padding'] . 'px',
                    'hPadding' => $mods['button_hor_padding'] . 'px',
                    'color' => $mods['button_font']
                );
                $selector_outer_hover = $uagb_sel_id . ' .uagb-buttons-repeater:hover';
                $pairs_outer_hover = array(
                    'hColor' => $mods['button_font_hover'],
                    'borderHColor' => $mods['button_font_hover'],
                    'hBackground' => $mods['button_back_hover'],
                    'borderWidth' => $mods['button_border_width'] . 'px'
                );
                $selector_hover = $uagb_sel_id . ' .uagb-buttons-repeater  a.uagb-button__link:hover';
                $pairs_hover = array(
                    'hColor' => $mods['button_font_hover']
                );
                $selectors[$selector_outer] = $pairs_outer;
                $selectors[$selector] = $pairs;
                $selectors[$selector_outer_hover] = $pairs_outer_hover;
                $selectors[$selector_hover] = $pairs_hover;
            break;
        }

        case 'uagb/call-to-action': {
            $selector = $uagb_sel_id . ' .uagb-cta__button-wrapper a.uagb-cta-typeof-button';
            $pairs = array(
                'ctaBgColor' => $mods['button_back'],
                'ctaBorderColor' => $mods['button_font'],
                'ctaBorderWidth' => $mods['button_border_width'] . 'px',
                'ctaBorderRadius' => $mods['button_border_radius'] . 'px',
                'ctaBorderStyle' => 'solid',
                'ctaFontSize' => $mods['button_font_size'] . 'px',
                'ctaBtnVertPadding' => $mods['button_vert_padding'] . 'px',
                'ctaBtnHrPadding' => $mods['button_hor_padding'] . 'px',
                'ctaBtnLinkColor' => $mods['button_font']
            );

            $selector_hover = $uagb_sel_id . ' .uagb-cta__button-wrapper a.uagb-cta-typeof-button:hover';
            $pairs_hover = array(
                'ctaBgHoverColor' => $mods['button_back_hover'],
                'ctaBorderhoverColor' => $mods['button_font_hover'],
                'ctaLinkHoverColor' => $mods['button_font_hover']
            );

            $selector_outer = $uagb_sel_id;
            $pairs_outer = array(
                'rightPadding' => '10px',
                'leftPadding' => '10px'
            );
            $selectors[$selector] = $pairs;
            $selectors[$selector_hover] = $pairs_hover;
            $selectors[$selector_outer] = $pairs_outer;
            break;
        }

//.uagb-block-c44ffafe-724a-4a73-a427-976ad12f06ab .uagb-post-pagination-wrap a
        case 'uagb/post-grid':
        case 'uagb/post-masonry':
        case 'uagb/post-carousel': {
            $id_item = str_replace('uagb/post-', '', $block['blockName']);

            $selector_outer = $uagb_sel_id . ' .uagb-post__text .uagb-post__cta, ' . $uagb_sel_id . ' .uagb-post-pagination-wrap .page-numbers';
            $pairs_outer = array(
                'ctaBgColor' => $mods['button_back'],
                'borderColor' => $mods['button_font'],
                'borderWidth' => $mods['button_border_width'] . 'px',
                'borderRadius' => $mods['button_border_radius'] . 'px',
                'borderStyle' => 'solid'
            );
            $selector = $uagb_sel_id . ' .uagb-post__text .uagb-post__cta a, ' . $uagb_sel_id . '  .uagb-post-pagination-wrap a';
            $pairs = array(
                'ctaFontSize' => $mods['button_font_size'] . 'px',
                'btnVPadding' => $mods['button_vert_padding'] . 'px',
                'btnHPadding' => $mods['button_hor_padding'] . 'px',
                'ctaColor' => $mods['button_font']
            );
            $selector_outer_hover = $uagb_sel_id . ' .uagb-post__text .uagb-post__cta:hover,' . $uagb_sel_id . ' .uagb-post-pagination-wrap .page-numbers:hover';
            $pairs_outer_hover = array(
                'ctaBgHColor' => $mods['button_back_hover'],
                'borderHColor' => $mods['button_font_hover']
            );
            $selector_hover = $uagb_sel_id . ' .uagb-post__text .uagb-post__cta a:hover,' . $uagb_sel_id . '  .uagb-post-pagination-wrap a:hover';
            $pairs_hover = array(
                'ctaHColor' => $mods['button_font_hover']
            );
            $selectors[$selector_outer] = $pairs_outer;
            $selectors[$selector] = $pairs;
            $selectors[$selector_outer_hover] = $pairs_outer_hover;
            $selectors[$selector_hover] = $pairs_hover;
            break;
        }


    }
    $mobiles = $tablets = $desktops = '';

    foreach ($selectors as $selector => $pairs) {
        $mobile = $tablet = $desktop = '';
        if (is_array($pairs)) {
            foreach ($pairs as $attr => $value) {
                //a=$block['attrs'] are the non-default values for the element that the plugin is going to styles
                //there fore we wnat to ignore them
                if (!array_key_exists($attr, $block['attrs'])) {
                    if (strpos($attr, 'Mobile') !== false) {
                        $size = 'mobile';
                    } elseif (strpos($attr, 'Tablet') !== false) {
                        $size = 'tablet';
                    } else {
                        $size = 'desktop';
                    }
                    $map = strtolower(str_replace(array('Mobile', 'cta'), array('', ''), $attr));
                    if (isset($att_map[$map]) && is_array($att_map[$map])) {
                        foreach ($att_map[$map] as $attr) {
                            $$size .= $attr . ':' . $value . ';';
                        }
                    }
                }
            }
        }
        if ($desktop) {
            $desktops .= $selector . '{' . $desktop . '}';
        }

        if ($tablet) {
            $tablets .= $selector . '{' . $tablet . '}';
        }

        if ($mobile) {
            $mobiles .= $selector . '{' . $mobile . '}';
        }
    }
    $return = $desktops;
    if ($tablets != '') {
        $return .= '@media(max-width:993px){' . $tablets . '}';
    }
    if ($mobiles) {
        $return .= '@media(max-width:768px){' . $mobiles . '}';
    }
    return $return;
}

function jma_subblock_handler($block, $first, $last, $full, $wrapped, $return = '')
{
    if (isset($block['innerBlocks']) && is_array($block['innerBlocks']) && count($block['innerBlocks'])) {
        $return .= jma_block_handler($block['innerBlocks'], false, true);
    }
    $reforatted_blocks = array('uagb/call-to-action', 'uagb/buttons-child', 'uagb/post-grid', 'uagb/post-masonry', 'uagb/post-carousel','uagb/columns', 'uagb/column', 'uagb/section', 'jma-ghb/featued-block');
    if (is_array($block) && isset($block['blockName']) && is_string($block['blockName'])) {
        if (in_array($block['blockName'], $reforatted_blocks)) {
            $return .= jma_spacing_handler($block, $first, $last, $full, $wrapped);
        }
    }

    return $return;
}

function jma_block_handler($blocks, $full = false, $wrapped = false)
{
    $return = '';
    $numItems = count($blocks);

    foreach ($blocks as $i => $block) {
        $first = $last = false;
        if (!$i) {
            $first = true;
        }
        if ($i === ($numItems-1)) {
            $last = true;
        }
        if (is_array($block) && isset($block['blockName'])) {
            if (isset($block['attrs']['contentWidth']) && $block['attrs']['contentWidth'] == 'full_width') {
                $full = true;
            }
            $return .= jma_subblock_handler($block, $first, $last, $full, $wrapped);
        }
        //reset for top level elements
        if (isset($block['attrs']['contentWidth']) && $block['attrs']['contentWidth'] == 'full_width') {
            $full = false;
        }
    }
    return $return;
}

function jma_gbs_uagb_css()
{
    global $post;
    $mods = jma_gbs_get_theme_mods('jma_gbs_');

    $scroll = $reveal = $data = $print = '';



    $scroll = '$(".wp-block-uagb-section").each(function() {
                $this = $(this);
                classes = $this.attr("class").split(" ");
                var i;
                id = "";
                for (i = 0; i < classes.length; ++i) {
                    if (classes[i].match("^jma-menu")) {
                        id = classes[i];
                    }
                }
                if (id) {
                    jQuery("<div/>", {
                        id: id
                    }).insertBefore($this);
                }
            });';
    $locations = array('header', 'footer');

    if (is_object($post)) {
        $targets = array($post);
    } else {
        $targets = array();
    }
    //getting the special css for header and footer $blocks
    //as well as main content
    if (function_exists('jma_ghb_get_header_footer')) {
        foreach ($locations as $location) {
            $id = jma_ghb_get_header_footer($location);
            if ($id) {
                $targets[] = get_post($id);
            }
        }
    }

    foreach ($targets as $target) {
        $block_css = '';
        $block_css = get_transient('jma_block_uagb_css'. $target->ID);
        if (false === $block_css) {
            // It wasn't there, so regenerate the data and save the transient
            if (function_exists('has_blocks') && has_blocks($target->post_content)) {
                $blocks = parse_blocks($target->post_content);
            }

            if (isset($blocks) && is_array($blocks)) {
                /*echo '<pre>'.$target->post_title;
                print_r($blocks);
                echo '</pre>';*/
                $block_css .= jma_block_handler($blocks, false, false);
            }
            //no timeout - just delete on page update and theme options update
            set_transient('jma_block_uagb_css'. $target->ID, $block_css);
        }
        $print .= $block_css;
    }


    if (jma_gbs_uagb_detect_block('', 'contentWidth', 'full_width') || jma_gbs_uagb_detect_block('', 'contentWidth', 'custom')) {
        //if the page has full width element we use jquery to
        //add class when section comes into view
        $reveal = '$(".uagb-section__inner-wrap, .uagb-columns__inner-wrap").viewportChecker({
                classToAdd: "jma-visible jma-wide-section",
                offset: 0
            });';
        //if the page has full width element we widen it
        $print .=  'body #main, body #main>.wrap {
                max-width:100%;
                padding-left:0!important;
                padding-right:0!important;
        	}
             .entry-content > .wp-block-uagb-section > .uagb-section__inner-wrap>*, .entry-content > .wp-block-uagb-columns > .uagb-columns__inner-wrap>* {
            	opacity: 0;
            	-webkit-backface-visibility: hidden;
            	-webkit-transform: scale(0.8, 0.8) translate3d(0, 0, 0);
            	transform: scale(0.8, 0.8) translate3d(0, 0, 0);
            	-webkit-transition: all .4s ease-in-out;
            	transition: all .4s ease-in-out;
            	-webkit-transition-delay: .15s;
            	transition-delay: .15s;
            }
            /* adding the fade in effect */
             .entry-content > .wp-block-uagb-section > .uagb-section__inner-wrap.jma-visible>*,   .entry-content > .wp-block-uagb-columns > .uagb-columns__inner-wrap.jma-visible>* {
            	opacity: 1;
            	-webkit-transform: scale(1, 1) translate3d(0,0,0);
            	transform: scale(1, 1) translate3d(0,0,0);
            }
            /* constrain width of above and below content widget areas and simple paragraphs */
             .widget-area-collapsible, .entry-content > p {
                max-width:' . ($mods['site_width'] + 0) .'px;
                margin-left: auto;
                margin-right: auto;
                padding-left: 20px;
                padding-right: 20px;
            }';
    }

    //themeblvd styles to buttons
    $print .= 'a[class^="uagb"] {
            border-style:solid;
            letter-spacing: 1px!important;
            line-height: 1.42857143!important;
            font-weight: normal!important;
            text-decoration: none!important;
            text-shadow: none!important;
            text-transform: uppercase;
            border-width: 0;
            transition:all 0.25s!important
        }
        .uagb-cta__button-wrapper {
            display:inline-block;
        }
        .uagb-column__wrap.full-size-content * {
            margin:0
        }
        .white-text a:hover {
            color: #ffffff;
            text-decoration: none
        }
        .white-text {
            color: #ffffff
        }
        .white-text a {
            color: #dddddd;
            font-weight: bold;
            text-decoration: underline
        }';

    if (function_exists('jmaminifyCss')) {
        $print = jmaminifyCss($print);
    }

    if ($print) {
        wp_add_inline_style('JMA_GBS_combined_css', apply_filters('jma_gbs_uagb_css_output', $print.'yyyyy'));
    }
    if ($reveal || $scroll) {
        $data = 'jQuery(document).ready(function($) {' . $reveal . $scroll . '});';
        wp_add_inline_script('JMA_GBS_viewport_js', $data);
    }
    //}
}

function jma_gbs_uagb_dynamic_styles_filter($dynamic_styles)
{
    $mods = jma_get_theme_values();
    $dynamic_styles['uagb_10'] = array('a[class^="uagb"]',
    array('color', $mods['button_font'] . '!important'),
    array('background-color',  $mods['button_back'] . '!important'),
    array('border-color', $mods['button_font'] . '!important')
);
    $dynamic_styles['uagb_20'] = array('a[class^="uagb"]:hover',
    array('color', $mods['button_font_hover'] . '!important'),
    array('background-color',  $mods['button_back_hover'] . '!important'),
    array('border-color', $mods['button_font_hover'] . '!important'),
);
    return $dynamic_styles;
}
//add_filter('dynamic_styles_filter', 'jma_gbs_uagb_dynamic_styles_filter');
function jma_gbs_uagb_delete_trans($post_ID)
{
    delete_transient('jma_block_uagb_css'. $post_ID);
}

function jma_gbs_uagb_delete_all_trans()
{
    global $wpdb;

    $plugin_options = $wpdb->get_results("SELECT option_name FROM $wpdb->options WHERE option_name LIKE '_transient_jma_block_uagb_css%' OR option_name LIKE '_transient_timeout_jma_block_uagb_css%'");

    foreach ($plugin_options as $option) {
        delete_option($option->option_name);
    }
}

function jma_gbs_uagb_update_styles()
{
    //customize_save_after  https://developer.wordpress.org/reference/hooks/customize_save_after/
    add_action('customize_save_after', 'jma_gbs_uagb_delete_all_trans');
}
//add_action('admin_init', 'jma_gbs_uagb_update_styles', 11);

add_action('post_updated', 'jma_gbs_uagb_delete_trans');

$gutter_options = array(
    array(
    'name' 		=> 'Default Column Gutters (advanced columns)',
    'desc' 		=> 'Width between advanced columns columns elements in px (don\'t add unit abbreviation)',
    'id' 		=> 'uagb_gutter',
    'std'		=> '20',
    'type' 		=> 'text'
    )
);
