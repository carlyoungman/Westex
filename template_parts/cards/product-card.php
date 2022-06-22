<?php
/**
 * Template part for displaying a product card
 */

if (! defined('ABSPATH') ) :
    exit();
endif;
$base = 'product-card';
$thumbnail = get_field('thumbnail') ?: 0;
$hover  = get_field('thumbnail_hover') ?: 0;
$taxonomy = get_post_type( $post->ID );
$collections = get_the_term_list( $post->ID, $taxonomy . '-collection', '', ', ' );
?>
<div class="<?php echo esc_attr($base); ?>" data-id="<?php the_id(); ?>" data-type="<?php echo get_post_type( get_the_ID()) ?>" data-collections="<?php echo strip_tags($collections); ?>">
    <div class="<?php echo esc_attr($base); ?>__image-wrap">
        <?php get_image_with_fallback($base, $thumbnail['id'], 'product', '0'); ?>
        <?php get_image_with_fallback($base, $hover['id'], 'product', '0'); ?>
    </div>
    <p class="<?php echo esc_attr($base); ?>__title"><?php the_title() ?></p>
    <p class="<?php echo esc_attr($base); ?>__collection">
        <?php echo strip_tags($collections); ?>
    </p>
</div>
