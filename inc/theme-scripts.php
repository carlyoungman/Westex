<?php

/*==================================
|    Theme Scripts & Styles
==================================*/

// Load theme stylesheets
function yr_load_styles()
{
    $styles = get_stylesheet_directory_uri().'/dist/assets/css/main.css';
    $stylesVersion = filemtime(get_stylesheet_directory().'/dist/assets/css/main.css');
    wp_enqueue_style('Yeahright-Styles', $styles, null, $stylesVersion);
}
add_action('wp_enqueue_scripts', 'yr_load_styles');

// Load theme scripts
function yr_load_scripts()
{
    global $googleAPIKey;
//    wp_enqueue_script(
//        'handlebars',
//        'https://ajax.googleapis.com/ajax/libs/handlebars/4.7.7/handlebars.min.js',
//        [],
//        time(),
//        true
//    );
//    wp_enqueue_script(
//        'polyfill',
//        'https://polyfill.io/v3/polyfill.min.js?features=default',
//        [],
//        time(),
//        true
//    );
//    wp_enqueue_script(
//        'maps',
//        'https://maps.googleapis.com/maps/api/js?key='. $googleAPIKey . '&libraries=places,geometry&solution_channel=GMP_QB_locatorplus_v4_cABD',
//        [],
//        time(),
//        true
//    );

    wp_register_script(
        'westex',
        get_template_directory_uri() . '/dist/assets/js/main.js',
        [],
        time(),
        true
    );
    wp_localize_script(
        'westex',
        'ajax_params',
        [
            'ajaxurl'   => site_url() . '/wp-admin/admin-ajax.php',
            'ajaxNonce' => wp_create_nonce( 'load_more_nonce' ),
        ]
    );
    wp_enqueue_script( 'westex' );
}
add_action('wp_enqueue_scripts', 'yr_load_scripts');

function retailer_scripts(){

}
