<?php
/**
 * Template part for displaying the samples order confirmation
 */
if ( ! defined( 'ABSPATH' ) ) :
    exit();
endif;
$base   = $args['data']['base'] ?: 'sample-draw';
$samples = get_field('samples', 'options');
$headline =  $samples['comfirmation_headline'];
$content =  $samples['comfirmation_supporting_content'];
?>
<?php if(!empty($headline)): ?>
<h4 class="<?php echo esc_attr($base); ?>__headline">
    <?php echo esc_html( __( $headline, 'westex' ) ); ?>
</h4>
<?php endif; ?>
<?php if(!empty($content)):
    echo wp_kses_post($content);
 endif; ?>
