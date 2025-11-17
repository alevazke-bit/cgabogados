<?php
/**
 * @Packge     : Ensaf
 * @Version    : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 *
*/

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) && defined('ELEMENTOR_VERSION') ) {
        if( is_page() || is_page_template('template-builder.php') ) {
            $ensaf_post_id = get_the_ID();

            // Get the page settings manager
            $ensaf_page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

            // Get the settings model for current post
            $ensaf_page_settings_model = $ensaf_page_settings_manager->get_model( $ensaf_post_id );

            // Retrieve the color we added before
            $ensaf_header_style = $ensaf_page_settings_model->get_settings( 'ensaf_header_style' );
            $ensaf_header_builder_option = $ensaf_page_settings_model->get_settings( 'ensaf_header_builder_option' );

            if( $ensaf_header_style == 'header_builder'  ) {

                if( !empty( $ensaf_header_builder_option ) ) {
                    $ensafheader = get_post( $ensaf_header_builder_option );
                    echo '<header class="header">';
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $ensafheader->ID );
                    echo '</header>';
                }
            } else {
                // global options
                $ensaf_header_builder_trigger = ensaf_opt('ensaf_header_options');
                if( $ensaf_header_builder_trigger == '2' ) {
                    echo '<header>';
                    $ensaf_global_header_select = get_post( ensaf_opt( 'ensaf_header_select_options' ) );
                    $header_post = get_post( $ensaf_global_header_select );
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                    echo '</header>';
                } else {
                    // wordpress Header
                    ensaf_global_header_option();
                }
            }
        } else {
            $ensaf_header_options = ensaf_opt('ensaf_header_options');
            if( $ensaf_header_options == '1' ) {
                ensaf_global_header_option();
            } else {
                $ensaf_header_select_options = ensaf_opt('ensaf_header_select_options');
                $ensafheader = get_post( $ensaf_header_select_options );
                echo '<header class="header">';
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $ensafheader->ID );
                echo '</header>';
            }
        }
    } else {
        ensaf_global_header_option();
    }