<?php
/*============================================
|	  Header Component
============================================*/
global $prefix;
$pageDividers = isset(get_field($prefix.'config')['dividers']) ? get_field($prefix.'config')['dividers'] : false;
$bodyClass = ($pageDividers) ? 'page--use-dividers' : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/dist/assets/favicons/apple-touch-icon.png' ); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/dist/assets/favicons/favicon-32x32.png' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/dist/assets/favicons/favicon-16x16.png' ); ?> ">
    <link rel="manifest" href=" <?php echo esc_url( get_template_directory_uri() . '/dist/assets/favicons/site.webmanifest' ); ?>">
    <link rel="mask-icon" href="<?php echo esc_url( get_template_directory_uri() . '/dist/assets/favicons/safari-pinned-tab.SVG" color="#68d18d' ); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/dist/assets/favicons/favicon.ico' ); ?>">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="msapplication-config" content="
    <?php echo esc_url( get_template_directory_uri() . '/dist/assets/favicons/browserconfig.xml' ); ?>">
    <meta name="theme-color" content="#000000">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class($bodyClass); ?>>
<?php get_template_part( 'template_parts/header-desktop'); ?>
<?php get_template_part( 'template_parts/mobile-navigation'); ?>
<?php get_template_part( 'template_parts/samples'); ?>
<main id="wrapper">
