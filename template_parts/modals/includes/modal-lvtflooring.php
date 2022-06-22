<?php
/**
 * Template part for displaying the organisation modal
 *
 * Used within block-template-parts/modals/modal-base
 *
 * @package HARWELL\Core
 */

use HARWELL\Core\Module\Template;
$button   = $args['data']['button'] ?: false;
$buttons  = $args['data']['buttons'] ?: false;
defined('ABSPATH') ||  exit();
get_template_part(
    'template_parts/modals/includes/modal-product',
    null,
    [
        'data' => [
            'collection'            => 'lvtflooring-collection' ?: false,
            'button'            => $args['data']['button'] ?: false,
            'buttons'           => $args['data']['buttons'] ?: false
        ],
    ]
);
