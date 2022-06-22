<?php
/**
 * Template part for displaying a colour swatch card
 */

if (! defined('ABSPATH') ) :
    exit();
endif;
$base       = 'colour-swatch-card';
$term       = $args['data']['term'] ?: null;
$image      = get_field('options', $term)['colour_swatch']['id'] ?: 0;
$fallback   = get_field('media', 'options')['sample'] ?: '';
?>
<a class="<?php echo esc_attr($base); ?>" href="<?php echo esc_url(get_term_link($term))  ?>">
    <?php get_image_with_fallback($base, $image, 'thumbnail', $fallback); ?>
    <p class="<?php echo esc_attr($base); ?>__title"><?php echo esc_html($term->name); ?></p>
</a>
