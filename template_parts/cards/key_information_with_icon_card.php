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
$read_more_check = $args['data']['read_more_check'] ?: false;
$read_more = $args['data']['read_more'] ?: [];
?>
<div class="<?php echo esc_attr($base); ?>">
    <?php get_image_with_fallback($base, $icon['ID'], 'thumbnail', '0'); ?>
    <?php if(!empty($title)) :
        echo '<h5 class="'. esc_attr($base) . '__title">'. esc_html($title) .'</h5>';
    endif; ?>
    <?php if(!empty($content)) :
        echo '<p class="'. esc_attr($base) . '__content">'. esc_html($content)  .'</p>';
    endif; ?>
    <?php if(!empty($read_more) && true === $read_more_check):
        echo '<div class="'. esc_attr($base) .'__read-more">';
            echo '<p class="'. esc_attr($base) .'__read-more__text">Read more</p>';
            echo '<svg class="'. esc_attr($base) .'__read-more__icon icon icon--s">';
                echo '<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-down"></use>';
            echo '</svg>';
        echo '</div>';
    endif; ?>
</div>
