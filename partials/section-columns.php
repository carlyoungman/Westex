<?php
// Columns Section
$title = (isset($args['title'])) ? $args['title'] : '';
$image = (isset($args['image'])) ? $args['image'] : false;
$content = (isset($args['content'])) ? $args['content'] : false;
$layoutClass = (isset($args['layout']) && $args['layout'] == 'three') ? 'col-md-4' : 'col-md-6';
$class = (isset($args['class'])) ? $args['class'] : '';
$class .= (isset($args['layout']) && $args['layout'] == 'three') ? ' columns--three' : ' columns--two' ;
?>

<section class="columns <?= $class ?>" data-anim>
    <div class="container-fluid container--max">
        <div class="row flex-wrap">
            <?php if ($title) { ?>
                <div class="mx-auto col-md-12 columns__title">
                    <?= $title ?>
                </div>
            <?php } ?>
            <?php if ($image) { ?>
                <div class="mx-auto col-md-12 columns__image">
                    <?= yr_image($image['id'], '50vw') ?>
                </div>
            <?php } ?>
            <?php if ($content) {
                foreach ($content as $col) { ?>
                    <div class="mx-auto <?=$layoutClass?> columns__col">
                        <div class="content__wrap">
                            <?php if (isset($col['title'])) { ?>
                                <?= $col['title'] ?>
                            <?php } ?>
                            <?php if (isset($col['text'])) { ?>
                                <p><?= $col['text'] ?></p>
                            <?php } ?>
                            <?php if (is_array($col['link'])) {
                                $col['link']['classes'] = 'btn--arrow';
                                echo yr_button($col['link']);
                            } ?>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</section>
