<?php
/**
 * Template part for displaying the sample slide step two
 */
if ( ! defined( 'ABSPATH' ) ) :
    exit();
endif;
$base   = $args['data']['base'] ?: 'sample-draw';
$samples_form = get_field( 'samples', 'option' )['samples_form'];
?>
<h4 class="<?php echo esc_attr($base); ?>__headline">
    <?php echo esc_html(__( 'Your Details', 'westex' ) ); ?>
</h4>
<?php if ( ! empty( $samples_form->ID ) ) : ?>
    <div class="<?php echo esc_attr( $base ); ?>__form-wrap" data-url="<?php echo esc_url( get_site_url() . '/wp-json/contact-form-7/v1/contact-forms/' . $samples_form->ID . '/feedback' ) ?>">
        <?php echo do_shortcode( '[contact-form-7 id="' . $samples_form->ID . '"]' ); ?>
    </div>
<?php
endif;
?>
<span class="<?php echo esc_attr( $base ); ?>__back">
    <svg class="<?php echo esc_attr( $base ); ?>__back-icon icon icon--m ">
        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-full-arrow-down"></use>
    </svg>
    <?php echo esc_html( __( 'Back', 'westex' ) ); ?>
</span>
