<?php
/*==================================
|    Theme Initialisation
==================================*/

// SET GLOBAL PREFIX
// This is used for naming convetions in ACF (defaults to 'yr_')
function yr_global()
{
    global $prefix;
    $prefix = 'yr_';

    global $run_once;
    $run_once = 0;

}

if( class_exists('ACF') ) {
    global $googleAPIKey;
    $googleAPIKey = get_field( 'more', 'options' )['google_map_api_key'] ?: '';
}

add_action('init', 'yr_global');

add_filter( 'use_block_editor_for_post', '__return_false' );

// Add Thumbnail Support
add_theme_support('post-thumbnails', array( 'post'));

// Add Title Tag Support
add_theme_support('title-tag');

// Change Title Tag Seperator
function yr_title_seperator( $sep )
{
    return  '|';
}
add_filter('document_title_separator', 'yr_title_seperator');

// Allow SVG Uploads
function yr_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'yr_mime_types');


// Removes empty p tags from post content
add_filter(
    'the_content',
    function ( $content ) {
        $content = force_balance_tags( $content );

        return preg_replace( '/<p>(?:\s|&nbsp;)*?<\/p>/i', '', $content );
    },
    10,
    1
);

// Remove <p> and <br/> from Contact Form 7
add_filter( 'wpcf7_autop_or_not', '__return_false' );

// Changing excerpt more
function yr_excerpt_more($more)
{
    global $post;
    remove_filter('excerpt_more', 'yr_excerpt_more');
    return '...';
}
add_filter('excerpt_more', 'yr_excerpt_more');

// Change excerpt length
function yr_excerpt_length( $length )
{
    return 10;
}
add_filter('excerpt_length', 'yr_excerpt_length', 999);

/**
 *  Remove image sizes
 */
remove_image_size('1536x1536');
remove_image_size('2048x2048');

/**
 *  add image sizes
 */

add_image_size('post-thumb', 600, 400, true);
add_image_size('collection_thumnail', 340, '460', true);
add_image_size('hero', '1920', '', false);
add_image_size('filter', '50', '50', true);
add_image_size('product', '240', '240', true);
add_image_size('sample', '120', '120', true);
add_image_size('inline', '600', '700', false);
add_image_size('offset_content_and_images', '450', '600', true);



// Register Menus
function yr_register_menus()
{
    $locs = array(
        'header_menu' => __('Header Menu'),
        'footer_menu' => __('Footer Menu'),
        'legal_menu' => __('Legal Menu'),
        'mobile_menu' => __('Mobile Menu')
    );
    register_nav_menus($locs);
}
add_action('init', 'yr_register_menus');

// Sets API key based on ACF option input after theme setup
function my_acf_google_map_api( $api ){
    $key = get_field('more', 'options')['google_map_api_key'] ?? '';
    if(!empty($key)) {
        $api['key'] = $key;
        return $api;
    }
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


// Saves and load ACF from JSON
add_filter('acf/json_directory', function ($path) {
    return get_template_directory() . '/inc/ACF/JSON';
});

add_filter('acf/settings/save_json', function ($path) {
    return apply_filters("acf/json_directory", NULL);

});

add_filter('acf/settings/load_json', function ($paths) {
    return [
        apply_filters("acf/json_directory", NULL)
    ];
});


/**
 * https://wpstorelocator.co/document/load-custom-store-locator-template/
 */
add_filter( 'wpsl_templates', static function($templates){
    $templates[] = array (
        'id'   => 'custom',
        'name' => 'Custom template',
        'path' => get_stylesheet_directory() . '/template_parts/store-location-template.php',
    );

    return $templates;
});

// Enable tags for the custom post types
add_action('init', static function(){
    register_taxonomy_for_object_type('post_tag', 'carpet');
    register_taxonomy_for_object_type('post_tag', 'lvtflooring');
});




/** This function is adding a custom marker for the locations map
 * https://wpstorelocator.co/document/use-custom-markers/
 * @return string
 */
add_filter( 'wpsl_admin_marker_dir', static function(){
    return get_stylesheet_directory() . '/dist/assets/images/markers/';
});



/** This function is adding a custom marker for the locations map
* https://wpstorelocator.co/document/category-names-in-search-results/
 */
add_filter( 'wpsl_store_meta', function($store_meta, $store_id){
    $terms = get_the_terms( $store_id, 'wpsl_store_category' );
    $store_meta['terms'] = '';
    if ($terms && !is_wp_error($terms)) {
        if ( count( $terms ) > 1 ) {
            $location_terms = array();

            foreach ( $terms as $term ) {
                $location_terms[] = $term->name;
            }

            $store_meta['terms'] = implode( ', ', $location_terms );
        } else {
            $store_meta['terms'] = $terms[0]->name;
        }
    }

    return $store_meta;
}, 10, 2 );





add_filter( 'wpsl_listing_template', function(){
    global $wpsl, $wpsl_settings;
    $listing_template = '<li data-store-id="<%= id %>">';
    $listing_template .= '<div class="wpsl-store-location">';
    $listing_template .= '<h6><%= thumb %>';
    $listing_template .=  wpsl_store_header_template( 'listing' ); // Check which header format we use
    $listing_template .= '</h6>';
    $listing_template .= '<address>';
    $listing_template .= '<span class="wpsl-street"><%= address %></span>';
    $listing_template .= '<% if ( address2 ) { %>';
    $listing_template .= '<span class="wpsl-street"><%= address2 %></span>';
    $listing_template .= '<% } %>';
    $listing_template .= '<span>' . wpsl_address_format_placeholders() . '</span>'; // Use the correct address format

    if ( !$wpsl_settings['hide_country'] ) {
        $listing_template .= '<span class="wpsl-country"><%= country %></span>';
    }
    $listing_template .= '</address>';

    // Include the category names.
    $listing_template .= '<% if ( terms ) { %>';
    $listing_template .= '<div class="terms">';
        $listing_template .= '<p><%= terms %></p>';
    $listing_template .= '</div>';
    $listing_template .= '<% } %>';

    // Show the phone, fax or email data if they exist.
    if ( $wpsl_settings['show_contact_details'] ) {
        $listing_template .= '<div class="wpsl-contact-details">';
        $listing_template .= '<% if ( phone ) { %>';
            $listing_template .= '<p><strong>' . esc_html( $wpsl->i18n->get_translation( 'phone_label', __( 'Phone:', 'wpsl' ) ) ) . '</strong><%= formatPhoneNumber( phone ) %></p>';
        $listing_template .= '<% } %>';
        $listing_template .= '<% if ( fax ) { %>';
            $listing_template .= '<p><strong>' . esc_html( $wpsl->i18n->get_translation( 'fax_label', __( 'Fax:', 'wpsl' ) ) ) . '</strong><%= fax %></p>';
        $listing_template .= '<% } %>';
        $listing_template .= '<% if ( email ) { %>';
            $listing_template .= '<p><strong>' . esc_html( $wpsl->i18n->get_translation( 'email_label', __( 'Email:', 'wpsl' ) ) ) . '</strong><a href="mailto:<%= email %><"><%= email %></a></p>';
        $listing_template .= '<% } %>';
        $listing_template .= '</div>';
    }
    $listing_template .= wpsl_more_info_template(); // Check if we need to show the 'More Info' link and info
    $listing_template .= '</div>';
    if ( !$wpsl_settings['hide_distance'] ) {
        $listing_template .= '<h6 class="distance"><%= distance %> ' . esc_html( $wpsl_settings['distance_unit'] ) . '</h6>';
    }
    $listing_template .= '<%= createDirectionUrl() %>';
    $listing_template .= '</li>';

    return $listing_template;
});
