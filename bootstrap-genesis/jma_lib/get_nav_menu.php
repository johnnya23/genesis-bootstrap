<?php

function jma_gbs_get_nav_menu($args = [])
{
    $args = wp_parse_args(
        $args,
        [
            'theme_location' => '',
            'container'      => '',
            'menu_class'     => 'menu genesis-nav-menu',
            'link_before'    => genesis_markup(
                [
                    'open'    => '<span %s>',
                    'context' => 'nav-link-wrap',
                    'echo'    => false,
                ]
            ),
            'link_after'     => genesis_markup(
                [
                    'close'   => '</span>',
                    'context' => 'nav-link-wrap',
                    'echo'    => false,
                ]
            ),
            'echo'           => 0,
        ]
    );

    // If genesis-accessibility for 'drop-down-menu' is enabled and the menu doesn't already have the superfish class, add it.
    if (genesis_superfish_enabled() && false === strpos($args['menu_class'], 'js-superfish')) {
        $args['menu_class'] .= ' js-superfish';
    }

    $nav = wp_nav_menu($args);

    // Do nothing if there is nothing to show.

    if (! $nav) {
        return null;
    }

    $sanitized_location = 'primary';
    $nav_markup_open  = genesis_get_structural_wrap('menu-' . $sanitized_location, 'open') . '<div class="outer">';
    $nav_markup_close = '</div>' . genesis_get_structural_wrap('menu-' . $sanitized_location, 'close');

    $nav_output = genesis_markup(
        [
            'open'    => '<nav %s>',
            'close'   => '</nav>',
            'context' => 'nav-' . $sanitized_location,
            'content' => $nav_markup_open .$nav . $nav_markup_close,
            'echo'    => true,
            //'params'  => $params,
        ]
    );

    $filter_location = $sanitized_location . '_nav';

    /**
     * Filter the navigation markup.
     *
     * @since 2.1.0
     *
     * @param string $nav_output Opening container markup, nav, closing container markup.
     * @param string $nav Navigation list (`<ul>`).
     * @param array $args {
     *     Arguments for `wp_nav_menu()`.
     *
     *     @type string $theme_location Menu location ID.
     *     @type string $container Container markup.
     *     @type string $menu_class Class(es) applied to the `<ul>`.
     *     @type bool $echo 0 to indicate `wp_nav_menu()` should return not echo.
     * }
     */
    return apply_filters("genesis_{$filter_location}", $nav_output, $nav, $args);
}
