<?php
global $prefix;
$hero = get_field($prefix . 'hero');
$intro = get_field($prefix . 'intro');
$featured = get_field($prefix . 'featured');
$full = get_field($prefix . 'full');
$inline = get_field($prefix . 'inline');
?>
<?php get_header(); ?>
<?php get_template_part(
    'partials/section', 'hero', array(
        'title' => ($hero['type'] !== 'slideshow') ? $hero['title'] : false,
        'text' => ($hero['type'] !== 'slideshow') ? $hero['text'] : false,
        'links' => ($hero['type'] !== 'slideshow') ? $hero['links'] : false,
        'type' => $hero['type'],
        'media' => ( $hero['type'] === 'image') ? $hero['image'] : (( $hero['type'] === 'slideshow') ? $hero['slideshow'] : false)
    )
) ?>
<section class="intro has-background has-background-gray" id="intro">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="col-12 col-md-6 intro__left">
                <?php if ($intro['title']) { ?>
                    <?php echo '<h2 class="intro__title">' . $intro['title'] . '</h2>'; ?>
                <?php } ?>
                <?php if ($intro['images'][0]) { ?>
                    <div class="intro__image-wrap">
                        <?php echo yr_image($intro['images'][0]['id'], '15vw') ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-12 col-md-6 intro__right flex-column-reverse d-flex flex-md-column">
                <?php if ($intro['images'][1]) { ?>
                    <div class="intro__image-wrap">
                        <?php echo yr_image($intro['images'][1]['id'], '35vw') ?>
                    </div>
                <?php } ?>
                <div class="intro__content-wrap">
                    <?php if ($intro['text']) { ?>
                        <p><?php echo $intro['text'] ?></p>
                    <?php } ?>
                    <?php if ($intro['link']) {
                        $intro['link']['classes'] = 'btn--arrow btn--thin';
                        echo yr_button($intro['link']);
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="featured" id="featured">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="col-12 featured__intro">
                <div class="content__wrap">
                    <?php if ($featured['title']) { ?>
                        <h3 class="featured__headline"><?php echo $featured['title'] ?></h3>
                    <?php } ?>
                    <?php if ($featured['text']) { ?>
                        <p><?php echo $featured['text'] ?></p>
                    <?php } ?>
                    <?php if ($featured['link']) {
                        $featured['link']['classes'] = 'btn--arrow btn--thin';
                        echo yr_button($featured['link']);
                    } ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="featured__carousel">
                    <div data-glide-el="track" class="featured__track">
                        <ul class="featured__carousel-slides">
                                <?php
                                if ($featured['items']):
                                    foreach ($featured['items'] as $collect): ?>
                                        <li class="featured__carousel-slide">
                                            <?php
                                        get_template_part(
                                            'template_parts/cards/collection_card', null,
                                            [
                                                'data' => [
                                                    'collection'    => $collect
                                                ],
                                            ]
                                        ); ?>
                                        </li>
                                    <?php endforeach;
                                endif;
                                ?>
                        </ul>
                        <div class="featured__controls" data-glide-el="controls">
                            <button id="prev" data-glide-dir="<"><</button>
                            <button id="next" data-glide-dir=">">></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="full" id="full">
    <?php if ($full['image']) { ?>
        <div class="container-fluid px-0 full__background">
            <?php echo yr_image($full['image']['id'], '50vw') ?>
        </div>
    <?php } ?>
    <div class="container-fluid container--max full__content">
        <div class="row">
            <div class="col-12">
                <div class="content__wrap">
                    <?php if ($full['title']) { ?>
                        <?php echo '<h3 class="full__headline">' . $full['title'] . '</h3>'; ?>
                    <?php } ?>
                    <?php if ($full['text']) { ?>
                        <p><?php echo $full['text'] ?></p>
                    <?php } ?>
                    <?php if ($full['link']) {
                        $full['link']['classes'] = 'btn--arrow btn--thin';
                        echo yr_button($full['link']);
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_template_part(
    'partials/section', 'inline_content', array(
        'title' => $inline['title'],
        'text' => $inline['text'],
        'link' => $inline['link'],
        'image' => $inline['image'],
        'order' => 'text',
        'align' => 'center',
    )
) ?>
<?php get_footer(); ?>
