<?php
/**
 * Template part for displaying a desktop header
 *
 * @package westex
 */
if ( ! defined( 'ABSPATH' ) ) :
	exit();
endif;
$colour_preset = get_field('colour_preset');
?>
<header id="main" class="header <?php if('black' === $colour_preset): echo 'header--black'; endif?>">
    <div class="container-fluid container--max">
        <div class="row d-flex align-items-center">
            <div class="col-4 col-lg-2 header__branding">
                <a href="/">
                    <?=svg('westex-logo')?>
                </a>
            </div>
            <div class="col col-lg-10 header__nav d-none d-lg-flex">
                <nav id="header">
                    <?=wp_nav_menu(array('theme_location' => 'header_menu'))?>
                    <div class="header__samples header__samples-count--desktop">
                        <?php echo esc_html( __( 'My Samples', 'westex' ) ); ?>
                        <span class="header__samples-count-icon icon icon--m">0</span>
                    </div>
                </nav>
            </div>
            <div class="col-8 d-lg-none">
                <div class="header__mobile-items">
                    <div class="header__samples header__samples-count--mobile">
                        <span class="header__samples-count-icon icon icon--m">0</span>
                    </div>
                    <button class="hamburger hamburger--elastic" type="button"
                            aria-label="Menu" aria-controls="navigation">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
