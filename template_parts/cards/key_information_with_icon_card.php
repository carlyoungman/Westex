<?php
/**
 * Template part for displaying key information with icon card
 */

if (! defined('ABSPATH') ) :
    exit();
endif;
$base       = 'key-information-with-icon-card';
$icon       = $args['data']['icon'] ?: null;
$title      = $args['data']['title'] ?: '';
$content    = $args['data']['content'] ?: '';
?>
<div class="<?php echo esc_attr($base); ?>">
    <?php get_image_with_fallback($base, $icon['ID'], 'thumbnail', '0'); ?>
    <?php if(!empty($title)) :
        echo '<h5 class="'. esc_attr($base) . '__title">'. esc_html($title) .'</h5>';
    endif; ?>
    <?php if(!empty($content)) :
        echo '<p class="'. esc_attr($base) . '__content">'. esc_html($content)  .'</p>';
    endif; ?>
</div>
