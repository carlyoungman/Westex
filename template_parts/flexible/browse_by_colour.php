<?php
/**
 * Browse by colour. Works for both carpets and LVT Flooring
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base = 'browse-by-colour';
$product_type = get_sub_field('options')['product_type'] ?: '';
$id = get_sub_field('options')['section_id'] ?: '';
$terms = get_terms(
    [
        'taxonomy' => $product_type,
        'hide_empty' => true,
    ]
);
?>
<section class="<?php echo esc_attr($base); ?>" id="<?php echo esc_attr($base); ?>">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="col">
                <h5 class="<?php echo esc_attr($base); ?>__headline">Browse by colour</h5>
                <?php  if(!empty($terms)) : ?>
                    <div class="<?php echo esc_attr($base); ?>__grid">
                        <?php foreach ( $terms as $term ):
                            get_template_part(
                                'template_parts/cards/colour_swatch_card', null,
                                [
                                    'data' => [
                                        'term' =>  $term
                                    ],
                                ]
                            );
                        endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
