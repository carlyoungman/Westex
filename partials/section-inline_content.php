<?php
// Inline Content Section
$class = (isset($args['class'])) ? $args['class'] : '';
$title = (isset($args['title'])) ? $args['title'] : get_the_title();
$text = (isset($args['text'])) ? $args['text'] : false;
$image = (isset($args['image'])) ? $args['image'] : false;
$link = (isset($args['link'])) ? $args['link'] : false;
$order = (isset($args['order']) && $args['order'] == 'text') ? 'inline--reverse' : '';
$align = (isset($args['align']) && $args['align'] == 'center') ? 'align-items-center' : '';
?>
<section class="inline inline--content <?= $class ?>" data-anim>
    <div class="container-fluid container--max">
        <div class="row <?=$order?> <?=$align?>">
            <div class="col-md-6 mx-auto mx-md-0 inline__content-image">
                <?=yr_image($image['id'], '25vw') ?>
            </div>
            <div class="col-md-6 mx-auto mx-md-0 inline__content-text">
                <div class="content__wrap">
                    <?php if($title) { ?>
                        <?php echo '<h3 class="inline__headline">' . $title . '</h3>'; ?>
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
