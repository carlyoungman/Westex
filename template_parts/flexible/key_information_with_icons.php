<?php
/**
 * key-information with icon block
 **/
if ( ! defined( 'ABSPATH' ) ) :
    exit();
endif;
$base = 'key-information-with-icons';
$key_info = $args['data']['key_info'] ?? get_sub_field('key_information') ?? [];
$background = $args['data']['background'] ?? 'gray';
$options = $key_info['options'] ?: get_sub_field('options') ?: '';
$content = $key_info['content'] ?: get_sub_field('content') ?: '';
?>
<section class="<?php echo esc_attr($base) ?> <?php if('gray' === $background): echo 'has-background has-background-gray'; endif; ?>" id="<?php echo esc_attr($base) ?>">
    <?php if(!empty($content)) : ?>
    <div class="container-fluid container--max container-fluid--content">
        <div class="row">
            <div class="col-lg-9">
                <article class="<?php echo esc_attr($base) ?>__content">
                    <?php if(is_archive()): $term = get_queried_object(); $post_type = get_taxonomy( $term->taxonomy )->object_type[0]; ?>
                    <h1 class="<?php echo esc_attr($base) ?>__archive-title"><?php single_cat_title(); echo ' ' . esc_html($post_type) . 's' ?> </h1>
                    <?php else: ?>
                        <h1 class="<?php echo esc_attr($base) ?>__archive-title"><?php the_title() ?></h1>
                    <?php endif; ?>
                        <?php if(!empty($content['subheading'])) :
                                echo '<h5 class="' . esc_attr($base) . '__subheadling">' . esc_html($content['subheading']) .'</h5>';
                        endif; ?>

                        <?php if(!empty($content['headline'])) :
                            echo '<h3 class="' . esc_attr($base) . '__headline">' . esc_html($content['headline']) .'</h3>';endif; ?>
                </article>
                </div>
            </div>
    </div>
    <?php
        if($key_info['key_information'] !== null){
            $key_info = $key_info['key_information'];
        }
        endif;
    if(!empty($key_info )) : ?>
        <div class="container-fluid container--max container-fluid--key-information">
            <div class="row">
         <?php
         foreach( $key_info as $key ):
                ?>
                <div class="col-sm-6 col-lg">
                    <?php get_template_part(
                        'template_parts/cards/key_information_with_icon_card', null,
                        [
                            'data' => [
                                'icon'              =>  $key['top_level']['icon'],
                                'title'             => $key['top_level']['title'],
                                'content'           => $key['top_level']['content'],
                                'read_more_check'   => $key['read_more_check'],
                                'read_more'         => $key['read_more'],
                            ],
                        ]
                    ) ?>
                </div>
                <?php
            endforeach;
            ?>
            </div>
        </div>
    <?php  endif; ?>
</section>

<?php if(!empty($key_info )) :  ?>
<section class="<?php echo esc_attr($base) ?>__read-more">
    <div class="container-fluid container--max container-fluid--read-more">
        <div class="row">
            <div class="col">
                <ul class="<?php echo esc_attr($base) ?>__read-more-list">
                    <?php foreach( $key_info as $key ): ?>
                        <?php if(!empty($key['read_more'] && true === $key['read_more_check'])): ?>
                                <li class="<?php echo esc_attr($base) ?>__read-more-item">
                                    <svg class="<?php echo esc_attr($base) ?>__read-more-item-close icon icon--s">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use>
                                    </svg>
                                    <?php if(!empty($key['read_more']['introduction'])): ?>
                                        <p class="<?php echo esc_attr($base) ?>__read-more-item-introduction"><?php echo esc_html($key['read_more']['introduction']); ?></p>
                                    <?php endif; ?>
                                    <?php if(!empty($key['read_more']['key_points'])): ?>
                                        <ul class="<?php echo esc_attr($base) ?>__read-more-item_dropdown">
                                            <?php
                                            foreach( $key['read_more']['key_points'] as $key_point): ?>
                                                <li class="<?php echo esc_attr($base) ?>__read-more-item_dropdown-item">
                                                    <?php
                                                    if(!empty($key_point['headline'])): ?>
                                                        <p class="<?php echo esc_attr($base) ?>__read-more-item-headline">
                                                            <?php echo esc_html($key_point['headline']) ?>
                                                            <svg class="<?php echo esc_attr($base) ?>__read-more-item-icon icon icon--s">
                                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-down"></use>
                                                            </svg>
                                                        </p>
                                                    <?php endif;
                                                    if(!empty($key_point['dropdown_content'])): ?>
                                                        <div class="<?php echo esc_attr($base) ?>__read-more-item-dropdown">
                                                            <?php echo wp_kses_post($key_point['dropdown_content']) ?>
                                                        </div>
                                                    <?php endif;
                                                    ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php  endif; ?>
