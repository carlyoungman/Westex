<?php
/*==================================
|	Carpet collection taxonomy page
==================================*/
global $prefix;
get_header();
global $wp_query;
get_template_part(
    'template_parts/flexible/inline_searchbar', null,
    [
        'data' => [
            'headline' => 'You searched for "'. ucfirst(get_search_query()) .'"',
            'supports' => 'Your search returned ' . $wp_query->found_posts . ' result(s)',
            'placeholder' =>  'Search for a swatch'
        ],
    ]
);
get_template_part( 'template_parts/flexible/products', null,
    [
        'data' => [
            'placeholder' =>  'Search for a swatch',
            'filtersCheck' => false,
            'search' => true
        ],
    ]);
get_footer();
