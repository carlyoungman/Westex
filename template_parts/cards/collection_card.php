<?php
/**
 * Template part for displaying a collect card
 */

if (! defined('ABSPATH') ) :
    exit();
endif;
$base           = 'collection-card';
$collection     = $args['data']['collection'] ?: '';
$image          = get_field('images', 'term_' . $collection)['thumbnail']['id'] ?: '';
$fallback       = get_field('media', 'options')['collection'] ?: '';
$term           = get_term($collection);
$link           = get_term_link($collection );
?>
<?php if(!empty($term)): ?>
<a class="<?php echo esc_attr($base); ?>" href="<?php echo $link ?>">
    <div class="<?php echo esc_attr($base); ?>__image-wrap">
         <?php  get_image_with_fallback($base, $image, 'collection_thumnail', $fallback ); ?>
    </div>
    <?php if(!empty($term->name) || !empty($term->description)): ?>
        <div class="<?php echo esc_attr($base); ?>__content">
            <?php if(!empty($term->name)): ?>
            <h5 class="<?php echo esc_attr($base); ?>__title"><?php echo $term->name ?></h5>
            <?php endif ?>
            <?php if(!empty($term->description)): ?>
            <p class="<?php echo esc_attr($base); ?>__description"><?php echo $term->description ?></p>
            <?php endif ?>
        </div>
    <?php endif ?>
</a>
<?php endif ?>
