<?php
/**
 * Browse by colour. Works for both carpets and LVT Flooring
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base           = 'retailer-locations';
$base_card      = 'retailer-card';
$preview_text   = get_field('find_a_retailer', 'option')['content'];
?>
<script>
    const config = <?php echo build_location_object(); ?>
</script>
<script id="locator-result-items-tmpl" type="text/x-handlebars-template">
    {{#each locations}}
    <li class="<?php echo esc_attr($base_card); ?>" data-location-index="{{index}}">
        <div class="select-location <?php echo esc_attr($base_card); ?>__grid">
            <div class="<?php echo esc_attr($base_card); ?>__right">
                <div class="<?php echo esc_attr($base_card); ?>__header">
                    <h6 class="<?php echo esc_attr($base_card); ?>__name">{{{ title }}}</h6>
                    {{#if travelDistanceText}}
                     <div class="<?php echo esc_attr($base_card); ?>__distance">{{travelDistanceText}}</div>
                    {{/if}}
                </div>
                    {{#if products }}
                <ul class="<?php echo esc_attr($base_card); ?>__products">
                        {{{ products }}}
                </ul>
                    {{/if}}
                <address class="<?php echo esc_attr($base_card); ?>__address">{{address1}} {{address2}}</address>
                <ul class="<?php echo esc_attr($base_card); ?>__additional">
                    {{#if number }}
                    <li class="<?php echo esc_attr($base_card); ?>__additional-item">
                        <a class="<?php echo esc_attr($base_card); ?>__number" href="tel:{{number}}">{{number}}</a>
                    </li>
                    {{/if}}
                    {{#if directions_link }}
                    <li class="<?php echo esc_attr($base_card); ?>__additional-item">
                        <a class="<?php echo esc_attr($base_card); ?>__directions-link" target="_blank" href="{{directions_link}}">Get Directions</a>
                    </li>
                    {{/if}}
                </ul>
            </div>
        </div>
    </li>
    {{/each}}
</script>

<section class="<?php echo esc_attr($base); ?> has-background" id="map-container">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="col-lg-6">
                    <div class="<?php echo esc_attr($base); ?>__panel" id="locations-panel">
                        <div class="<?php echo esc_attr($base); ?>__inner"  id="locations-panel-list">
                            <span class="<?php echo esc_attr($base); ?>__blackground">
                                <h1 class="<?php echo esc_attr($base); ?>__headline">
                                    <?php echo esc_html__( 'Find your nearest Westex retailer'  , 'westex' ); ?>
                                </h1>
                                <div id="search-overlay-search"  class="<?php echo esc_attr($base); ?>__search-input">
                                    <input class="<?php echo esc_attr($base); ?>__input" id="location-search-input" placeholder="Enter your address or postcode" >
                                        <button class="<?php echo esc_attr($base); ?>__button" id="location-search-button">
                                            <svg class="<?php echo esc_attr($base); ?>__icon icon icon--m"><use xlink:href="#icon-search"></use></svg>
                                            <?php get_template_part( 'template_parts/loading-animation', null,   [
                                                'data' => [
                                                    'base' =>  $base,
                                                    'size' => 'icon--l'
                                                ],
                                            ]); ?>
                                        </button>
                                </div>
                            <h6 class="<?php echo esc_attr($base); ?>__section-name" id="location-results-section-name">
                                All locations
                            </h6>
                            </span>
                                 <ul class="<?php echo esc_attr($base); ?>__results" id="location-results-list"></ul>
                                <?php if(!empty($preview_text)): ?>
                                    <div class="<?php echo esc_attr($base); ?>__preview">
                                        <article>
                                            <?php echo wp_kses_post($preview_text); ?>
                                        </article>
                                    </div>
                                <?php endif; ?>
                        </div>
                    </div>
            </div>
            <div class="col-lg-6">
                <div class="<?php echo esc_attr($base); ?>__map" id="map"></div>
            </div>
        </div>
    </div>
</section>
