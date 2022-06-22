<?php
/**
 * Content block
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base = 'content-block';
$content = get_sub_field('content_block') ?: '';
?>
<?php if(!empty($content)): ?>
<section class="<?php echo esc_attr($base); ?>" id="<?php echo esc_attr($base); ?>">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="col">
               <article class="<?php echo esc_attr($base); ?>__content">
                    <?php echo wp_kses_post($content ); ?>
               </article>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
