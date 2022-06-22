<?php
/**
 * Theme Taxonomies
 **/

add_action(
    'init', function () {
        // Carpet colour
        register_extended_taxonomy(
            'carpet-colour', 'carpet', [
            'rewrite' => array('slug' => 'carpets/colour'),
            'admin_cols' => [
                'updated' => [
                    'title_cb'    => function () {
                        return '<em>Last</em> Updated';
                    },
                    'meta_key'    => 'updated_date',
                    'date_format' => 'd/m/Y'
                ],
            ],
            ],
            [
                'singular' => 'Colours',
                'plural'   => 'Colours',
            ]
        );

        // Carpet Collections
        register_extended_taxonomy(
            'carpet-collection', 'carpet', [
            'meta_box' => 'radio',
            'rewrite' => array('slug' => 'carpets/collection'),
                'admin_cols' => [
                    'updated' => [
                        'title_cb'    => function () {
                            return '<em>Last</em> Updated';
                        },
                'meta_key'    => 'updated_date',
                'date_format' => 'd/m/Y'
                    ],
                ],
            ],
            [
                'singular' => 'Collection',
                'plural'   => 'Collections',
            ]
        );
        // LVT flooring colour
        register_extended_taxonomy(
            'lvtflooring-colour', 'lvtflooring', [
            'rewrite' => array('slug' => 'lvtflooring/colour'),
            'admin_cols' => [
            'updated' => [
                'title_cb'    => function () {
                    return '<em>Last</em> Updated';
                },
                'meta_key'    => 'updated_date',
                'date_format' => 'd/m/Y'
            ],
            ],
            ],
            [
            'singular' => 'Colours',
            'plural'   => 'Colours',
            ]
        );
        // LVP Flooring Collections
        register_extended_taxonomy(
            'lvtflooring-collection', 'lvtflooring', [
            'meta_box' => 'radio',
            'rewrite' => array('slug' => 'lvtflooring/collection'),
            'admin_cols' => [
            'updated' => [
                'title_cb'    => function () {
                    return '<em>Last</em> Updated';
                },
                'meta_key'    => 'updated_date',
                'date_format' => 'd/m/Y'
            ],
            ],
            ],
            [
            'singular' => 'Collection',
            'plural'   => 'Collections',
            ]
        );
    }
);

add_action(
    'admin_head', function () {
        echo '<style>
        body.edit-tags-php .acf-field {
            display: none;
        }
      </style>';
    }
);
