<?php
/**
 * Template part for displaying the back to top button
 *
 * @package gamezebo
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit();
endif;
$base = 'back-to-top';
?>
<nav class="<?php echo esc_attr( $base ); ?>">
	<svg class="<?php echo esc_attr( $base ); ?>__icon icon icon--s">
		<use xmlns:xlink='http://www.w3.org/1999/xlink' xlink:href='#icon-down'></use>
	</svg>
</nav>
