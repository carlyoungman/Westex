<?php
/**
 * Content with form
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base = 'content-with-form';
$form     = get_sub_field('options')['form_select'];
$content = get_sub_field('content')
?>
<section class="<?php echo esc_attr( $base ) ?>" id="<?php echo esc_attr( $base ) ?>">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <article class="<?php echo esc_attr( $base ) ?>__content-wrap">
                    <?php if($content['headline']):
                         echo '<h3 class="'. $base .'__headline">' . $content['headline']. '</h3>';
                     endif ?>
                    <?php if($content['supporting_content']):
                        echo '<p class="'. $base .'__supporting_content">' . $content['supporting_content']. '</p>';
                    endif ?>
                    <?php if(true === $content['display_address']):
                            display_contact_info();
                    endif; ?>
                </article>
            </div>
            <div class="col-md-6 offset-xl-2 col-xl-6">
                <?php
                if(!empty($form)):
                    echo do_shortcode('[contact-form-7 id="' . $form . '"]');
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
