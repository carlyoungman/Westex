<?php
/**
 * Section break
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base   = 'section-break';
?>
<section class="<?php echo esc_attr($base ); ?>">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="col">
                <span class="<?php echo esc_attr($base ); ?>__line"></span>
            </div>
        </div>
    </div>
</section>
