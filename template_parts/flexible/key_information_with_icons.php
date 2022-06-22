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
                                'icon' =>  $key['icon'],
                                'title' => $key['title'],
                                'content' => $key['content'],
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
