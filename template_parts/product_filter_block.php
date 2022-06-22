<?php
/**
 * Template part for displaying a product filter block
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit();
endif;
$base       = 'product-filters-block';
$filter     = $args['data']['filter'] ?: '';
$title      = $filter[1] ?: '';
$fallback   = get_field('media', 'options')['sample'] ?: '';
?>
<div class="<?php echo esc_attr($base); ?>">
    <div class="<?php echo esc_attr($base); ?>__filter">
        <h6 class="<?php echo esc_attr($base); ?>__filter-header">Filter by <?php echo esc_html($title); ?>
            <svg class="<?php echo esc_attr($base); ?>__icon icon icon--s"><use xlink:href="#icon-down"></use></svg></h6>
        <ul class="<?php echo esc_attr( $base ); ?>__filter-list" data-taxonomy="<?php echo esc_attr($filter[0]);?>" id="<?php echo esc_attr($filter[0]);?>">
            <li class="<?php echo esc_attr( $base ); ?>__list-item--active <?php echo esc_attr( $base ); ?>__list-item--fake"></li>
            <?php
            foreach ( get_filters($filter[0]) as $filter ):
                if ( isset( $filter->term_id ) && 1 !== $filter->term_id ):
                    $name  = explode( ',', $filter->name );
                    $thumbnail = get_field('options', 'term_' . $filter->term_id )['colour_swatch']['id'] ?? '';
                ?>
                    <li class="<?php echo esc_attr( $base ); ?>__list-item <?php echo esc_attr( $base ); ?>__list-item--<?php echo esc_attr( $filter->slug ); ?>" data-id="<?php echo esc_attr( $filter->slug  ); ?>">
                        <?php get_image_with_fallback($base, $thumbnail, 'filter', $fallback); ?>
                        <span><?php echo esc_html( $name[0] ); ?></span>
                        <svg class="<?php echo esc_attr($base); ?>__close-icon icon icon--s"><use xlink:href="#icon-close"></use></svg>
                    </li>
                    <?php unset( $filter );
                    endif;
                    endforeach;
                    ?>
        </ul>
    </div>
</div>
