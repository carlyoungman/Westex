<?php
/**
 * Template part for displaying a load more button

 */

if ( ! defined( 'ABSPATH' ) ) :
	exit();
endif;
$base            = 'display-number';
$query           = $args['data']['query'] ?: null;
$paged           = $args['data']['paged'] ?: 1;
 ?>
<div class="<?php echo esc_attr( $base ); ?>">
    <?php
        echo '<h6 class="' . esc_attr( $base ) .'__results-count">Showing <span class="showing">' . $query->post_count * $paged . '</span> of <span class="total">' . $query->found_posts .'</span></h6>';
    ?>
</div>

