<?php
/**
 * Template part for displaying the sample slide step one
 */
if ( ! defined( 'ABSPATH' ) ) :
    exit();
endif;
$base   = $args['data']['base'] ?: 'sample-draw';
?>
<h4 class="<?php echo esc_attr($base); ?>__headline">
    <?php echo esc_html( __( 'Confirmation', 'westex' ) ); ?>
</h4>
<div class="<?php echo esc_attr($base); ?>__loading-wrapper">
<!--    --><?php //get_template_part( 'template_parts/loading-animation'); ?>
    <div class="<?php echo esc_attr($base); ?>__confirmation-wrap">
        <span class="<?php echo esc_attr($base); ?>__label">
            <?php echo esc_html( __( 'Postal Address', 'westex' ) ); ?>
        </span>
        <address class="<?php echo esc_attr($base); ?>__address">
            Carl Youngman, 123 Broadoak Road, Manchester, M22 9PW
        </address>
        <span class="<?php echo esc_attr($base); ?>__label">
            <?php echo esc_html( __( 'Email Address', 'westex' ) ); ?>
        </span>
        <p class="<?php echo esc_attr($base); ?>__email">me@carlyoungman.com</p>
        <span class="<?php echo esc_attr($base); ?>__label">
            <?php echo esc_html( __( 'Your samples', 'westex' ) ); ?>
        </span>
        <div class="<?php echo esc_attr($base); ?>__display <?php echo esc_attr($base); ?>__display--confirmation">
            <?php get_template_part( 'template_parts/cards/add-sample-card' ); ?>
        </div>
    </div>
</div>
<span class="<?php echo esc_attr( $base ); ?>__back">
    <svg class="<?php echo esc_attr( $base ); ?>__back-icon icon icon--m ">
        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-full-arrow-down"></use>
    </svg>
    <?php echo esc_html( __( 'Back', 'westex' ) ); ?>
</span>
