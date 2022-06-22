<?php
/**
 * Checklist block;
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base       = 'image_with_content_grid';
$columns    = $args['data']['columns'] ?: get_sub_field('columns') ?: '';
?>
<section class="<?php echo esc_attr($base); ?>" id="<?php echo esc_attr($base); ?>">
    <div class="container-fluid container--max">
        <div class="col">
            <?php if( $columns ): ?>
                <div class="<?php echo esc_attr($base); ?>__grid">
                    <?php
                    foreach( $columns as $column ):
                        get_template_part(
                            'template_parts/cards/image_with_content_card', null,
                            [
                                'data' => [
                                    'column' =>  $column,
                                ],
                            ]
                        );
                    endforeach;
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
