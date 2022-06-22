<?php
/**
 * Hero Section
 **/
if ( ! defined( 'ABSPATH' ) ) :
    exit();
endif;
$options    = get_sub_field('options');
$content    = get_sub_field('content');
$type       = $args['data']['type'] ?: $options['hero_type'] ?: [];
$title      = $args['data']['title'] ?: $content['headline'] ?: get_the_title($post);
$text       = $args['data']['text'] ?: $content['content'] ?: '';
$links      = $args['data']['links'] ?: $content['hero_links'] ?: null;
?>
<section class="hero <?php echo 'hero--' . esc_attr($type);?>" id="hero">
    <?php
    switch ( $type):
    case 'Image': $image = $args['data']['media'] ?: get_sub_field('image_background');
            $fallback = get_field('media', 'options')['hero_fallback_image'];?>
              <div class="container-fluid hero__bg px-0">
                <div class="row no-gutters">
                    <div class="col-12">
                     <?php get_image_with_fallback('hero_background-image', $image['id'], 'hero', $fallback); ?>
                    </div>
                </div>
            </div>
        <div class="container-fluid container--max hero__content d-flex hero__content--<?php echo esc_attr($type);?>">
            <div class="row mb-0 mt-auto">
                <div class="col-12 content__wrap">
                    <h1 class="hero__headline"><?php echo $title ?></h1>
                    <?php if ($text) : ?>
                        <p class="hero__caption"><?php echo $text ?></p>
                    <?php endif; ?>
                    <?php get_hero_links($links) ?>
                </div>
            </div>
        </div>
        <?php break;
    case 'Text':?>
        <div class="container-fluid container--max hero__content d-flex hero__content--<?php echo esc_attr($type);?>">
            <div class="row mb-0 mt-auto">
                <div class="col-12 content__wrap">
                    <h1 class="hero__headline"><?php echo $title ?></h1>
                    <?php if ($text) : ?>
                        <p class="hero__caption"><?php echo $text ?></p>
                    <?php endif; ?>
                    <?php get_hero_links($links) ?>
                </div>
            </div>
        </div>
        <?php  break;
    case 'Slideshow': ?>
    <div class="container-fluid px-0 hero__slideshow">
        <div class="row slideshow no-gutters">
            <?php
            $count = 1;
            $media = $args['data']['media'] ?: get_sub_field('slideshow');
            foreach ($media as $slide): ?>
                    <div class="col-12 hero__slideshow-item px-0">
                        <?php get_image_with_fallback('hero_background-image', $slide['id'], 'hero', '0'); ?>
                        <div class="hero__slideshow-content container-fluid container--max d-flex align-items-end">
                            <div class="content__wrap" data-index="<?php echo sprintf('%02d', $count);?>">
                                <h1 class="hero__headline"><?php echo $slide['title'] ?></h1>
                                <?php if (!empty($slide['caption'])) { ?>
                                    <p class="hero__caption"><?php echo esc_html($slide['caption']) ?></p>
                                <?php } ?>
                                <?php get_hero_links($links) ?>
                            </div>
                        </div>
                    </div>
                    <?php $count++;
            endforeach;
            ?>
        </div>
    </div>
        <?php  break;
    endswitch
    ?>
</section>
