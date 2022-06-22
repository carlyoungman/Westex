<?php
/**
 * Template part for displaying the organisation modal
 *
 * Used within block-template-parts/modals/modal-base
 *
 * @package HARWELL\Core
 */

use HARWELL\Core\Module\Template;
defined('ABSPATH') ||  exit();
$button   = $args['data']['button'] ?: false;
$buttons  = $args['data']['buttons'] ?: false;
get_template_part(
    'template_parts/modals/includes/modal-product',
    null,
    [
        'data' => [
            'collection'            => 'carpet-collection' ?: false,
            'button'            => $args['data']['button'] ?: false,
            'buttons'           => $args['data']['buttons'] ?: false
        ],
    ]
);
