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
    <?php echo esc_html( __( 'Your samples', 'westex' ) ); ?>
</h4>
<p class="<?php echo esc_attr($base); ?>__intro">
    <?php echo esc_html( __( 'Did you know you can order up to 5 FREE carpet samples? Simply add them below or click the continue button...', 'westex' ) ); ?>
</p>
<div class="<?php echo esc_attr($base); ?>__display <?php echo esc_attr($base); ?>__display--main">
    <?php get_template_part( 'template_parts/cards/add-sample-card' ); ?>
</div>
