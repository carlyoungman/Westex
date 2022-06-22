<?php
/**
 * Template part for displaying a load more button

 */

if ( ! defined( 'ABSPATH' ) ) :
	exit();
endif;
$base            = 'load-more-button';
$query           = $args['data']['query'] ?: null;
$number          = $args['data']['number'] ?: -1;
 ?>
<div class="<?php echo esc_attr( $base ); ?>">
        <div class="<?php echo esc_attr( $base ) . '__button-wrap';  if ( $query->max_num_pages <= 1 && $query->found_posts < $number): echo ' hide'; endif; ?>">
            <div  class="<?php echo esc_attr( $base ) . '__button'; ?>">
            <span class="<?php echo esc_attr( $base ) . '__text'; ?>">
	            <?php echo esc_html__( 'Load more', 'westex' ); ?>
	        </span>
                <svg class="<?php echo esc_attr($base); ?>__icon icon icon--m"><use xlink:href="#icon-full-arrow-down"></use></svg>
            </div>
            <?php get_template_part( 'template_parts/loading-animation', null,   [
                'data' => [
                    'base' =>  $base,
                    'size' => 'icon--l'
                ],
            ]);
            ?>
        </div>
</div>
