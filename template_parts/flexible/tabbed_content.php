<?php
/**
 * Checklist block;
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base       = 'tabbed_content';
$options    = get_sub_field('options') ?? [];
$tabs       =  $args['data']['tabs'] ?? get_sub_field('tabs') ?? '';
$intro      =  $args['data']['intro'] ?? '';
?>
<?php if(!empty($tabs)): ?>
<section class="<?php echo esc_attr($base); ?>" id="<?php echo esc_attr($base); ?>">
    <div class="container-fluid container--max">
        <?php if(!empty($intro)): ?>
        <div class="row">
            <div class="offset-lg-1 col-lg">
                <h5 class="<?php echo esc_attr($base); ?>__intro">The Ultima Twist collection is packed with features</h5>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="offset-lg-1 col-lg-5">
                <?php
                    if( $tabs): $count = 0;
                        echo '<ul class="'. esc_attr($base) .'__headings">';
                        foreach( $tabs as $tab ):
                            $headings = $tab['tab_headline'];

                            if(!empty($headings)):
                                echo '<li class="' . esc_attr($base) .'__heading ';
                                    if(0 === $count): echo esc_attr($base) . '__heading--active'; endif;
                                echo '">';
                                    echo '<h4>' . esc_html($headings) . '</h4>';
                                echo '</li>';
                            endif;
                            $count ++;
                        endforeach;
                        echo '</ul>';
                    endif;
                ?>
            </div>
            <div class="col-lg-5">
                <?php
                if( $tabs): $count = 0;
                    echo '<ul class="'. esc_attr($base) .'__tab-content">';
                    foreach( $tabs as $tab ):
                        $content = $tab['content'];
                        $icon = $tab['content']['icon'] ?? $tab['icon'];
                        if(!empty( $content)):
                            echo '<li class="' . esc_attr($base) .'__content-wrap ';
                       if(0 === $count): echo esc_attr($base) . '__content-wrap--active'; endif;
                            echo '">';
                                get_image_with_fallback( $base, $content['image']['id'], 'post-thumb', 0 );
                                if($content['content']):
                                   echo '<p class="'. esc_attr($base)  .'__content">' . esc_html($content['content']) . '</p>';
                                endif;
                                if( !empty(svg('icon-collections-tabs')) ): ?>
                                    <div class="<?php echo esc_attr($base); ?>__icon-wrap">
                                        <?php if(!empty($icon['ID'])):
                                            get_image_with_fallback( $base, $icon['ID'], 'thumbnail', 0 );
                                        else:
                                            echo svg('icon-collections-tabs');
                                        endif;
                                        ?>
                                    </div>
                                <?php  endif;
                            echo '</li>';
                        endif;
                        $count++;
                    endforeach;
                    echo '</ul>';
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<?php endif ?>
