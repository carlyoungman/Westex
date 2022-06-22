<?php
/**
 * Template part for displaying the samples menu
 */

if ( ! defined( 'ABSPATH' ) ) :
	exit();
endif;
$base   = 'sample-draw';
$steps = ['1. Samples', '2. Delivery', '3. Confirmation'];
?>
<section class="<?php echo esc_attr($base); ?>">
    <div class="<?php echo esc_attr($base); ?>__inner">
        <ul class="<?php echo esc_attr($base); ?>__progress">
           <?php
           foreach ($steps as $step): ?>
               <li class="<?php echo esc_attr($base); ?>__progress-step"><?php echo esc_html($step) ?></li>
               <li class="<?php echo esc_attr($base); ?>__line"></li>
           <?php
           endforeach;
           ?>
            <li class="<?php echo esc_attr($base); ?>__progress-close">
                <button type="button" class="<?php echo esc_attr( $base ); ?>__close-icon">
                    <svg class="<?php echo esc_attr( $base ); ?>__icon icon icon--m">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use>
                    </svg>
                </button>
            </li>
        </ul>
        <div class="<?php echo esc_attr($base); ?>__carousel">
            <div data-glide-el="track" class="<?php echo esc_attr($base); ?>__track">
                <ul class="<?php echo esc_attr($base); ?>__carousel-slides">
                    <li class="<?php echo esc_attr($base); ?>__carousel-slide">
                        <?php get_template_part( 'template_parts/sample-slides/sample-slides', 'samples', [
                            'data' => [
                                'base'  => $base,
                                ],
                            ]
                        ); ?>
                    </li>
                    <li class="<?php echo esc_attr($base); ?>__carousel-slide">
                        <?php get_template_part( 'template_parts/sample-slides/sample-slides', 'delivery', [
                                'data' => [
                                    'base'  => $base,
                                ],
                            ]
                        ); ?>
                    </li>
                    <li class="<?php echo esc_attr($base); ?>__carousel-slide">
                        <?php get_template_part( 'template_parts/sample-slides/sample-slides', 'confirmation', [
                                'data' => [
                                    'base'  => $base,
                                ],
                            ]
                        ); ?>
                    </li>
                    <li class="<?php echo esc_attr($base); ?>__carousel-slide">
                        <?php get_template_part( 'template_parts/sample-slides/sample-slides', 'order-confirmed', [
                                'data' => [
                                    'base'  => $base,
                                ],
                            ]
                        ); ?>
                    </li>
                </ul>
                <div class="<?php echo esc_attr($base); ?>__controls" data-glide-el="controls">
                    <button id="prev" data-glide-dir="<">Start</button>
                    <button id="next" data-glide-dir=">">End</button>
                </div>
            </div>
        </div>
    </div>
    <div class="<?php echo esc_attr( $base ); ?>__button-wrap">
        <button type="button" class="<?php echo esc_attr( $base ); ?>__close">
            <?php echo esc_html( __( 'Close', 'westex' ) ); ?>
        </button>
        <button type="button" class="<?php echo esc_attr( $base ); ?>__continue">
            <?php echo esc_html( __( 'Continue', 'westex' ) ); ?>
            <svg class="<?php echo esc_attr( $base ); ?>__continue-icon icon icon--m ">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-full-arrow-down"></use>
            </svg>
        </button>
        <button type="button" class="<?php echo esc_attr( $base ); ?>__submit">
            <?php echo esc_html( __( 'Submit order', 'westex' ) ); ?>
            <svg class="<?php echo esc_attr( $base ); ?>__submit-icon icon icon--m ">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-send"></use>
            </svg>
        </button>
    </div>
</section>
