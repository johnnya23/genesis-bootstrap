<?php

// search-form same behavior as genesis with additional classes
// for bootstrap styling

add_filter( 'genesis_search_form', 'JMA_GBS_search_form', 10, 4);

function JMA_GBS_search_form( $form, $search_text, $button_text, $label ) {

    $value_or_placeholder = ( get_search_query() == '' ) ? 'placeholder' : 'value';

$format = <<<EOT
<form method="get" class="search-form form-inline" action="%s" role="search">
    <div class="form-group">
        <label class="sr-only sr-only-focusable" for="jma-gbs-search-form">%s</label>
        <div class="input-group">
            <input type="search" class="search-field form-control" id="jma-gbs-search-form" name="s" %s="%s">
            <span class="input-group-btn">
                <button type="submit" class="search-submit btn btn-default">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    <span class="sr-only">%s</span>
                </button>
            </span>
        </div>
    </div>
</form>
EOT;

    return sprintf( $format, home_url( '/' ), esc_html( $label ), $value_or_placeholder, esc_attr( $search_text ), esc_attr( $button_text ) );
}
