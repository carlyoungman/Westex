<?php
/**
 * Template part for displaying add sample card
 */
if (! defined('ABSPATH') ) :
    exit();
endif;
$base = 'add-sample-card';
$link = get_field('samples', 'option')['samples_link'];
?>
<a class="<?php echo esc_attr($base); ?>" href="<?php echo esc_url($link['url']); ?>">
    <div class="<?php echo esc_attr($base); ?>__image-wrap">
        <svg class="<?php echo esc_attr( $base ); ?>__icon icon icon--m">
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus"></use>
        </svg>
    </div>
    <?php echo esc_html( __( 'Add another sample', 'westex' ) ); ?>
</a>
