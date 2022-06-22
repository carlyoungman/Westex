<?php
/**
 * Products block;
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base = 'products';
$options = get_sub_field('opitons') ?? [];
$product_type =  $args['data']['product_type'] ?? $options['product_type'] ?? '';
$number = 16;
if(!empty($optins)):
    $number = $options['number'];
endif;
$filtersCheck = $args['data']['filtersCheck'] ?? $options['filters'] ?? true;
$filters = [[$product_type . '-colour', 'colour'], [$product_type . '-collection', 'collection']];
if(true === $args['data']['search'] ?? false):
    $query = get_search_results();
else:
    $query = get_post_content($product_type, (int)$number);
endif;
?>
<section class="<?php echo esc_attr($base); ?>" id="<?php echo esc_attr($base); ?>">
    <div class="container-fluid container--max">
        <div class="row">
            <?php if(false !== $filtersCheck): ?>
                <div class="col-lg-4">
                    <div class="<?php echo esc_attr($base); ?>__filters">
                    <?php
                    foreach ( $filters as $filter ): ?>
                        <?php get_template_part(
                            'template_parts/product_filter_block', null,
                            [
                                'data' => [
                                    'filter' =>  $filter,
                                ],
                            ]
                        );  endforeach;
                    ?>
                    </div>
             </div>
            <?php endif; ?>
            <div class="col-lg">
                <div class="<?php echo esc_attr($base); ?>__grid">
                    <?php
                    if ( $query->have_posts()) :
                        while ( $query->have_posts() ):
                            $query->the_post();
                            get_template_part( 'template_parts/cards/product-card', null,
                                [
                                    'data' => [
                                        'product_type' =>  $product_type,
                                    ],
                                ]);
                        endwhile;
                        wp_reset_postdata();  wp_reset_query();
                    else: ?>
                            <h5 class="<?php echo esc_attr($base); ?>__no-products">Sorry your search did not find anything in our ranges, please reset your search criteria and try again.</h5>
                    <?php endif;
                    ?>
                    <h5 class="<?php echo esc_attr($base); ?>__no-products-found">Sorry your search did not find anything in our ranges, please reset your search criteria and try again.</h5>
                    <span class="insert <?php echo esc_attr( $base ); ?>--insert"></span>
                </div>
                <?php
                get_template_part(
                    'template_parts/load-more-button',
                    null,
                    [
                        'data' => [
                            'base'            => $base,
                            'query'           => $query,
                            'number'          => $number,
                            'text'            => 'carpets',
                        ],
                    ]
                );
                ?>
            </div>
        </div>
    </div>
    <?php $query->query_vars['search_orderby_title'] = []; ?>
    <script>
        const productsMyAjax = '<?php echo wp_json_encode( $query->query_vars); ?>';
        const productsMaxPageMyAjax = <?php echo esc_attr( $query->max_num_pages ); ?>;
        const archiveCheckMyAjax = '<?php echo esc_attr( get_queried_object()->taxonomy ); ?>'
    </script>
</section>
