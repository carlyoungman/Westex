<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit();
endif;
/*==================================
Colors taxonomy template. Shared between carpets and flooring
==================================*/
$term = get_queried_object();
$key_info = get_field('key_information_with_icons', $term) ?? [];
$post_type = get_taxonomy( $term->taxonomy )->object_type[0];
$columns    = get_field('promotions', 'term_' . $term->term_id) ?: '';
$key_info = get_field('key_information', 'options')['key_information_' . $post_type];
get_header();
get_template_part(
    'template_parts/flexible/key_information_with_icons', null,
    [
        'data' => [
            'key_info' =>  $key_info,
        ],
    ]
);
get_template_part(
    'template_parts/flexible/inline_searchbar', null,
    [
        'data' => [
            'placeholder' =>  'Search all Carpets',
            'remove_padding' => true,
        ],
    ]
);
get_template_part(
    'template_parts/flexible/products', null,
    [
        'data' => [
            'product_type' =>  $post_type
        ],
    ]
);
get_template_part(
    'template_parts/flexible/image_with_content_grid', null,
    [
        'data' => [
            'columns' =>  $columns
        ],
    ]
);
get_footer();
