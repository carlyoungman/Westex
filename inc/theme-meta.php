<?php
/*==================================
|	Theme Custom Meta Fields
==================================*/

// Used for naming covention throughout field registration
$prefix = 'yr_';


if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Theme Options',
        'menu_title'	=> 'Theme Options',
        'menu_slug' 	=> 'theme-options',
        'capability'	=> 'edit_posts',
        'redirect'		=> false,
    ));

}
// Home Fields
include_once(get_template_directory().'/inc/meta/meta-home.php');
