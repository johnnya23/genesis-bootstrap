<?php
function jma_gbs_local_menu()
{
    global $post;
    if (get_post_meta(get_the_ID(), '_jma_gbs_page_options_key', true)) {
        $page_options =  get_post_meta(get_the_ID(), '_jma_gbs_page_options_key', true);
    }
    if (is_array($page_options) && isset($page_options['scroll_menu']) && $page_options['scroll_menu']) {
        $menuslug = $page_options['scroll_menu'];
    }
    echo wp_nav_menu(array( 'menu' => $menuslug, 'menu_class' => 'jma-local-menu clearfix', 'container' => null ));
}
