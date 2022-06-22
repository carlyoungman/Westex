<?php
/**
 * Template part for displaying a product card
 */

if (! defined('ABSPATH') ) :
    exit();
endif;
$base = 'sample-card';
$thumbnail = get_field('thumbnail') ?: 0;
$hover  = get_field('thumbnail_hover') ?: 0;
$collection = get_the_terms( $post->ID, 'carpet-collection')[0];
if(null === $collection){
    $collection = get_the_terms( $post->ID, 'lvtflooring-collection')[0];
}
?>
<div class="<?php echo esc_attr($base); ?>" data-id="<?php the_id(); ?>" data-type="<?php echo get_post_type( get_the_ID()) ?>">
    <div class="<?php echo esc_attr($base); ?>__image-wrap">
        <?php get_image_with_fallback($base, $thumbnail['id'], 'sample', '0'); ?>
        <?php get_image_with_fallback($base, $hover['id'], 'sample', '0'); ?>
    </div>
    <div class="<?php echo esc_attr($base); ?>__content-wrap">
        <p class="<?php echo esc_attr($base); ?>__title"><?php the_title() ?></p>
        <p class="<?php echo esc_attr($base); ?>__collection"><?php echo esc_html($collection->name); ?></p>
    </div>
    <button type="button" class="<?php echo esc_attr( $base ); ?>__close">
        <svg class="<?php echo esc_attr( $base ); ?>__icon icon icon--s">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use>
        </svg>
        <?php echo esc_html( __( 'Remove', 'westex' ) ); ?>
    </button>
</div>
