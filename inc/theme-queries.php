<?php
/** This function is responsible for displaying post from the select post type
 *
 * @param string $post_type
 * @param int $number
 *
 * @return int|void|WP_Query
 */

function get_post_content(
    string $post_type = 'carpet',
    int $number = 24
): WP_Query {
    // Sets the default args for the latest content
    $args = [
        'post_status'    => 'publish',
        'orderby'        => 'post_date',
        'order'          => 'DESC',
        'post_type'      => $post_type,
        'posts_per_page' => $number,
    ];
    //Check the URL for values that can use used for presenting the products block.

    $presets = check_URL();
    if(count($presets) > 2){
        if('carpets' === $presets[0]){
            $presets[0] =  substr($presets[0], 0, -1);
        }
        $args['tax_query'][0] = [
            'taxonomy' => $presets[0] . '-' . $presets[1],
            'field'    => 'slug',
            'terms'    => $presets[2],
        ];
    }



    return new WP_Query( $args );
}

/** This function is responsible for displaying the latest content filters
 *
 * @param string $taxonomy
 *
 */
function get_filters(string $taxonomy = '') {
    return get_terms( $taxonomy,
            [
                'orderby'    => 'name',
                'order'      => 'ASC',
                'hide_empty' => true,
            ]
        );
}

/** This function is responsible for displaying the search results.
 * This query is also passed to the load more search results functionality. Core/Ajax.php
 *
 * @return WP_Query
 */
 function get_search_results(): WP_Query {
    $args      = [];
    if ( ! empty( get_search_query() ) ) {
        $args = [
            's'              => $_GET['s'],
            'order'          => 'ASC',
            'post_status'    => 'publish',
            'orderby'        => 'relevance',
            'relevanssi'     => true,
            'posts_per_page' => 30,
        ];
    }
    return new WP_Query( $args );
}
