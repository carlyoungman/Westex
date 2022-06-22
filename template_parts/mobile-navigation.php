<?php
/**
 * Template part for the mobile navigation
 *
 * @package westex
 */
if ( ! defined( 'ABSPATH' ) ) :
	exit();
endif;
$base = 'mobile-navigation'
?>
<section class="<?php echo esc_attr( $base ); ?> d-lg-none">
    <?php wp_nav_menu(array('theme_location' => 'header_menu')) ?>
</section>
