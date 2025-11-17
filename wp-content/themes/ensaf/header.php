<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>

<?php
    wp_body_open();

    /**
    *
    * Preloader
    *
    * Hook ensaf_preloader_wrap
    *
    * @Hooked ensaf_preloader_wrap_cb 10
    *
    */
    do_action( 'ensaf_preloader_wrap' );

    if( ! ensaf_opt('ensaf_header_sticky')){ ?>
        <div id="smooth-wrapper">
            <div id="smooth-content">
    <?php }

    /**
    *
    * ensaf header
    *
    * Hook ensaf_header
    *
    * @Hooked ensaf_header_cb 10
    *
    */
    do_action( 'ensaf_header' );

    if( ensaf_opt('ensaf_header_sticky')) { ?>
        <div id="smooth-wrapper">
            <div id="smooth-content">
    <?php }


    /**
    *
    * ensaf breadcrumb
    *
    * Hook ensaf_breadcrumb
    *
    * @Hooked ensaf_breadcrumb_cb 10
    *
    */
    do_action( 'ensaf_breadcrumb' );