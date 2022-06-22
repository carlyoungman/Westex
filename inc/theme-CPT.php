<?php
/**
 * Theme Custom post types
 **/

add_action(
    'init', function () {
        register_extended_post_type(
            'Carpet', [
            'menu_icon' => 'dashicons-layout',
            'has_archive' => false,
            'rewrite' => array(
                'slug' => 'carpet',
                'with_front' => true,
                'hierarchical' => true
            ),
            'admin_cols' => [
                'carpet_colour' => [
                    'taxonomy' => 'carpet-colour'
                ],
                'carpet_collection' => [
                    'taxonomy' => 'carpet-collection'
                ],
            ],
            'admin_filters' => [
                'carpet_colour' => [
                    'taxonomy' => 'carpet-colour'
                ],
                'carpet_collection' => [
                    'taxonomy' => 'carpet-collection'
                ],
            ],
            ]
        );

        register_extended_post_type(
            'lvtflooring', [
                'menu_icon' => 'dashicons-layout',
                'has_archive' => false,
                'rewrite' => array(
                    'slug' => 'lvt-flooring',
                    'with_front' => true,
                    'hierarchical' => false
                ),
                'admin_cols' => [
                    'lvtflooring_colour' => [
                        'taxonomy' => 'lvtflooring-colour'
                    ],
                    'lvtflooring_collection' => [
                        'taxonomy' => 'lvtflooring-collection'
                    ],
                ],
                'admin_filters' => [
                    'lvtflooring_colour' => [
                        'taxonomy' => 'lvtflooring-colour'
                    ],
                    'lvtflooring_collection' => [
                        'taxonomy' => 'lvtflooring-collection'
                    ],
                ],
            ],
            [
                'singular' => 'LVT Flooring',
                'plural'   => 'LVT Flooring',
            ]
        );
        register_extended_post_type(
            'Inspiration', [
                'menu_icon' => 'dashicons-star-filled',
                'has_archive' => false,
                'rewrite' => array(
                    'slug' => 'inspiration',
                    'with_front' => true,
                    'hierarchical' => false
                ),
            ],
            [
                'singular' => 'Inspiration',
                'plural'   => 'Inspiration',
                ]
        );
//        register_extended_post_type(
//            'Retailer', [
//            'menu_icon' => 'dashicons-store',
//            'has_archive' => false,
//            'rewrite' => array(
//                'slug' => 'find-a-retailer',
//                'with_front' => false,
//                'hierarchical' => false
//            )
//            ]
//        );
    }
);
