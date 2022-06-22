<?php
if ( ! defined( 'ABSPATH' ) ) :
    exit();
endif;
/*==================================
 Collection taxonomy template. Shared between carpets and flooring
==================================*/
global $prefix;
$term           = get_queried_object();
$post_type      = get_taxonomy( $term->taxonomy )->object_type[0];
$links          = [];
$media          = get_field('images', $term)['hero_image'] ?? '';
$offset_content = get_field('offset_content_and_images','term_' . $term->term_id) ?? '';
$tabs           = get_field('tabbed_content', 'term_' . $term->term_id) ?? '';
$columns        = get_field('promotions', 'term_' . $term->term_id) ?? '';
$product_count  = get_field('colours_available', 'term_' . $term->term_id) ?? '';
$key_info       = get_field('key_information', 'options')['key_information_' . $post_type];
get_header();
get_template_part( 'template_parts/flexible/hero', null,
    [
        'data' => [
            'type'      => 'Image',
            'title'     => $term->name ?: '',
            'text'      => $term->description ?: '',
            'links'     => $links,
            'media'     => $media
        ],
    ]
);
get_template_part(
    'template_parts/flexible/offset_content_and_images', null,
    [
        'data' => [
            'offset_content' =>  $offset_content
        ],
    ]
);
get_template_part(
    'template_parts/flexible/key_information_with_icons', null,
    [
        'data' => [
            'key_info' =>  $key_info,
            'background' => 'white'
        ],
    ]
);
get_template_part(
    'template_parts/flexible/tabbed_content', null,
    [
        'data' => [
            'intro' =>  'The' . $term->name . 'collection is packed with features',
            'tabs'  => $tabs
        ],
    ]
);
get_template_part(
    'template_parts/flexible/inline_searchbar', null,
    [
        'data' => [
            'headline' => $term->name . ' is available in ' . $product_count . ' colours',
            'supports' => 'You can select up to 3 colours to receive free samples',
            'placeholder' =>  'Search for a swatch'
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
