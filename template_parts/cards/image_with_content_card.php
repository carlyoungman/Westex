<?php
/**
 * Template part for displaying image with content card.
 */

if (! defined('ABSPATH') ) :
    exit();
endif;
$base       = 'image-with-content-card';
$column     = $args['data']['column'] ?: '';
$image      = $column['image']['id'];
$headline   = $column['content']['headline'];
$content    = $column['content']['content'];
$link       = $column['content']['link'];
?>
<div class="<?php echo esc_attr($base); ?>">
    <?php get_image_with_fallback($base, $image, 'post-thumb', 0); ?>
    <div class="<?php echo esc_attr($base); ?>__content-wrap">
        <?php if(!empty( $headline )): ?>
            <h4 class="<?php echo esc_attr($base); ?>__headline">
                <?php echo esc_html($headline); ?>
            </h4>
        <?php endif; ?>
          <?php if(!empty( $content )): ?>
            <p class="<?php echo esc_attr($base); ?>__content">
                <?php echo esc_html($content); ?>
            </p>
        <?php endif; ?>
        <?php  echo yr_button($link);?>
    </div>
</div>
