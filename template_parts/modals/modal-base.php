<?php
/**
 * Template part for displaying modals
 *
 * @package HARWELL\Core
 */

if (! defined('ABSPATH') ) {
    exit();
}
$base      = 'modal-base';
$template  = $args['data']['template'] ?: null;
$post_type = $args['data']['post_type'] ?: '';
$section_classes_array = [
    $base,
    $base . '--animate',
	$base . '--' . $post_type,
];
$section_classes = implode( ' ', $section_classes_array );
?>
<section class="<?php echo esc_attr( $section_classes ); ?>">
    <div class="container-fluid container--max">
        <div class="row">
            <div class="col">
                <div class="<?php echo esc_attr( $base ); ?>__popup">
                    <!-- Close -->
                    <button type="button" class="<?php echo esc_attr( $base ); ?>__close">
                        <svg class="<?php echo esc_attr( $base ); ?>__icon icon icon--m ">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use>
                        </svg>
                    </button>
                    <!-- Content -->
                    <div class="<?php echo esc_attr( $base ); ?>__body">
                        <?php
                        get_template_part(
                            'template_parts/modals/includes/modal-' . $template,
                            null,
                            [
                                'data' => [
                                    'button'            => $args['data']['button'] ?: false,
                                    'buttons'           => $args['data']['buttons'] ?: false
                                ],
                                ]
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
