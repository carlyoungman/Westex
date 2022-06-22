<?php
// Checklist Section
$class = (isset($args['class'])) ? $args['class'] : '';
$title = (isset($args['title'])) ? $args['title'] : get_the_title();
$text = (isset($args['text'])) ? $args['text'] : false;
$items = (isset($args['items'])) ? $args['items'] : false;
?>

<section class="checklist <?= $class ?>" data-anim>
    <div class="container-fluid container--max">
        <div class="row">
            <div class="mx-auto col-md-12 checklist__title">
                <?php if ($title) { ?>
                    <?= $title ?>
                <?php } ?>
            </div>
            <div class="mx-auto col-md-6 checklist__left">
                <div class="content__wrap">
                    <?php if ($text) { ?>
                        <p><?= $text ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="mx-auto col-md-6 checklist__right">
                <?php if ($items) { ?>
                    <ul>
                        <?php foreach ($items as $item) { ?>
                            <li><?= $item['item'] ?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
