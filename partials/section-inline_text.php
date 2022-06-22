<?php
// Inline Text Section
$class = (isset($args['class'])) ? $args['class'] : '';
$headline = get_field('headline') ?: '';
$text = (isset($args['text'])) ? $args['text'] : false;
?>

<section class="inline inline--text" data-anim>
    <div class="container-fluid container--max">
        <div class="row">
            <div class="mx-auto col-md-6 inline__text-left">
                <div class="content__wrap">
                    <?php if ($headline) {
                        echo '<h3 class="inline__headline">' . esc_html($headline) . '</h3>';
                    } ?>
                </div>
            </div>
            <div class="mx-auto col-md-6 inline__text-right">
                <div class="content__wrap">
                    <?php if ($text) { ?>
                        <p><?= $text ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
