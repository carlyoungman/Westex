<?php
/*==================================
|    Theme Functions
==================================*/

/**
 * Autoload composer packages
 */
require_once __DIR__ . '/vendor/autoload.php';

// Custom post types
require_once get_template_directory().'/inc/theme-CPT.php';
// Taxonomies
require_once get_template_directory().'/inc/theme-taxonomies.php';
// Load theme init functions
require_once get_template_directory().'/inc/theme-init.php';

// Load theme registers
require_once get_template_directory().'/inc/theme-register.php';

// Load theme security functions
require_once get_template_directory().'/inc/theme-security.php';

// Load theme custom functions
require_once get_template_directory().'/inc/theme-functions.php';

// Load theme Ajax
require_once get_template_directory().'/inc/theme-ajax.php';

// Load theme scripts and styles
require_once get_template_directory().'/inc/theme-scripts.php';

// Load theme custom meta
require_once get_template_directory().'/inc/theme-meta.php';

// Load theme queries
require_once get_template_directory().'/inc/theme-queries.php';
