<?php
/**
 * Checklist block;
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$headline   = get_sub_field('headline') ?: '';
$content    = get_sub_field('content') ?: '';
$checklist  = get_sub_field('checklist') ?: [];
$background = get_sub_field('options')['background'];
?>
<section class="checklist <?php if('gray' === $background): echo 'has-background background-gray'; endif; ?>" id="checklist">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="mx-auto col-md-12 checklist__title">
                <?php if (!empty($headline)): ?>
                    <h4 class="checklist__headline"><?php echo wp_kses_post($headline); ?></h4>
                <?php endif; ?>
            </div>
            <div class="mx-auto col-md-6 checklist__left">
                <div class="content__wrap">
                    <?php if (!empty($content) ): ?>
                        <?php echo wp_kses_post($content); ?>
                    <?php endif ?>
                </div>
            </div>
            <div class="mx-auto col-md-6 checklist__right">
                <?php if (!empty($checklist)): ?>
                    <ul>
                        <?php foreach ($checklist as $item): ?>
                            <li><?php echo esc_html($item['item']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
