<?php
/**
 * Inline searchbar
 **/
if (! defined('ABSPATH') ) :
    exit();
endif;
$base = 'inline-searchbar';
$placeholder = $args['data']['placeholder'] ?: get_sub_field('placeholder_text') ?: 'Search';
$remove_padding = $args['data']['remove_padding'] ?: get_sub_field('options')['remove_padding'] ?: false;
$headline = $args['data']['headline'] ?? '';
$supports = $args['data']['supports'] ?? '';
?>
<section class="<?php echo esc_attr( $base ) ; if(true === $remove_padding ):  echo  ' ' . esc_attr( $base ) . '--remove-padding'; endif;?>" id="<?php echo esc_attr( $base ) ?>">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="col">
                <?php if(!empty($headline)): ?>
                    <h3 class="<?php echo esc_attr( $base )?>__headline">
                        <?php echo esc_html( $headline); ?>
                    </h3>
                <?php endif; ?>
                <?php if(!empty($supports )): ?>
                    <p class="<?php echo esc_attr( $base )?>__support">
                        <?php echo esc_html( $supports ); ?>
                    </p>
                <?php endif; ?>
                <p class="<?php echo esc_attr( $base )?>__signpost">.</p>
                <form class="<?php echo esc_attr($base); ?>__form" action="<?php echo esc_url(home_url('/')); ?>"
                      method='GET'>
                    <div class="<?php echo esc_attr($base); ?>__input-wrap">
                        <label for="s">
                            <input class="<?php echo esc_attr($base); ?>__input" name="s" type="search" placeholder="<?php echo esc_attr($placeholder); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
                        </label>
                        <svg class="<?php echo esc_attr($base); ?>__icon icon icon--m"><use xlink:href="#icon-search"></use></svg>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
