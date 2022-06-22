<?php
/*============================================
|	  Footer Component
============================================*/
global $prefix;
?>
<?php get_template_part( 'template_parts/back-to-top' ); ?>
</main>
<footer data-anim>
  <div class="container-fluid container--max">
    <div class="row footer__top">
      <div class="col-12 col-md-5 col-lg-4 footer__search">
          <p>Get the latest news from Westex.</p>
          <?php echo do_shortcode('[contact-form-7 id="6004" title="Newsletter"]') ?>
        <div class="footer__socials">
          <?=yr_socials('', true)?>
        </div>
      </div>
      <div class="col-12 col-md-7 col-lg-8 footer__widgets">
        <?php dynamic_sidebar('footer-widgets')?>
      </div>
    </div>
    <div class="row footer__bottom">
      <div class="col-12 d-flex flex-wrap justify-content-between">
        <span class="copyright">© <?=date('Y')?> Westex Carpets. Designed by Creative Spark.</span>
          <?=wp_nav_menu(array('theme_location' => 'legal_menu'))?>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
