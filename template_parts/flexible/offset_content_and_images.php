<?php
/**
 * Offset content and images
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base = 'offset-content-and-images';
$offset_content = $args['data']['offset_content'] ?? [];
$options = ['background' => 'grey'] ?? get_sub_field('options');
$content = $offset_content['content'] ?? get_sub_field('content') ?? [];
$images = $offset_content['images'] ?? get_sub_field('images') ?? [];
?>
<section class="<?php echo esc_attr($base);?> <?php if('grey' === $options['background']): echo 'has-background has-background-gray'; endif; ?>" id="<?php echo esc_attr($base);?>">
    <div class="container-fluid container--max">
        <div class="row  justify-content-between">
            <div class="col-lg-5">
                <?php if ($content['headline']): ?>
                    <?php echo '<h2 class="'. esc_attr( $base )  . '__title">' . $content['headline'] . '</h2>'; ?>
                <?php endif; ?>
                <?php if ($images[0]): ?>
                        <?php get_image_with_fallback($base, $images[0]['id'], 'offset_content_and_images', '0'); ?>
                <?php endif; ?>
            </div>
            <div class="col-lg-5">
                <?php if ($images[1]): ?>
                    <?php get_image_with_fallback($base, $images[1]['id'], 'offset_content_and_images', '0'); ?>
                <?php endif; ?>
                <div class="<?php echo esc_attr($base); ?>__content-wrap">
                    <?php if ($content['supporting_content']) { ?>
                        <h5 class="<?php echo esc_attr($base); ?>__content"><?php echo $content['supporting_content'] ?></h5>
                    <?php } ?>
                    <?php if ($content['link']) {
                        $content['link']['classes'] = 'btn--arrow btn--thin';
                        echo yr_button($content['link']);
                    } ?>
                    <?php if ($content['secondary_link']) {
                        $content['secondary_link']['classes'] = 'btn--arrow btn--thin';
                        echo yr_button($content['secondary_link']);
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>
