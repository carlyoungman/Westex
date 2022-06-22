<?php
/**
 * Collections block;
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base = 'collections';
$collects = get_sub_field('carpet_collections') ?: null;
$product_type = get_sub_field('options')['product_type'] ?: 'carpets';
$headline = get_sub_field('section_headline') ?: '';
$id = get_sub_field('options')['section_id'] ?: '';
$background = get_sub_field('options')['background'] ?: null;
if($product_type === 'lvtflooring') {
    $collects = get_sub_field('lvt_flooring_collections') ?: null;
}
?>
<section class="<?php echo esc_attr($base); ?>" id="<?php echo esc_attr($base); ?>--<?php echo esc_attr($product_type); ?>">
    <?php if(true === $background): ?>
        <span class="<?php echo esc_attr($base); ?>__background"></span>
    <?php endif; ?>
    <div class="container-fluid container--max">
        <?php if(!empty($headline)): ?>
        <div class="row">
            <div class="col">
                <h5 class="<?php echo esc_attr($base); ?>__headline"><?php echo esc_html($headline); ?></h5>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col">
                <div class="<?php echo esc_attr($base); ?>__grid">
                    <?php
                    if ($collects):
                        foreach ($collects as $collect):
                            get_template_part(
                                'template_parts/cards/collection_card', null,
                                [
                                    'data' => [
                                        'collection'    => $collect
                                    ],
                                ]
                            );
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
