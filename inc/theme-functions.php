<?php
/*==================================
|    Theme Custom Functions
==================================*/
global $prefix;
global $googleAPIKey;

// GET THEME PREFIX
// Retrieves global theme prefix for naming conventions
function get_theme_prefix()
{
    global $prefix;
    return $prefix;
}

// RETURN SVG CONTENT
function svg($name)
{
    // Locate svg file
    $svg_file = file_get_contents(get_template_directory() . '/dist/assets/images/SVG/' . $name . '.svg');
    // Return SVG code if available, or false if not
    if ($svg_file) {
        return $svg_file;
    } else {
        return false;
    }
}

function yr_socials($classes = "", $svg = false)
{
    // Get socials from backend
    $socials = get_field('social_profiles', 'option');
    // Open list tag
    $html = '<ul class="socials ' . $classes . '">';

    // Build list items
    foreach ($socials as $key => $val) {

        // Format for name
        $name = str_replace('yr_social_', '', $key);
        $icon = ($svg) ? get_template_directory_uri() . '/dist/assets/images/SVG/icon-' . $name . '.svg' : $name;

        if ($val != '' && $name !== '') {
            if ($svg) {
                $html .= '<li><a href="' . $val . '" title="Follow us on ' . ucfirst($name) . '"><img src="' . $icon . '" alt="' . $name . '"/></a></li>';
            } else {
                $html .= '<li><a href="' . $val . '" title="Follow us on ' . ucfirst($name) . '">' . $icon . '</a></li>';
            }
        }
    }

    // Close list tag
    $html .= '</ul>';

    return $html;
}



// IMAGE MARKUP BUILDER
function yr_image($imgId = false, $sizes = '100vw', $lazyLoad = true)
{
    $html = '';
    if ($imgId) {

        // build image array
        $imgObj = array(
            'sizes' => array(
                'large' => (wp_get_attachment_image_url($imgId, 'large') ? wp_get_attachment_image_url($imgId, 'large') : ''),
                'medium' => (wp_get_attachment_image_url($imgId, 'medium') ? wp_get_attachment_image_url($imgId, 'medium') : ''),
                'thumb' => (wp_get_attachment_image_url($imgId, 'thumbnail') ? wp_get_attachment_image_url($imgId, 'thumbnail') : ''),
            ),
            'alt' => (isset(get_post_meta($imgId, '_wp_attachment_image_alt')[0])) ? get_post_meta($imgId, '_wp_attachment_image_alt')[0] : get_the_title($imgId)
        );


        // BUILD SRCSET
        $srcset = 'srcset="';

        // Set default src
        $default = (isset($imgObj['sizes']['thumb'])) ? $imgObj['sizes']['thumb'] : $imgObj['url'];

        // Add thumb size
        if (isset($imgObj['sizes']['thumb'])) {
            $srcset .= $imgObj['sizes']['thumb'] . ' 300w,';
        }

        // Add small size
        if (isset($imgObj['sizes']['thumb'])) {
            $srcset .= $imgObj['sizes']['thumb'] . ' 500w,';
        }

        // Add medium size
        if (isset($imgObj['sizes']['medium'])) {
            $srcset .= $imgObj['sizes']['medium'] . ' 800w,';
        }
        // Add large size
        if (isset($imgObj['sizes']['large'])) {
            $srcset .= $imgObj['sizes']['large'] . ' 1200w';
        }
        $srcset .= '"';
        // CLOSE SRCSET

        // Option to disable browser-native lazy loading (limited compatibility at time of writing)
        $lazy = ($lazyLoad) ? 'loading="lazy"' : '';

        // Get title (used as alt fallback)
        $title = (isset($imgObj['title'])) ? $imgObj['title'] : '';

        // Set alt if one is available (if not fallback to title)
        $alt = ($imgObj['alt']) ? 'alt="' . $imgObj['alt'] . '"' : 'alt="' . $title . '"';

        $classes = (isset($imgObj['classes'])) ? ' class="' . $imgObj['classes'] . '"' : '';
        $html .= '<img src="' . $default . '" ' . $srcset . ' ' . $alt . $classes . ' ' . $lazy . ' sizes="' . $sizes . '" />';

        // Return markup
        return $html;
    } else {
        return false;
    }
}




// STYLED BUTTON BUILDER
function yr_button($props, $link = true)
{

    if (!is_array($props)) {
        return false;
    }

    if (!$link) {
        $tagOpen = '<button ';
        $tagClose = '</button>';
    } else {
        $tagOpen = '<a ';
        $tagClose = '</a>';
    }

    // Destructure passed properties
    $url = isset($props['url']) ? $props['url'] : '';
    $target = (isset($props['target']) && $props['target'] !== '') ? $props['target'] : '_self';
    $title = isset($props['title']) ? $props['title'] : '';
    $classes = isset($props['classes']) ? $props['classes'] : '';
    $href = ($link) ? 'rel="noreferrer noopener" href="' . $url . '" target="' . $target . '"' : '';

    // Final construction
    $html = $tagOpen . ' class="btn ' . $classes . '"' . $href . '><span>' . $title . '</span>' . $tagClose;

    return $html;
}



/**
 * This function is responsible for displaying the ACF flexible components
 * Page builder
 * https://www.advancedcustomfields.com/resources/flexible-content/
 */
function get_flexible_components()
{
    $path       = 'template_parts/flexible/';
    $components = [
        'hero',
        'key_information_with_icons',
        'inline_searchbar',
        'browse_by_colour',
        'collections',
        'products',
        'inline_text',
        'inline_content',
        'columns',
        'checklist',
        'retailer_locations',
        'tabbed_content',
        'image_with_content_grid',
        'offset_content_and_images',
        'content_with_form',
        'content_block',
        'section_break'
    ];
    if (have_rows('flexible_components') ) {
        while ( have_rows('flexible_components') ) {
            the_row();
            foreach ( $components as $component ) {
                if (get_row_layout() === $component ) {
                    get_template_part($path . $component);
                }
                wp_reset_postdata();
            }
        }
    }
}

/**
 * This function is responsible for displaying a fallback image if a featured image isn't found
 *
 * @param string $base     Class name that will be applied to each image
 * @param int    $image_id Content's featured image ID
 * @param string $size     image size that should be used for the image
 * @param int    $fallback Fallback image ID
 */
function get_image_with_fallback(
    string $base,
     $image_id,
    string $size,
    int $fallback
): void {
    if (empty($base) ) {
        return;
    }
    if (empty($image_id) ) {
        $image_id = $fallback;
    }

    echo wp_get_attachment_image(
        $image_id,
        $size,
        false,
        [
            'class' => esc_attr($base) . '__image',
        ]
    );
}

function get_hero_links(array $links = null)
{
    if ($links ) :
        foreach ( $links as $link ) :
            $link['link']['classes'] = 'btn--arrow-bold btn--light hero__link';
            echo yr_button($link['link']);
        endforeach;
    endif;
}

/**
 * Checks which options have been set for the block and applies a
 * corresponding class which can be used for styling
 *
 * @param array $options_array Options set for the block
 * @param array $options       Options set for the block via ACF
 */
function apply_classes( array $options_array, array $options ): void
{
    $class = [];
    // Loops the array and echos out the class name
    foreach ( $options_array as $key => $op ) {
        if (isset($options[ $op[0] ]) && $options[ $op[0] ] ) {
            // Applies selected ACF option class if $op[2] = true
            if (isset($op[2]) ) {
                $class[] = $op[1] . ' ' . $options[ $op[0] ];
            } else {
                $class[] = $op[1];
            }
        }
    }
    echo esc_attr(implode(' ', $class));
}


/**
 * @param string $base
 * @param string $tax
 */
function get_tax_list( string $base, string $tax ): void
{
    $terms = wp_list_pluck(get_the_terms(get_the_ID(), $tax), 'name');
    if (! empty($terms) ) {
        echo '<ul class="' . esc_attr($base) . '__tax">';
        foreach ( $terms as $term ) {
            echo '<li class="' . esc_attr($base) . '__tax-term">' . $term . '</li>';
        }
        echo '</ul>';
    }
}

/**
 * @param string      $base
 * @param string|null $tax
 */
function get_tax_list_with_links( string $base = '', string $tax = null, int $limit = 5 ): void
{
    $i  = 0;
    $rtn = '';
    $terms = get_terms(
        [
        'taxonomy' => $tax,
        'hide_empty' => false,
        ]
    );
    if(!empty($terms)) {
        $rtn .= '<ul class="' . esc_attr($base) . '__tax">';
        foreach ( $terms as $term ) {
            if ( $i < $limit ) {
                $rtn .= '<li class="' . esc_attr( $base ) . '__tax-term">';
                $rtn .= '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>';
                $rtn .= '</li>';
                ++ $i;
            }
        }
        $rtn .= '</ul>';
    }
    echo $rtn;
}

function build_section_id(string $id = ''): void{
    if(empty($id)){
        return;
    }
    echo 'id="' . $id .'"';
}

/**
 * This function is used to get parameters out the URL
 * @return array|string
 */
function check_URL(){
    $url = $_SERVER['REQUEST_URI'];
    $values = '';
    if(!empty($url)){
        $values = parse_url($url);
        $values = implode("/", $values);
        $values = explode( '/', $values );
        $values = array_slice($values,  1, -1);
    }
    return $values;
}

/**
 * @param bool $echo
 * @param bool $address_flag
 * @param bool $number_flag
 * @param bool $email_flag
 * @return string|void
 */
function display_contact_info(bool $echo = true, bool $address_flag = true, bool $number_flag = true, bool $email_flag = true){
    $contact_info = get_field('contact_info', 'options');
    $rtn = '';
        if(true === $address_flag && !empty($contact_info['address'])){
            $rtn  .= '<address><div class="inline-link__icon-wrap">
                        <svg class="button-icon icon icon--m">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-location"></use>
                        </svg>
                    </div>' . $contact_info['address'] . '</address>';
        }
    if(true === $number_flag && !empty($contact_info['customer_service_number'])){
        $rtn  .= '<a class="inline-link" href="tel:'. $contact_info['customer_service_number'] .'">
                    <div class="inline-link__icon-wrap">
                        <svg class="button-icon icon icon--m">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-phone"></use>
                        </svg>
                    </div>
                     <div class="inline-link__content-wrap">
                        <span>Westex Customer Service</span>
                        <span>' . $contact_info['customer_service_number'] . '</span>
                     </div>
                    </a>';
    }
    if(true === $email_flag&& !empty($contact_info['email'])){
        $rtn  .= '<a class="inline-link" href="mailto:'. $contact_info['email'] .'?subject=contact-form">
                    <div class="inline-link__icon-wrap">
                        <svg class="button-icon icon icon--m">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-email"></use>
                        </svg>
                    </div>
                     <div class="inline-link__content-wrap">
                        <span>Email us</span>
                        <span>' . $contact_info['email'] . '</span>
                </div></a>';
    }
        if(true !== $echo){
            return $rtn;
        }
        echo $rtn;
}
