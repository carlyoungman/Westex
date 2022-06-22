<?php
/*==================================
|	Home Meta
==================================*/
if(function_exists('acf_add_local_field_group')){
	// Home Page Meta
	acf_add_local_field_group(array (
		'key' => $prefix.'theme_home',
        'title' => 'Home Page Meta',
        'fields' => array(
            array(
                'key' => $prefix."616d78e9713a1",
                'name' => $prefix.'hero',
                'label' => 'Hero Section Settings',
                'type' => 'group',
                'sub_fields' => array(
                    array(
                        'key' => $prefix . "616d78e9713a1a",
                        'name' => 'type',
                        'label' => 'Hero Type',
                        'type' => 'radio',
                        'instructions' => 'Select a hero layout type',
                        'layout' => 'horizontal',
                        'default_value' => 'image',
                        'choices' => array(
                            'image' => 'Image',
                            'slideshow' => 'Slideshow',
                            'text' => 'Text',
                        ),
                        'wrapper' => array(
                            'width' => 50
                        )
                    ),
                    array(
                        'key' => $prefix . "616d78e9713a1b",
                        'name' => 'title',
                        'label' => 'Hero Title',
                        'type' => 'text',
                        'instructions' => 'Specify a title for the hero section (defaults to page title)',
                        'wrapper' => array(
                            'width' => 50
                        ),
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $prefix . "616d78e9713a1a",
                                    'operator' => '!=',
                                    'value' => 'slideshow',
                                ),
                            ),
                        )
                    ),
                    array(
                        'key' => $prefix . "616d78e9713a1c",
                        'name' => 'text',
                        'label' => 'Hero Text',
                        'type' => 'textarea',
                        'new_lines' => 'br',
                        'instructions' => 'Specify body text for the hero section',
                        'wrapper' => array(
                            'width' => 40
                        ),
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $prefix . "616d78e9713a1a",
                                    'operator' => '!=',
                                    'value' => 'slideshow',
                                ),
                            ),
                        )
                    ),
                    array(
                        'key' => $prefix . "616d78e9713a1d",
                        'name' => 'links',
                        'label' => 'Hero Links',
                        'type' => 'repeater',
                        'instructions' => 'Specify up to 4 links or URLs',
                        'max' => 3,
                        'button_label' => 'Add Link',
                        'sub_fields' => array(
                            array(
                                'key' => $prefix . "616d78e9713a1da",
                                'name' => 'link',
                                'label' => 'Link',
                                'type' => 'link',
                            )
                        ),
                        'wrapper' => array(
                            'width' => 40
                        ),
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $prefix . "616d78e9713a1a",
                                    'operator' => '!=',
                                    'value' => 'slideshow',
                                ),
                            ),
                        )
                    ),
                    array(
                        'key' => $prefix . "616d78e9713a1e",
                        'name' => 'image',
                        'label' => 'Hero Image',
                        'type' => 'image',
                        'instructions' => 'Select a hero image',
                        'wrapper' => array(
                            'width' => 20
                        ),
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => $prefix . "616d78e9713a1a",
                                    'operator' => '==',
                                    'value' => 'image',
                                ),
                            ),
                        )
                    ),
                    array(
                        'key' => $prefix . "616d78e9713a1f",
                        'name' => 'slideshow',
                        'label' => 'Hero Slideshow',
                        'type' => 'repeater',
                        'button_label' => 'Add Slide',
                        'layout' => 'block',
                        'wrapper' => array(
                            'width' => 100
                        ),
                        'sub_fields' => array(
                            array(
                                'key' => $prefix . "616d78e9713a1fa",
                                'name' => 'title',
                                'label' => 'Slide Title',
                                'type' => 'text',
                                'instructions' => 'Specify a title for the hero section (defaults to page title)',
                                'wrapper' => array(
                                    'width' => 50
                                ),
                            ),
                            array(
                                'key' => $prefix . "616d78e9713a1fb",
                                'name' => 'text',
                                'label' => 'Slide Text',
                                'type' => 'textarea',
                                'new_lines' => 'br',
                                'instructions' => 'Specify body text for the hero section',
                                'wrapper' => array(
                                    'width' => 50
                                ),
                            ),
                            array(
                                'key' => $prefix . "616d78e9713a1fc",
                                'name' => 'image',
                                'label' => 'Slide Image',
                                'type' => 'image',
                                'wrapper' => array(
                                    'width' => 33
                                ),
                            ),
                            array(
                                'key' => $prefix . "616d78e9713a1fd",
                                'name' => 'links',
                                'label' => 'Slide Links',
                                'type' => 'repeater',
                                'instructions' => 'Specify up to 4 links or URLs',
                                'max' => 3,
                                'button_label' => 'Add Link',
                                'wrapper' => array(
                                    'width' => 66
                                ),
                                'sub_fields' => array(
                                    array(
                                        'key' => $prefix . "616d78e9713a1fe",
                                        'name' => 'link',
                                        'label' => 'Link',
                                        'type' => 'link',
                                    )
                                ),
                            ),
                        ),
                        'conditional_logic' => array(
                            array (
                                array (
                                    'field' => $prefix . "616d78e9713a1a",
                                    'operator' => '==',
                                    'value' => 'slideshow',
                                ),
                            ),
                        )
                    ),
                )
            ),
            array(
                'key' => $prefix."615d89e9713a1",
                'name' => $prefix.'intro',
                'label' => 'Intro Section Settings',
                'type' => 'group',
                'sub_fields' => array(
                    array(
                        'key' => $prefix."615d89e9713a1a",
                        'name' => 'title',
                        'label' => 'Intro Title',
                        'type' => 'text',
                        'instructions' => 'Specify intro title text',
                    ),
                    array(
                        'key' => $prefix."615d89e9713a1b",
                        'name' => 'text',
                        'label' => 'Intro Text',
                        'type' => 'textarea',
                        'new_lines' => 'br',
                        'instructions' => 'Specify intro body text',
                        'wrapper' => array(
                            'width' => 50
                        ),
                    ),
                    array(
                        'key' => $prefix."615d89e9713a1c",
                        'name' => 'images',
                        'label' => 'Intro Images',
                        'type' => 'gallery',
                        'max' => 2,
                        'instructions' => 'Select up to two images',
                        'wrapper' => array(
                            'width' => 50
                        ),
                    ),
                    array(
                        'key' => $prefix."615d89e9713a1d",
                        'name' => 'link',
                        'label' => 'Intro Link',
                        'type' => 'link',
                        'instructions' => 'Specify a page or URL to link to',
                    ),
                )
            ),
            array(
                'key' => $prefix."615d77e9713a2",
                'name' => $prefix.'featured',
                'label' => 'Collections Section Settings',
                'type' => 'group',
                'sub_fields' => array(
                    array(
                        'key' => $prefix."615d77e9713a2b",
                        'name' => 'title',
                        'label' => 'Collections Title',
                        'type' => 'text',
                        'instructions' => 'Specify a title for the featured content',
                    ),
                    array(
                        'key' => $prefix."615d77e9713a2c",
                        'name' => 'text',
                        'label' => 'Collections Text',
                        'type' => 'textarea',
                        'instructions' => 'Specify body text for the featured content',
                        'wrapper' => array(
                            'width' => 50
                        ),
                    ),
                    array(
                        'key' => $prefix."615d77e9713a2d",
                        'name' => 'link',
                        'label' => 'Collections Link',
                        'type' => 'link',
                        'instructions' => 'Specify a page or URL to link to',
                        'wrapper' => array(
                            'width' => 50
                        ),
                    ),
                    array(
                        'key' => $prefix."615d77e9713a2a",
                        'name' => 'items',
                        'label' => 'Collection Items',
                        'type' => 'taxonomy',
                        'taxonomy' =>'carpet-collection',
                        'field_type' => 'multi_select',
                        'instructions' => 'Select which taxonomy terms to display',
                    ),
                )
            ),
            array(
                'key' => $prefix."615d88e1813a",
                'name' => $prefix.'full',
                'label' => 'Full Section Settings',
                'type' => 'group',
                'sub_fields' => array(
                    array(
                        'key' => $prefix."615d88e1813aa",
                        'name' => 'title',
                        'label' => 'Full-Width Title',
                        'type' => 'text',
                        'instructions' => 'Specify a title for the full-width content',
                        'wrapper' => array(
                            'width' => 50
                        ),
                    ),
                    array(
                        'key' => $prefix."615d88e1813ad",
                        'name' => 'image',
                        'label' => 'Full-Width Image',
                        'type' => 'image',
                        'instructions' => 'Select an image to appear as the background',
                        'wrapper' => array(
                            'width' => 50
                        ),
                    ),
                    array(
                        'key' => $prefix."615d88e1813ab",
                        'name' => 'text',
                        'label' => 'Full-Width Text',
                        'type' => 'textarea',
                        'instructions' => 'Specify body text for the full-width content',
                    ),
                    array(
                        'key' => $prefix."615d88e1813ac",
                        'name' => 'link',
                        'label' => 'Full-Width Link',
                        'type' => 'link',
                        'instructions' => 'Specify a page or URL to link to',
                    ),
                )
            ),
            array(
                'key' => $prefix."715d88e2913",
                'name' => $prefix.'inline',
                'label' => 'Inline Section Settings',
                'type' => 'group',
                'sub_fields' => array(
                    array(
                        'key' => $prefix."715d88e2913a",
                        'name' => 'title',
                        'label' => 'Inline Title',
                        'type' => 'text',
                        'instructions' => 'Specify a title for the inline content',
                        'wrapper' => array(
                            'width' => 50
                        ),
                    ),
                    array(
                        'key' => $prefix."715d88e2913b",
                        'name' => 'text',
                        'label' => 'Inline Text',
                        'type' => 'textarea',
                        'instructions' => 'Specify body text for the inline content',
                        'wrapper' => array(
                            'width' => 50
                        ),
                    ),
                    array(
                        'key' => $prefix."715d88e2913c",
                        'name' => 'link',
                        'label' => 'Inline Link',
                        'type' => 'link',
                        'instructions' => 'Specify a page or URL to link to',
                        'wrapper' => array(
                            'width' => 50
                        ),
                    ),
                    array(
                        'key' => $prefix."715d88e2913d",
                        'name' => 'image',
                        'label' => 'Inline Image',
                        'type' => 'image',
                        'instructions' => 'Select an image to appear alongside the content',
                        'wrapper' => array(
                            'width' => 50
                        ),
                    ),
                )
            )

        ),
		'location' => array (
			array (
				array (
					'param' => 'page_type',
					'operator' => '==',
					'value' => 'front_page',
				),
			),
		),
	));

}
