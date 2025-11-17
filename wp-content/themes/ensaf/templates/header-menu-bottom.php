<?php
/**
 * @Packge     : Ensaf
 * @Version    : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 *
*/

    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit();
    }

    if( defined( 'CMB2_LOADED' )  ){
        if( !empty( ensaf_meta('page_breadcrumb_area') ) ) {
            $ensaf_page_breadcrumb_area  = ensaf_meta('page_breadcrumb_area');
        } else {
            $ensaf_page_breadcrumb_area = '1';
        }
    }else{
        $ensaf_page_breadcrumb_area = '1';
    }
    
    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array()
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
        'sub'       => array(),
        'sup'       => array(),
    );
    
    if(  is_page() || is_page_template( 'template-builder.php' )  ) {
        if( $ensaf_page_breadcrumb_area == '1' ) {
            echo '<!-- Page title 2 -->';
            
            if( class_exists( 'ReduxFramework' ) ){
                $ex_class = '';
            }else{
                $ex_class = ' th-breadcumb';   
            }
            echo '<div class="breadcumb-banner">';
                echo '<div class="breadcumb-wrapper '. esc_attr($ex_class).'" id="breadcumbwrap"  data-overlay="title" data-opacity="8">';
                    echo '<div class="container">';
                        echo '<div class="breadcumb-content">';
                            if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {
                                if( !empty( ensaf_meta('page_breadcrumb_settings') ) ) {
                                    if( ensaf_meta('page_breadcrumb_settings') == 'page' ) {
                                        $ensaf_page_title_switcher = ensaf_meta('page_title');
                                    } else {
                                        $ensaf_page_title_switcher = ensaf_opt('ensaf_page_title_switcher');
                                    }
                                } else {
                                    $ensaf_page_title_switcher = '1';
                                }
                            } else {
                                $ensaf_page_title_switcher = '1';
                            }

                            if( $ensaf_page_title_switcher ){
                                if( class_exists( 'ReduxFramework' ) ){
                                    $ensaf_page_title_tag    = ensaf_opt('ensaf_page_title_tag');
                                }else{
                                    $ensaf_page_title_tag    = 'h1';
                                }

                                if( defined( 'CMB2_LOADED' )  ){
                                    if( !empty( ensaf_meta('page_title_settings') ) ) {
                                        $ensaf_custom_title = ensaf_meta('page_title_settings');
                                    } else {
                                        $ensaf_custom_title = 'default';
                                    }
                                }else{
                                    $ensaf_custom_title = 'default';
                                }

                                if( $ensaf_custom_title == 'default' ) {
                                    echo ensaf_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $ensaf_page_title_tag ),
                                            "text"  => esc_html( get_the_title( ) ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                } else {
                                    echo ensaf_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $ensaf_page_title_tag ),
                                            "text"  => esc_html( ensaf_meta('custom_page_title') ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }

                            }
                            if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {

                                if( ensaf_meta('page_breadcrumb_settings') == 'page' ) {
                                    $ensaf_breadcrumb_switcher = ensaf_meta('page_breadcrumb_trigger');
                                } else {
                                    $ensaf_breadcrumb_switcher = ensaf_opt('ensaf_enable_breadcrumb');
                                }

                            } else {
                                $ensaf_breadcrumb_switcher = '1';
                            }

                            if( $ensaf_breadcrumb_switcher == '1' && (  is_page() || is_page_template( 'template-builder.php' ) )) {
                                    ensaf_breadcrumbs(
                                        array(
                                            'breadcrumbs_classes' => '',
                                        )
                                    );
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<!-- End of Page title -->';
            
        }
    } else {
        echo '<!-- Page title 3 -->';
         if( class_exists( 'ReduxFramework' ) ){
            $ex_class = '';
            if (class_exists( 'woocommerce' ) && is_shop()){
            $breadcumb_bg_class = 'custom-woo-class';
            }elseif(is_404()){
                $breadcumb_bg_class = 'custom-error-class';
            }elseif(is_search()){
                $breadcumb_bg_class = 'custom-search-class';
            }elseif(is_archive()){
                $breadcumb_bg_class = 'custom-archive-class';
            }else{
                $breadcumb_bg_class = '';
            }
        }else{
            $breadcumb_bg_class = ''; 
            $ex_class = ' th-breadcumb';     
        }

        echo '<div class="breadcumb-banner">';
            echo '<div class="breadcumb-wrapper '. esc_attr($breadcumb_bg_class . $ex_class).'" data-overlay="title" data-opacity="8">'; 
                echo '<div class="container z-index-common">';
                        echo '<div class="breadcumb-content">';
                            if( class_exists( 'ReduxFramework' )  ){
                                $ensaf_page_title_switcher  = ensaf_opt('ensaf_page_title_switcher');
                            }else{
                                $ensaf_page_title_switcher = '1';
                            }

                            if( $ensaf_page_title_switcher ){
                                if( class_exists( 'ReduxFramework' ) ){
                                    $ensaf_page_title_tag    = ensaf_opt('ensaf_page_title_tag');
                                }else{
                                    $ensaf_page_title_tag    = 'h1';
                                }
                                if( class_exists('woocommerce') && is_shop() ) {
                                    echo ensaf_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $ensaf_page_title_tag ),
                                            "text"  => wp_kses( woocommerce_page_title( false ), $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }elseif ( is_archive() ){
                                    echo ensaf_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $ensaf_page_title_tag ),
                                            "text"  => wp_kses( get_the_archive_title(), $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }elseif ( is_home() ){
                                    $ensaf_blog_page_title_setting = ensaf_opt('ensaf_blog_page_title_setting');
                                    $ensaf_blog_page_title_switcher = ensaf_opt('ensaf_blog_page_title_switcher');
                                    $ensaf_blog_page_custom_title = ensaf_opt('ensaf_blog_page_custom_title');
                                    if( class_exists('ReduxFramework') ){
                                        if( $ensaf_blog_page_title_switcher ){
                                            echo ensaf_heading_tag(
                                                array(
                                                    "tag"   => esc_attr( $ensaf_page_title_tag ),
                                                    "text"  => !empty( $ensaf_blog_page_custom_title ) && $ensaf_blog_page_title_setting == 'custom' ? esc_html( $ensaf_blog_page_custom_title) : esc_html__( 'Latest News', 'ensaf' ),
                                                    'class' => 'breadcumb-title'
                                                )
                                            );
                                        }
                                    }else{
                                        echo ensaf_heading_tag(
                                            array(
                                                "tag"   => "h1",
                                                "text"  => esc_html__( 'Latest News', 'ensaf' ),
                                                'class' => 'breadcumb-title',
                                            )
                                        );
                                    }
                                }elseif( is_search() ){
                                    echo ensaf_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $ensaf_page_title_tag ),
                                            "text"  => esc_html__( 'Search Result', 'ensaf' ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }elseif( is_404() ){
                                    echo ensaf_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $ensaf_page_title_tag ),
                                            "text"  => esc_html__( 'Error Page', 'ensaf' ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }elseif( is_singular( 'product' ) ){
                                    $posttitle_position  = ensaf_opt('ensaf_product_details_title_position');
                                    $postTitlePos = false;
                                    if( class_exists( 'ReduxFramework' ) ){
                                        if( $posttitle_position && $posttitle_position != 'header' ){
                                            $postTitlePos = true;
                                        }
                                    }else{
                                        $postTitlePos = false;
                                    }

                                    if( $postTitlePos != true ){
                                        echo ensaf_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $ensaf_page_title_tag ),
                                                "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    } else {
                                        if( class_exists( 'ReduxFramework' ) ){
                                            $ensaf_post_details_custom_title  = ensaf_opt('ensaf_product_details_custom_title');
                                        }else{
                                            $ensaf_post_details_custom_title = __( 'Shop Details','ensaf' );
                                        }

                                        if( !empty( $ensaf_post_details_custom_title ) ) {
                                            echo ensaf_heading_tag(
                                                array(
                                                    "tag"   => esc_attr( $ensaf_page_title_tag ),
                                                    "text"  => wp_kses( $ensaf_post_details_custom_title, $allowhtml ),
                                                    'class' => 'breadcumb-title'
                                                )
                                            );
                                        }
                                    }
                                }else{
                                    $posttitle_position  = ensaf_opt('ensaf_post_details_title_position');
                                    $postTitlePos = false;
                                    if( is_single() ){
                                        if( class_exists( 'ReduxFramework' ) ){
                                            if( $posttitle_position && $posttitle_position != 'header' ){
                                                $postTitlePos = true;
                                            }
                                        }else{
                                            $postTitlePos = false;
                                        }
                                    }
                                    if( is_singular( 'product' ) ){
                                        $posttitle_position  = ensaf_opt('ensaf_product_details_title_position');
                                        $postTitlePos = false;
                                        if( class_exists( 'ReduxFramework' ) ){
                                            if( $posttitle_position && $posttitle_position != 'header' ){
                                                $postTitlePos = true;
                                            }
                                        }else{
                                            $postTitlePos = false;
                                        }
                                    }

                                    if( $postTitlePos != true ){
                                        echo ensaf_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $ensaf_page_title_tag ),
                                                "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    } else {
                                        if( class_exists( 'ReduxFramework' ) ){
                                            $ensaf_post_details_custom_title  = ensaf_opt('ensaf_post_details_custom_title');
                                        }else{
                                            $ensaf_post_details_custom_title = __( 'Blog Details','ensaf' );
                                        }

                                        if( !empty( $ensaf_post_details_custom_title ) ) {
                                            echo ensaf_heading_tag(
                                                array(
                                                    "tag"   => esc_attr( $ensaf_page_title_tag ),
                                                    "text"  => wp_kses( $ensaf_post_details_custom_title, $allowhtml ),
                                                    'class' => 'breadcumb-title'
                                                )
                                            );
                                        }
                                    }
                                }
                            }
                            if( class_exists('ReduxFramework') ) {
                                $ensaf_breadcrumb_switcher = ensaf_opt( 'ensaf_enable_breadcrumb' );
                            } else {
                                $ensaf_breadcrumb_switcher = '1';
                            }
                            if( $ensaf_breadcrumb_switcher == '1' ) {
                                if(ensaf_breadcrumbs()){
                                echo '<div>';
                                    ensaf_breadcrumbs(
                                        array(
                                            'breadcrumbs_classes' => 'nav',
                                        )
                                    );
                                echo '</div>';
                                }
                            }
                        echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<!-- End of Page title -->';
    }