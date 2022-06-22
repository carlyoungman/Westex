<?php
/**
 * Columns block;
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;

$headline       = get_sub_field('headline') ?: '';
$image          = get_sub_field('hero_image') ?: [];
$columns        = get_sub_field('columns') ?: [];
$options        = get_sub_field('options') ?: [];
$class = (isset($options['layout']) && $options['layout'] === 'three') ? ' columns--three' : ' columns--two' ;
$layoutClass    = (isset($options['layout']) && $options['layout'] === 'three') ? 'col-md-4' : 'col-md-6';
?>
<section class="columns <?= $class ?>" id="columns">
    <div class="container-fluid container--max">
        <div class="row flex-wrap">
            <?php if (!empty($headline)): ?>
                <div class="mx-auto col-md-12 columns__title">
                    <h3 class="columns__headline">
                        <?php echo esc_html($headline); ?>
                    </h3>
                </div>
            <?php endif; ?>
            <?php if ($image): ?>
                <div class="mx-auto col-md-12">
                    <?php get_image_with_fallback('columns', $image['id'], 'hero', '0'); ?>
                </div>
            <?php endif ?>
            <?php if ($columns):
                foreach ($columns as $column) : ?>
                    <div class="mx-auto col-lg-4">
                        <div class="content__wrap">
                            <span>
                                 <?php if (!empty($column['title'])): ?>
                                    <?php echo wp_kses_post($column['title']); ?>
                                 <?php endif ?>
                                <?php if (isset($column['content'])): ?>
                                    <?php echo wp_kses_post($column['content']); ?>
                                <?php endif ?>
                            </span>
                            <?php if (is_array($column['link'])) {
                                $column['link']['classes'] = 'btn--arrow';
                                echo yr_button($column['link']);
                            } ?>
                        </div>
                    </div>
                <?php endforeach;
            endif ?>
        </div>
    </div>
</section>
