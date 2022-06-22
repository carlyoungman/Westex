<?php
/**
 * Template part for displaying the store location plugin template
 *
 * @package gamezebo
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit();
endif;
$base = 'back-to-top';
$base           = 'retailer-locations';
$base_card      = 'retailer-card';
$preview_text   = get_field('find_a_retailer', 'option')['content'];
global $wpsl_settings, $wpsl;
$output = $this->get_custom_css();
$autoload_class = (!$wpsl_settings['autoload']) ? 'class="wpsl-not-loaded"' : '';



$output .= '<section class="' . esc_attr($base) . ' has-background" id="map-container">';
    $output .= '<div class="container-fluid container--max">';
       $output .= '<div class="row">';
            $output .= '<div class="col-lg-6">';
            $output .= '<div class="'. esc_attr($base) . '__panel" id="">';
                $output .=  '<div class="'. esc_attr($base) . '__inner"  id="">';
                            $output .=  '<span class="'. esc_attr($base) . '__blackground">';
                                 $output .= '<h1 class="'. esc_attr($base) . '__headline">';
                                     $output .=  esc_html__( 'Find your nearest Westex retailer'  , 'westex' );
                                $output .= '</h1>';
                                    $output .= '<form class="'. esc_attr($base) . '__form" autocomplete="off">';
                                         $output .= '<div id="search-overlay-search"  class="'. esc_attr($base) . '__search-input">';
//                                            $output .= '<label for="wpsl-search-input">' . esc_html($wpsl->i18n->get_translation('search_label', __('Your location', 'wpsl'))) . '</label>';
                                            $output .= '<input  class="'. esc_attr($base) . '__input" id="wpsl-search-input" type="text" value="' . apply_filters('wpsl_search_input', '') . '" name="wpsl-search-input" placeholder="Enter your address or postcode"  aria-required="true" />';
                                        $output .= '<svg id="wpsl-search-btn" class="'. esc_attr($base) . '__icon icon icon--m"><use xlink:href="#icon-search"></use></svg>';
                                        $output .= '</div>';




//                        if ($wpsl_settings['radius_dropdown'] || $wpsl_settings['results_dropdown']) {
//                            $output .= '<div class="wpsl-select-wrap">';
//                            if ($wpsl_settings['radius_dropdown']) {
//                                $output .= '<div id="wpsl-radius">';
//                                $output .= '<label for="wpsl-radius-dropdown">' . esc_html($wpsl->i18n->get_translation('radius_label', __('Search radius', 'wpsl'))) . '</label>';
//                                $output .= '<select id="wpsl-radius-dropdown" class="wpsl-dropdown" name="wpsl-radius">';
//                                $output .=  $this->get_dropdown_list('search_radius');
//                                $output .=  '</select>';
//                                $output .= '</div>';
//                            }
//                            if ($wpsl_settings['results_dropdown']) {
//                                $output .= '<div id="wpsl-results">';
//                                $output .= '<label for="wpsl-results-dropdown">' . esc_html($wpsl->i18n->get_translation('results_label', __('Results', 'wpsl'))) . '</label>';
//                                $output .= '<select id="wpsl-results-dropdown" class="wpsl-dropdown" name="wpsl-results">';
//                                $output .=  $this->get_dropdown_list('max_results');
//                                $output .= '</select>';
//                                $output .= '</div>';
//                            }
//                            $output .= '</div>';
//                        }

                        if ($this->use_category_filter()) {
                            $output .= $this->create_category_filter();
                        }
                        $output .= '<p class="helper">Press enter or click the magnifying glass to search</p>';
                        $output .= '</form>';
                            $output .= '</span>';
    $output .= '<div id="wpsl-stores" ' . $autoload_class . '>';
        $output .= '<ul class="'. esc_attr($base) . '__results"></ul>';
    $output .= '</div>';
    $output .= '<div id="wpsl-direction-details">';
        $output .= $preview_text;
    $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
            $output .= '<div class="col-lg-6">';
                $output .= '<div id="wpsl-gmap" class="wpsl-gmap-canvas retailer-locations__map"></div>';
            $output .= '</div>';
            $output .= '</div>';
    $output .= ' </div>';
$output .= '</section';
$output .= '</div>';
return $output;
