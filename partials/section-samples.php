<?php
// Samples Section
$term = (isset($args['term'])) ? $args['term'] : false;
$count = (isset($args['term'])) ?  (($args['term']->count == 1) ? $term->count . ' colour' : $term->count . ' colours') : false;
$title = (isset($args['term'])) ? $term->name . ' is available in ' . $count : 'Search all samples';
$class = (isset($args['class'])) ? $args['class'] : '';
$colours = get_terms(array('taxonomy' => 'colour', 'hide_empty' => false));
?>

<section class="samples <?= $class ?>" data-anim>
    <div class="container-fluid container--max">
        <div class="row">
            <div class="col-12 text-center samples__intro">
                <h2><?=$title?></h2>
                <p>You can select up to 3 colours to receive free samples.</p>
                <div class="samples__search">
                    <input name="sample-filter" type="text" class="samples__search-field" placeholder="Search for a swatch"/>
                    <span class="samples__search-icon"></span>
                </div>
            </div>
            <div class="col-12 col-md-5 col-lg-4 samples__filters">
                <div class="samples__filters-wrap">
                    <div class="samples__filters-name">Filter by colour</div>
                    <ul>
                        <?php foreach($colours as $colour) {
                            $swatch = (get_field('swatch', 'colour' . '_' . $colour->term_id)) ?  get_field('swatch', 'colour' . '_' . $colour->term_id)['sizes']['thumbnail'] : '';
                            ?>
                            <li style="background-image:url(<?=$swatch?>)" data-filter="<?=$colour->slug?>"><?=$colour->name?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-5 col-lg-8 samples__results row mx-0 d-block">
                <?php if(have_posts()) {
                    while(have_posts()) {
                        the_post();
                        $thumbID = get_post_thumbnail_id();
                        $colours = get_the_terms($post, 'colour');
                        $filterClasses = '';
                        if($colours) {
                            foreach($colours as $colour) {
                                $filterClasses .= 'filter--' . $colour->slug;
                            }
                        }
                        ?>
                        <div class="col-6 col-lg-3 samples__result <?=$filterClasses?>">
                            <a href="<?=the_permalink()?>">
                                <div class="samples__result-wrap">
                                    <?=yr_image($thumbID, '10vw', false) ?>
                                    <p><?=the_title()?></p>
                                    <span><?=$term->name?></span>
                                </div>
                            </a>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</section>
