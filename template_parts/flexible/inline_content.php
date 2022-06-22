<?php
/**
 * Inline content block;
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
// Inline Content Section
$content = get_sub_field('content') ?: null;
$headline = $content['headline'] ?: '';
$text = $content['content'] ?: '';
$image = get_sub_field('content_image') ?: null;
$link = $content['link'] ?: null;
$options = get_sub_field('options') ?: null;
$order = (isset($options['content_order']) && $options['content_order'] === 'text') ? 'inline--reverse' : '';
$align = (isset($options['content_vertical_align']) && $options['content_vertical_align'] === 'Center') ? 'align-items-center' : '';
?>
<section class="inline inline--content" id="inline--content">
    <div class="container-fluid container--max">
        <div class="row <?=$order?> <?=$align?>">
            <div class="mx-auto mx-md-0 col-md-6 inline__content-image">
                <?php get_image_with_fallback('hero_background-image', $image['id'], 'inline', '0'); ?>
            </div>
            <div class="mx-auto mx-md-0 col-md-6 inline__content-text">
                <div class="content__wrap">
                    <?php if($headline) { ?>
                        <?php echo '<h3 class="inline__headline">' . $headline . '</h3>'; ?>
                    <?php } ?>
                    <?php if($text) { ?>
                        <p class="inline__content"><?=$text?></p>
                    <?php } ?>
                    <?php if($link) {
                        $link['classes'] = 'btn--arrow btn--thin';
                        echo yr_button($link);
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>
