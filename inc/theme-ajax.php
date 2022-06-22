<?php
/**
 * Theme Ajax
 **/
function load_more_products_ajax_handler() {
    $args    = [];
    check_nonce($_POST['nonce']);

    // The query passed from the latest content php file
    try {
        if ( ! empty( $_POST['query'] ) ) {
            $args = json_decode(
                stripslashes( sanitize_text_field( $_POST['query'] ) ),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        }
    } catch ( Exception $e ) {
        return;
    }
    if ( ! empty( $_POST['query']) ){
        // This is required to override the preset

        // Which page of results to show
        if(! empty( $_POST['page'] ) )  {
            $args['paged'] = sanitize_text_field( $_POST['page'] );
        }
       //  This is responsible for filtering by multiple taxonomies
        if (! empty($_POST['taxonomies']) ) {

            $args['term'] = '';
            $args['taxonomy'] = '';

            $string = stripslashes( sanitize_text_field( $_POST['taxonomies'] ) );
            $string = str_replace('\n', '', $string);
            $string = rtrim($string, ',');
            $string = "[" . trim($string) . "]";
            $taxonomies = json_decode($string, true);
            $count = 0;
            foreach( $taxonomies as $taxonomy){
                if(null !== $taxonomy['term'] && null !== $taxonomy['taxonomy'] ){
                    $args['tax_query'][$count] = [
                        'taxonomy' => sanitize_text_field($taxonomy['taxonomy']),
                        'field'    => 'slug',
                        'terms'    => sanitize_text_field($taxonomy['term']),
                    ];
                    $args['tax_query']['relation'] = 'AND';
                    $count++;
                }
            }
        }
//        else{
//            $args['tax_query'] = '';
//            $args['term'] = '';
//            $args['taxonomy'] = '';
//        }
      //  This block is responsible for getting search content
        if( ! empty($_POST['searchTerm'] && $_POST['searchTerm'] !== 'undefined')) {
            // Remove all the filter terms from the query and just use the search
            $args['tax_query'] = '';
            $args['term'] = '';
            $args['relevanssi'] = true;
            $args['orderby'] = 'relevance';
            $args['s'] = sanitize_text_field($_POST['searchTerm']);
        }
    }
    $posts = new \WP_Query( $args );
    if ($posts->have_posts() ) :
        while ( $posts->have_posts() ) :
            $posts->the_post();
            if (! empty($_POST['card']) ) {
                $card = sanitize_text_field($_POST['card']);
                get_template_part('template_parts/cards/' . $card );
            }
        endwhile;
        wp_reset_postdata();  wp_reset_query();
    endif;
    echo '<div class="product-card product-card--count" data-count="'. $posts->found_posts .'"></div>';
    die();
}
add_action( 'wp_ajax_nopriv_load_more_products', 'load_more_products_ajax_handler'  );
add_action( 'wp_ajax_load_more_products',  'load_more_products_ajax_handler'  );

/**
 * Construct a modal popup containing post content
 */
 function build_modal_ajax_handler() {
    $args = [];
     check_nonce($_POST['nonce']);


    // Check if a post ID exists
    $have_post_ID = 0 < absint( $_POST['postID'] ?: 0 );

    // Check if a post slug exists
    $have_post_slug = ! empty( $_POST['postSlug'] );

    // Grab the post type
    if (empty( $_POST['postType'] ) || ! is_string( $_POST['postType'] ) || 0 === strlen( $_POST['postType'] ) ) {
        return;
    }
    $args['post_type'] = sanitize_key( $_POST['postType'] );

     //Set the post ID (if one exists)
    if ( $have_post_ID ) {
        $args['p'] = sanitize_key( $_POST['postID'] );
    }

    // Set the post slug (if one exists)
    if (
        ! $have_post_ID
        && $have_post_slug
    ) {
        $post = get_page_by_path(
            sanitize_key( $_POST['postSlug'] ),
            OBJECT,
            $args['post_type']
        );

        if ( $post instanceof \WP_Post ) {
            $args['p'] = $post->ID;
        }
    }

    // Run the query
    $post = new \WP_Query( $args );
    if ($post->have_posts() ) {
        while ( $post->have_posts() ) {
            // Set post data
            $post->the_post();

            // Render content for each queried post
            get_template_part(
                'template_parts/modals/modal-base',
                null,
                [
                    'data' => [
                        'template'  => sanitize_key( $args['post_type'] ),
                        'post_type' => $args['post_type'],
                        'button' => sanitize_key( $_POST['button'] ) ?: false,
                        'buttons' => sanitize_key( $_POST['buttons'] ) ?: false,
                    ],
                ]
            );
        }

        // Restore the original post data
        wp_reset_postdata();
    }
    die();
}
add_action( 'wp_ajax_nopriv_build_modal', 'build_modal_ajax_handler' );
add_action( 'wp_ajax_build_modal',  'build_modal_ajax_handler' );

function get_samples_ajax_handler() {
    check_nonce($_POST['nonce']);
    $sample_count = 0;
    if ( ! empty( $_POST['samples']) ){
        $args = [
            'post_status'    => 'publish',
            'order'          => 'DESC',
            'post_type'      => ['carpet', 'lvtflooring'],
            'posts_per_page' => 5,
            'post__in' =>  explode(",", $_POST['samples'])
        ];
        $post = new \WP_Query( $args );
        if ($post->have_posts() ) {
            while ( $post->have_posts() ) {
                $post->the_post();
                get_template_part( 'template_parts/cards/sample-card' );
                   $sample_count++;
            }
            wp_reset_postdata();
        }
    }
    while ($sample_count < 5 && $_POST['single'] !== 'true'){
        get_template_part( 'template_parts/cards/add-sample-card' );
        $sample_count++;
    }
    die();
}
add_action( 'wp_ajax_nopriv_get_samples', 'get_samples_ajax_handler' );
add_action( 'wp_ajax_get_samples',  'get_samples_ajax_handler' );


/**
 * @return bool
 */
function check_if_search_term_ajax_handler(): bool
{
    check_nonce($_POST['nonce']);
    if( ! empty($_POST['searchTerm']) ) {
         $searchTerm = sanitize_text_field( $_POST['searchTerm'] );
         $tag = get_term_by('slug', $searchTerm, 'post_tag');
         if(!empty($tag)){
            echo true;
         }
    }
    die();
}

add_action( 'wp_ajax_nopriv_check_if_search_term', 'check_if_search_term_ajax_handler' );
add_action( 'wp_ajax_check_if_search_term',  'check_if_search_term_ajax_handler' );




function check_nonce($nonce){
    // Fail if there's no nonce
    if (
        ! empty( $nonce )
        && ! wp_verify_nonce( sanitize_key( $nonce ), 'ajax_nonce' )
    ) {
        return;
    }
}
