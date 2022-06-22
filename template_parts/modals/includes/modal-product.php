<?php
/**
 * Template part for displaying the organisation modal
 *
 * Used within block-template-parts/modals/modal-base
 *
 * @package HARWELL\Core
 */

use HARWELL\Core\Module\Template;

defined('ABSPATH') ||  exit();

$base   = 'modal-sample';
$thumbnail = get_field('thumbnail') ?: 0;
$hover  = get_field('thumbnail_hover') ?: 0;
$collection = get_the_terms( get_the_ID(), $args['data']['collection'])[0];
$options = get_field('options',  $collection->taxonomy . '_' . $collection->term_id) ?: [];
$samples_available = $options['samples_available'] ?: false;
$visualiser = get_field('visualiser') ?: [];
$find_a_retailer = $options['find_a_retailer'] ?: false;
$find_a_retailer_link = get_field('more', 'options')['find_a_retailer'] ?: [];
$specifications = get_field('specifications', 'term_' . $collection->term_id) ?: [];
$features = get_field('features', 'term_' . $collection->term_id) ?: [];
$button   = $args['data']['button'] ?: false;
$buttons  = $args['data']['buttons'] ?: false;
?>
<article class="<?php echo esc_attr($base); ?>">
        <div>
            <div class="<?php echo esc_attr($base); ?>__image-wrap">
                <?php get_image_with_fallback($base, $thumbnail['id'], 'product', '0'); ?>
                <?php get_image_with_fallback($base, $hover['id'], 'product', '0'); ?>
            </div>
            <ul class="<?php echo esc_attr($base); ?>__options">
                <?php if( true === $samples_available): ?>
                    <?php if('true' === $button):?>
                        <li class="<?php echo esc_attr($base); ?>__option <?php echo esc_attr($base); ?>__option--disable">
                            <a class="<?php echo esc_attr($base); ?>__option-link" href="#" id="remove-sample" data-id="<?php the_id(); ?>">
                                <?php echo esc_html( __( 'Sample already added!', 'westex' ) ); ?>
                            </a>
                        </li>
                    <?php elseif ('true' === $buttons): ?>
                        <li class="<?php echo esc_attr($base); ?>__option <?php echo esc_attr($base); ?>__option--disable">
                            <a class="<?php echo esc_attr($base); ?>__option-link" href="#">
                                <?php echo esc_html( __( 'Max samples added!', 'westex' ) ); ?>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="<?php echo esc_attr($base); ?>__option">
                            <a class="<?php echo esc_attr($base); ?>__option-link" href="#" id="request-a-sample" data-id="<?php the_id(); ?>">
                                <?php echo esc_html( __( 'Request a sample', 'westex' ) ); ?>
                                <svg class="<?php echo esc_attr($base); ?>__option-arrow icon icon--s"><use xlink:href="#icon-full-arrow-down"></use></svg>
                            </a>
                            <span class="<?php echo esc_attr($base); ?>__option-link <?php echo esc_attr($base); ?>__option-link--added">
                                 <?php echo esc_html( __( 'Sample added!', 'westex' ) ); ?>
                            </span>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if( !empty($visualiser )): ?>
                    <li class="<?php echo esc_attr($base); ?>__option">
                        <a class="<?php echo esc_attr($base); ?>__option-link" href="<?php echo esc_url( $visualiser ); ?>" target="_blank">
                            <?php echo esc_html( __( 'Visualiser', 'westex' ) ); ?>
                            <svg class="<?php echo esc_attr($base); ?>__option-arrow icon icon--s"><use xlink:href="#icon-full-arrow-down"></use></svg>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if( true === $find_a_retailer && !empty($find_a_retailer_link)): ?>
                    <li class="<?php echo esc_attr($base); ?>__option">
                        <a class="<?php echo esc_attr($base); ?>__option-link" href="<?php echo get_permalink( $find_a_retailer_link->ID ) ?>" target="_blank">
                            <?php echo esc_html( __( 'Find a retailer', 'westex' ) ); ?>
                            <svg class="<?php echo esc_attr($base); ?>__option-arrow icon icon--s"><use xlink:href="#icon-full-arrow-down"></use></svg>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div>
            <div class="<?php echo esc_attr($base); ?>__content-wrap">
                <h3 class="<?php echo esc_attr($base); ?>__headline"><?php the_title(); ?></h3>
                <h4 class="<?php echo esc_attr($base); ?>__collection"><?php echo esc_html($collection->name); ?></h4>
            <?php if(!empty($specifications)): ?>
                <h6 class="<?php echo esc_attr($base); ?>__section-headline"><?php echo esc_html( __( 'Specification', 'westex' ) ); ?></h6>
                <ul class="<?php echo esc_attr($base); ?>__specifications">
                    <?php foreach ($specifications as $specification): ?>
                        <li class="<?php echo esc_attr($base); ?>__specification">
                            <span class="<?php echo esc_attr($base); ?>__specification-key"><?php echo esc_html($specification['heading']) ?>:</span>
                            <span class="<?php echo esc_attr($base); ?>__specification-value"><?php echo esc_html($specification['content']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
                <?php if(!empty($features)): ?>
                    <h6 class="<?php echo esc_attr($base); ?>__section-headline"><?php echo esc_html( __( 'Features', 'westex' ) ); ?></h6>
                    <ul class="<?php echo esc_attr($base); ?>__features">
                        <?php foreach ($features as $feature): ?>
                            <li class="<?php echo esc_attr($base); ?>__feature">
                                <svg class="<?php echo esc_attr( $base ); ?>__feature-icon icon icon--m">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-done"></use>
                                </svg>
                                <span class="<?php echo esc_attr($base); ?>__feature-key"><?php echo esc_html($feature['feature']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
</article>
