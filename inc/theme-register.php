<?php
/*======================================
|	Theme Register (Post types etc)
======================================*/

// REGISTER SIDEBARS

function yr_register_sidebars() {

    $footer = array(
        'id' => 'footer-widgets',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<p class="widgettitle">',
        'after_title' => '</p>',
        'name'=>__( 'Footer Widgets', 'yeah-right' ),
    );

    register_sidebar($footer);

}

add_action('init', 'yr_register_sidebars');
