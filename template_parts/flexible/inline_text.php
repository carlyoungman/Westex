<?php
/**
 * Inline text block;
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$headline      =   get_sub_field('headline') ?: '';
$content       =   get_sub_field('content') ?: '';
$options     =   get_sub_field('options');
$options_array = [
    [ 'content_alignment', 'has-alignment', true ],
    [ 'background', 'has-background', true ],
];
?>
<section class="inline inline--text <?php apply_classes( $options_array, $options ); ?>" id="inline--text">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="mx-auto col-md-6 inline__text-left">
                <div class="content__wrap">
                    <?php if ($headline):
                        echo '<h3 class="inline__headline">' . esc_html($headline) . '</h3>';
                    endif ?>
                </div>
            </div>
            <div class="mx-auto col-md-6 inline__text-right">
                <div class="content__wrap">
                    <?php if ($content) :
                        echo wp_kses_post($content);
                     endif;  ?>
                </div>
            </div>
        </div>
    </div>
</section>
