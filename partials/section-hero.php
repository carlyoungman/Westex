<?php
// Hero Section
$type = (isset($args['type'])) ? $args['type'] : 'image';
$title = (isset($args['title']) && $args['title'] !== '') ? $args['title'] : get_the_title($post);
$text = (isset($args['text'])) ? $args['text'] : false;
$links = (isset($args['links'])) ? $args['links'] : false;
$media = (isset($args['media'])) ? $args['media'] : false;
$titleClass = ($text || !empty($links)) ?  '' : 'mb-0'; // Removes h1 margin if no sibling element exists
?>

<section class="hero" data-anim>
    <?php
    // If hero type is image or text
    if ($type !== 'slideshow') : ?>
        <div class="container-fluid hero__bg px-0">
            <div class="row no-gutters">
                <div class="col-12">
                    <?php if($media) {
                        echo yr_image($media['id']);
                    } ?>
                </div>
            </div>
        </div>
    <?php elseif ($type == 'slideshow') : ?>

        <div class="container-fluid px-0 hero__slideshow">
            <div class="row <?php echo ($type == "slideshow") ? 'slideshow' : '' ?> no-gutters">
                <?php
                $count = 1;
                if($media) :
                    foreach ($media as $slide): ?>
                    <div class="col-12 hero__slideshow-item px-0">
                        <?php get_image_with_fallback('hero_background-image', $slide['image']['id'], 'hero', '0'); ?>
                        <div class="hero__slideshow-content container-fluid container--max d-flex align-items-end">
                            <div class="content__wrap" data-index="<?php echo sprintf('%02d', $count);?>">
                                <?php if($slide['title']) : ?>
                                    <h1 class="hero__headline"><?php echo $slide['title'] ?></h1>
                                <?php endif; ?>

                                <?php if (!empty($slide['text'])) : ?>
                                    <p class="hero__caption"><?php echo esc_html($slide['text']) ?></p>
                                <?php endif; ?>
                                <?php if ($slide['links']) :
                                    get_hero_links($slide['links']);
                                endif; ?>
                            </div>
                        </div>
                    </div>
                        <?php $count++;
                    endforeach;
                endif;?>
            </div>
        </div>

    <?php endif; ?>

    <?php
    // If hero type is image or text
    if ($type !== 'slideshow') { ?>
        <div class="container-fluid container--max hero__content d-flex">
            <div class="row mb-0 mt-auto">
                <div class="col-12 content__wrap">
                    <h1 class="<?php echo $titleClass ?>"><?php echo $title ?></h1>
                    <?php if ($text) { ?>
                        <p><?php echo $text ?></p>
                    <?php } ?>
                    <?php if ($links) {
                        foreach ($links as $link) {
                            $link['link']['classes'] = 'btn--arrow-bold btn--light hero__link';
                            echo yr_button($link['link']);
                        }
                    } ?>
                </div>
            </div>
        </div>
    <?php } ?>

</section>
