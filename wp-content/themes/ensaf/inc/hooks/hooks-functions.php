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


    // preloader hook function
    if( ! function_exists( 'ensaf_preloader_wrap_cb' ) ) {
        function ensaf_preloader_wrap_cb() {
            $preloader_display              =  ensaf_opt('ensaf_display_preloader');
            $ensaf_display_preloader_btn     =  ensaf_opt('ensaf_display_preloader_btn');
            $ensaf_preloader_btn_text        =  ensaf_opt('ensaf_preloader_btn_text');

            if( class_exists('ReduxFramework') ){
                if( $preloader_display ){
                    echo '<div id="preloader" class="preloader">';
                        if( $ensaf_display_preloader_btn ){
                            if( !empty( $ensaf_preloader_btn_text ) ){
                                echo '<button class="th-btn preloaderCls">'.esc_html( $ensaf_preloader_btn_text ).'</button>';
                            }
                        }
                        echo '<div class="preloader-inner">
                            <div class="loader"></div>
                        </div>';
                    echo '</div>';
                }
            }else{
                echo '<div class="preloader">';
                    echo '<button class="th-btn preloaderCls">'.esc_html__( 'Cancel Preloader', 'ensaf' ).'</button>';
                    echo '<div class="preloader-inner">
                        <div class="loader"></div>
                    </div>';
                echo '</div>';
            }

        }
    }

    // Header Hook function
    if( !function_exists('ensaf_header_cb') ) { 
        function ensaf_header_cb( ) {
            get_template_part('templates/header');
        }
    }

    // Header Hook function
    if( !function_exists('ensaf_breadcrumb_cb') ) { 
        function ensaf_breadcrumb_cb( ) {
            get_template_part('templates/header-menu-bottom');
        }
    }

    // back top top hook function
    if( ! function_exists( 'ensaf_back_to_top_cb' ) ) {
        function ensaf_back_to_top_cb( ) {
            $backtotop_trigger = ensaf_opt('ensaf_display_bcktotop');
            if( class_exists( 'ReduxFramework' ) ) {
                if( $backtotop_trigger ) {
            	?>
                    <div class="scroll-top">
                        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
                            </path>
                        </svg>
                    </div>
                <?php 
                }
            }

        }
    }

    // Blog Start Wrapper Function
    if( !function_exists('ensaf_blog_start_wrap_cb') ) {
        function ensaf_blog_start_wrap_cb() { ?>
            <section class="th-blog-wrapper space-top space-extra-bottom">
                <div class="container">
                    <div class="row">
        <?php }
    }

    // Blog End Wrapper Function
    if( !function_exists('ensaf_blog_end_wrap_cb') ) {
        function ensaf_blog_end_wrap_cb() {?>
                    </div>
                </div>
            </section>
        <?php }
    }

    // Blog Column Start Wrapper Function
    if( !function_exists('ensaf_blog_col_start_wrap_cb') ) {
        function ensaf_blog_col_start_wrap_cb() {
           
                //Redux option work
                if( class_exists('ReduxFramework') ) {
                    $ensaf_blog_sidebar = ensaf_opt('ensaf_blog_sidebar');
                }else{
                    $ensaf_blog_sidebar = '1';
                }

                if( class_exists('ReduxFramework') ) {
                    // $ensaf_blog_sidebar = ensaf_opt('ensaf_blog_sidebar');
                    if( $ensaf_blog_sidebar == '2' && is_active_sidebar('ensaf-blog-sidebar') ) {
                        echo '<div class="col-xxl-8 col-lg-7  order-lg-last">';
                    } elseif( $ensaf_blog_sidebar == '3' && is_active_sidebar('ensaf-blog-sidebar') ) {
                        echo '<div class="col-xxl-8 col-lg-7">';
                    } else {
                        echo '<div class="col-lg-12">';
                    }

                } else {
                    if( is_active_sidebar('ensaf-blog-sidebar') ) {
                        echo '<div class="col-xxl-8 col-lg-7">';
                    } else {
                        echo '<div class="col-lg-12">';
                    }
                }
                

        }
    }
    // Blog Column End Wrapper Function
    if( !function_exists('ensaf_blog_col_end_wrap_cb') ) {
        function ensaf_blog_col_end_wrap_cb() {
            echo '</div>';
        }
    }

    // Blog Sidebar
    if( !function_exists('ensaf_blog_sidebar_cb') ) {
        function ensaf_blog_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ensaf_blog_sidebar = ensaf_opt('ensaf_blog_sidebar');
            } else {
                $ensaf_blog_sidebar = 2;
                
            }
            if( $ensaf_blog_sidebar != 1 && is_active_sidebar('ensaf-blog-sidebar') ) {
                // Sidebar
                get_sidebar();
            }
        }
    }


    if( !function_exists('ensaf_blog_details_sidebar_cb') ) {
        function ensaf_blog_details_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ensaf_blog_single_sidebar = ensaf_opt('ensaf_blog_single_sidebar');
            } else {
                $ensaf_blog_single_sidebar = 4;
            }
            if( $ensaf_blog_single_sidebar != 1 ) {
                // Sidebar
                get_sidebar();
            }

        }
    }

    // Blog Pagination Function
    if( !function_exists('ensaf_blog_pagination_cb') ) {
        function ensaf_blog_pagination_cb( ) {
            get_template_part('templates/pagination');
        }
    }

    // Blog Content Function
    if( !function_exists('ensaf_blog_content_cb') ) {
        function ensaf_blog_content_cb( ) {

            //Redux option work
            if( class_exists('ReduxFramework') ) {
                $ensaf_blog_grid = ensaf_opt('ensaf_blog_grid');  
            }else{
                $ensaf_blog_grid = '1';
            }

            if( $ensaf_blog_grid == '1' ) {
                $ensaf_blog_grid_class = 'col-lg-12';
            } elseif( $ensaf_blog_grid == '2' ) {
                $ensaf_blog_grid_class = 'col-sm-6';
            } else {
                $ensaf_blog_grid_class = 'col-lg-4 col-sm-6';
            }

            echo '<div class="row">';
                if( have_posts() ) {
                    while( have_posts() ) {
                        the_post();
                        echo '<div class="'.esc_attr($ensaf_blog_grid_class).'">';
                            get_template_part('templates/content',get_post_format());
                        echo '</div>';
                    }
                    wp_reset_postdata();
                } else{
                    get_template_part('templates/content','none');
                }
            echo '</div>';
        }
    }

    // footer content Function
    if( !function_exists('ensaf_footer_content_cb') ) {
        function ensaf_footer_content_cb( ) {

            if( class_exists('ReduxFramework') && did_action( 'elementor/loaded' )  ){
                if( is_page() || is_page_template('template-builder.php') ) {
                    $post_id = get_the_ID();

                    // Get the page settings manager
                    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

                    // Get the settings model for current post
                    $page_settings_model = $page_settings_manager->get_model( $post_id );

                    // Retrieve the Footer Style
                    $footer_settings = $page_settings_model->get_settings( 'ensaf_footer_style' );

                    // Footer Local
                    $footer_local = $page_settings_model->get_settings( 'ensaf_footer_builder_option' );

                    // Footer Enable Disable
                    $footer_enable_disable = $page_settings_model->get_settings( 'ensaf_footer_choice' );

                    if( $footer_enable_disable == 'yes' ){
                        if( $footer_settings == 'footer_builder' ) {
                            // local options
                            $ensaf_local_footer = get_post( $footer_local );
                            echo '<footer>';
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $ensaf_local_footer->ID );
                            echo '</footer>';
                        } else {
                            // global options
                            $ensaf_footer_builder_trigger = ensaf_opt('ensaf_footer_builder_trigger');
                            if( $ensaf_footer_builder_trigger == 'footer_builder' ) {
                                echo '<footer>';
                                $ensaf_global_footer_select = get_post( ensaf_opt( 'ensaf_footer_builder_select' ) );
                                $footer_post = get_post( $ensaf_global_footer_select );
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                                echo '</footer>';
                            } else {
                                // wordpress widgets
                                ensaf_footer_global_option();
                            }
                        }
                    }
                } else {
                    // global options
                    $ensaf_footer_builder_trigger = ensaf_opt('ensaf_footer_builder_trigger');
                    if( $ensaf_footer_builder_trigger == 'footer_builder' ) {
                        echo '<footer>';
                        $ensaf_global_footer_select = get_post( ensaf_opt( 'ensaf_footer_builder_select' ) );
                        $footer_post = get_post( $ensaf_global_footer_select );
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                        echo '</footer>';
                    } else {
                        // wordpress widgets
                        ensaf_footer_global_option();
                    }
                }
            } else { ?>
                <div class="footer-layout1 footer-sitcky">
                    <div class="copyright-wrap bg-theme2">
                        <div class="container">
                            <p class="copyright-text text-center"><?php echo sprintf( 'Copyright <i class="fal fa-copyright"></i> %s <a href="%s"> %s </a> All Rights Reserved.', date('Y'), esc_url('#'), esc_html__( 'Ensaf.','ensaf') ); ?></p> 
                        </div>
                    </div>
                </div>
            <?php }

        }
    }

    // blog details wrapper start hook function
    if( !function_exists('ensaf_blog_details_wrapper_start_cb') ) {
        function ensaf_blog_details_wrapper_start_cb( ) {
            echo '<section class="th-blog-wrapper blog-details space-top space-extra-bottom">';
                echo '<div class="container">';
                    if( is_active_sidebar( 'ensaf-blog-sidebar' ) ){
                        $ensaf_gutter_class = 'gx-60';
                    }else{
                        $ensaf_gutter_class = '';
                    }
                    // echo '<div class="row './/esc_attr( $ensaf_gutter_class ).'">';
                    echo '<div class="row">';
        }
    }

    // blog details column wrapper start hook function
    if( !function_exists('ensaf_blog_details_col_start_cb') ) {
        function ensaf_blog_details_col_start_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ensaf_blog_single_sidebar = ensaf_opt('ensaf_blog_single_sidebar');
                if( $ensaf_blog_single_sidebar == '2' && is_active_sidebar('ensaf-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7 order-lg-last">';
                } elseif( $ensaf_blog_single_sidebar == '3' && is_active_sidebar('ensaf-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('ensaf-blog-sidebar') ) {
                    echo '<div class="col-xxl-8 col-lg-7">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }

    // blog details post meta hook function
    if( !function_exists('ensaf_blog_post_meta_cb') ) { 
        function ensaf_blog_post_meta_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ensaf_display_post_author      =  ensaf_opt('ensaf_display_post_author');
                $ensaf_display_post_date      =  ensaf_opt('ensaf_display_post_date');
                $ensaf_display_post_cate   =  ensaf_opt('ensaf_display_post_cate');
                $ensaf_display_post_comments      =  ensaf_opt('ensaf_display_post_comments');
            } else {
                $ensaf_display_post_author      = '1';
                $ensaf_display_post_date      = '1';
                $ensaf_display_post_cate   = '0';
                $ensaf_display_post_comments      = '1'; 
            }

                echo '<div class="blog-meta">';
                    if( $ensaf_display_post_author ){
                        echo '<a class="author" href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'"><i class="fa-regular fa-user"></i>'. esc_html__('By ', 'ensaf') .esc_html( ucwords( get_the_author() ) ).'</a>';
                    }
                    if( $ensaf_display_post_date ){
                        echo ' <a href="'.esc_url( ensaf_blog_date_permalink() ).'"><i class="fa-regular fa-calendar"></i>'.esc_html( get_the_date() ).'</a>';
                    }
                    if( $ensaf_display_post_cate ){
                        $categories = get_the_category(); 
                        if(!empty($categories)){
                        echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'"><i class="fa-regular fa-tag"></i>'.esc_html( $categories[0]->name ).'</a>';
                        }
                    }
                    if( $ensaf_display_post_comments ){
                        ?>
                        <a href="#"><i class="fa-regular fa-comment"></i>
                            <?php 
                                echo get_comments_number(); 
                                if(get_comments_number() == 1){
                                    echo esc_html__(' Comment', 'ensaf'); 
                                }else{
                                    echo esc_html__(' Comments', 'ensaf'); 
                                }
                                ?></a>
                        <?php
                    }
                echo '</div>';
        }
    }

    // blog details share options hook function
    if( !function_exists('ensaf_blog_details_share_options_cb') ) {
        function ensaf_blog_details_share_options_cb( ) {

            if( class_exists('ReduxFramework') ) {
                $ensaf_post_details_share = ensaf_opt('ensaf_post_details_share_options');
            } else {
                $ensaf_post_details_share = "0";
            }

            if( function_exists( 'ensaf_social_sharing_buttons' ) ){
                if( $ensaf_post_details_share ){
                    echo '<div class="col-sm-auto text-xl-end">';
                        echo '<span class="share-links-title">'.esc_html__('Share:', 'ensaf').'</span>';
                       echo ' <div class="th-social">';
                            echo ensaf_social_sharing_buttons();
                        echo '</div>';
                    echo '</div>';
                }
            }
            
    
        }
    }
    
    
    // blog details author bio hook function
    if( !function_exists('ensaf_blog_details_author_bio_cb') ) {
        function ensaf_blog_details_author_bio_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $postauthorbox =  ensaf_opt( 'ensaf_post_details_author_box' );
            } else {
                $postauthorbox = '0';
            }
            if(  $postauthorbox == '1' ) {
                echo '<div class="widget widget-author">';
                    echo '<div class="author-widget-wrap">';
                        echo '<div class="avater">';
                            echo '<img src="'.esc_url( get_avatar_url( get_the_author_meta('ID') ) ).'" alt="'.esc_attr__('Author Image', 'ensaf').'">';
                        echo '</div>';
                        echo '<div class="author-info">';
                            echo '<h4 class="box-title"><a class="text-inherit" href="blog.html">'.esc_html( ucwords( get_the_author() )).'</a></h4>';
                            echo '<span class="desig">'.get_user_meta( get_the_author_meta('ID'), '_ensaf_author_desig',true ).'</span>';
                            echo '<p class="author-bio">'.get_the_author_meta( 'user_description', get_the_author_meta('ID') ).'</p>';
                            echo '<div class="social-links">';
                                $ensaf_social_icons = get_user_meta( get_the_author_meta('ID'), '_ensaf_social_profile_group',true );
                                if(!empty($ensaf_social_icons)){
                                    foreach( $ensaf_social_icons as $singleicon ) {
                                        if( ! empty( $singleicon['_ensaf_social_profile_icon'] ) ) {
                                            echo '<a href="'.esc_url( $singleicon['_ensaf_lawyer_social_profile_link'] ).'"><i class="'.esc_attr( $singleicon['_ensaf_social_profile_icon'] ).'"></i></a>';
                                        }
                                    }
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

               
            }

        }
    }

     // Blog Details Post Navigation hook function
     if( !function_exists( 'ensaf_blog_details_post_navigation_cb' ) ) {
        function ensaf_blog_details_post_navigation_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ensaf_post_navigation = ensaf_opt('ensaf_post_details_post_navigation');
            } else {
                $ensaf_post_navigation = 0;
            }

            $prevpost = get_previous_post();
            $nextpost = get_next_post();

            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
            ); 

            if( ($ensaf_post_navigation == '1') && (!empty($prevpost) || !empty($nextpost)) ) {
                echo '<div class="blog-navigation">'; 
                    if( ! empty( $prevpost ) ) {
                        echo '<a href="'.esc_url( get_permalink( $prevpost->ID ) ).'" class="nav-btn prev">';
                            echo '<i class="fa-solid fa-angle-left"></i>';
                            echo ' <span class="nav-text">'.esc_attr__('Previous', 'ensaf').'</span>';
                        echo '</a>';
                    } 

                    if( ! empty( $nextpost ) ) {
                        echo '<a href="'.esc_url( get_permalink( $nextpost->ID ) ).'" class="nav-btn next">';
                        echo ' <span class="nav-text">'.esc_attr__('Next', 'ensaf').'</span>';
                        echo '<i class="fa-solid fa-angle-right"></i>';
                        echo '</a>';
                    }
                echo '</div>';
            }

        }
    }

    // Blog Details Comments hook function
    if( !function_exists('ensaf_blog_details_comments_cb') ) {
        function ensaf_blog_details_comments_cb( ) {
            if ( ! comments_open() ) {
                echo '<div class="blog-comment-area">';
                    echo ensaf_heading_tag( array(
                        "tag"   => "h3",
                        "text"  => esc_html__( 'Comments are closed', 'ensaf' ),
                        "class" => "inner-title"
                    ) );
                echo '</div>';
            }

            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        }
    }

    // Blog Details Column end hook function
    if( !function_exists('ensaf_blog_details_col_end_cb') ) {
        function ensaf_blog_details_col_end_cb( ) {
            echo '</div>';
        }
    }

    // Blog Details Wrapper end hook function
    if( !function_exists('ensaf_blog_details_wrapper_end_cb') ) {
        function ensaf_blog_details_wrapper_end_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page start wrapper hook function
    if( !function_exists('ensaf_page_start_wrap_cb') ) {
        function ensaf_page_start_wrap_cb( ) {
            
            if( is_page( 'cart' ) ){
                $section_class = "th-cart-wrapper space-top space-extra-bottom";
            }elseif( is_page( 'checkout' ) ){
                $section_class = "th-checkout-wrapper space-top space-extra-bottom";
            }elseif( is_page('wishlist') ){
                $section_class = "wishlist-area space-top space-extra-bottom";
            }else{
                $section_class = "space-top space-extra-bottom";  
            }
            echo '<section class="'.esc_attr( $section_class ).'">';
                echo '<div class="container">';
                    echo '<div class="row">';
        }
    }

    // page wrapper end hook function
    if( !function_exists('ensaf_page_end_wrap_cb') ) {
        function ensaf_page_end_wrap_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page column wrapper start hook function
    if( !function_exists('ensaf_page_col_start_wrap_cb') ) {
        function ensaf_page_col_start_wrap_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ensaf_page_sidebar = ensaf_opt('ensaf_page_sidebar');
            }else {
                $ensaf_page_sidebar = '1';
            }
            
            if( $ensaf_page_sidebar == '2' && is_active_sidebar('ensaf-page-sidebar') ) {
                echo '<div class="col-lg-8 order-last">';
            } elseif( $ensaf_page_sidebar == '3' && is_active_sidebar('ensaf-page-sidebar') ) {
                echo '<div class="col-lg-8">';
            } else {
                echo '<div class="col-lg-12">';
            }

        }
    }

    // page column wrapper end hook function
    if( !function_exists('ensaf_page_col_end_wrap_cb') ) {
        function ensaf_page_col_end_wrap_cb( ) {
            echo '</div>';
        }
    }

    // page sidebar hook function
    if( !function_exists('ensaf_page_sidebar_cb') ) {
        function ensaf_page_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $ensaf_page_sidebar = ensaf_opt('ensaf_page_sidebar');
            }else {
                $ensaf_page_sidebar = '1';
            }

            if( class_exists('ReduxFramework') ) {
                $ensaf_page_layoutopt = ensaf_opt('ensaf_page_layoutopt');
            }else {
                $ensaf_page_layoutopt = '3';
            }

            if( $ensaf_page_layoutopt == '1' && $ensaf_page_sidebar != 1 ) {
                get_sidebar('page');
            } elseif( $ensaf_page_layoutopt == '2' && $ensaf_page_sidebar != 1 ) {
                get_sidebar();
            }
        }
    }

    // page content hook function
    if( !function_exists('ensaf_page_content_cb') ) {
        function ensaf_page_content_cb( ) {
            if(  class_exists('woocommerce') && ( is_woocommerce() || is_cart() || is_checkout() || is_page('wishlist') || is_account_page() )  ) {
                echo '<div class="woocommerce--content">';
            } else {
                echo '<div class="page--content clearfix">';
            }

                the_content();

                // Link Pages
                ensaf_link_pages();

            echo '</div>';
            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

        }
    }

    if( !function_exists('ensaf_blog_post_thumb_cb') ) {
        function ensaf_blog_post_thumb_cb( ) {
            if( get_post_format() ) {
                $format = get_post_format();
            }else{
                $format = 'standard';
            }

            $ensaf_post_slider_thumbnail = ensaf_meta( 'post_format_slider' );

            if( !empty( $ensaf_post_slider_thumbnail ) ){
                echo '<div class="blog-img th-slider" data-slider-options=\'{"effect":"fade"}\'>';
                    echo '<div class="swiper-wrapper">';
                        foreach( $ensaf_post_slider_thumbnail as $single_image ){
                            echo '<div class="swiper-slide">';
                                echo ensaf_img_tag( array(
                                    'url'   => esc_url( $single_image )
                                ) );
                            echo '</div>';
                        }
                    echo '</div>';
                    echo '<button class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
                    echo '<button class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
                echo '</div>';

            }elseif( has_post_thumbnail() && $format == 'standard' ) {
                echo '<!-- Post Thumbnail -->';
                echo '<div class="blog-img">';
                    if( ! is_single() ){
                        echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">'; 
                    }

                    the_post_thumbnail();

                    if( ! is_single() ){
                        echo '</a>';
                    }
                echo '</div>';
                echo '<!-- End Post Thumbnail -->';
            }elseif( $format == 'video' ){
                if( has_post_thumbnail() && ! empty ( ensaf_meta( 'post_format_video' ) ) ){
                    echo '<div class="blog-img blog-video" data-overlay="title" data-opacity="4">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            the_post_thumbnail();

                        if( ! is_single() ){
                            echo '</a>';
                        }
                        echo '<a href="'.esc_url( ensaf_meta( 'post_format_video' ) ).'" class="play-btn popup-video">';
                            echo '<i class="fas fa-play"></i>';
                        echo '</a>';
                    echo '</div>';
                }elseif( ! has_post_thumbnail() && ! is_single() ){
                    echo '<div class="blog-video">';
                        if( ! is_single() ){
                            echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                        }
                            echo ensaf_embedded_media( array( 'video', 'iframe' ) );
                        if( ! is_single() ){
                            echo '</a>';
                        }
                    echo '</div>';
                }
            }elseif( $format == 'audio' ){
                $ensaf_audio = ensaf_meta( 'post_format_audio' );
                if( ! empty( $ensaf_audio ) ){
                    echo '<div class="blog-audio">';
                        echo wp_oembed_get( $ensaf_audio );
                    echo '</div>';
                }elseif( ! is_single() ){
                    echo '<div class="blog-audio">';
                        echo wp_oembed_get( $ensaf_audio );
                    echo '</div>';
                }
            }

        }
    }

    if( !function_exists('ensaf_blog_post_content_cb') ) {
        function ensaf_blog_post_content_cb( ) {
            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
            );
            if( class_exists( 'ReduxFramework' ) ) {
                $ensaf_excerpt_length          = ensaf_opt( 'ensaf_blog_postExcerpt' );
                $ensaf_display_post_category   = ensaf_opt( 'ensaf_display_post_category' );
            } else {
                $ensaf_excerpt_length          = '35';
                $ensaf_display_post_category   = '1';
            }

            if( class_exists( 'ReduxFramework' ) ) {
                $ensaf_blog_admin = ensaf_opt( 'ensaf_blog_post_author' );
                $ensaf_blog_readmore_setting_val = ensaf_opt('ensaf_blog_readmore_setting');
                if( $ensaf_blog_readmore_setting_val == 'custom' ) {
                    $ensaf_blog_readmore_setting = ensaf_opt('ensaf_blog_custom_readmore');
                } else {
                    $ensaf_blog_readmore_setting = __( 'Read More', 'ensaf' );
                }
            } else {
                $ensaf_blog_readmore_setting = __( 'Read More', 'ensaf' );
                $ensaf_blog_admin = true;
            }
            echo '<!-- blog-content -->';

                do_action( 'ensaf_blog_post_thumb' );
                
                echo '<div class="blog-content">';

                    // Blog Post Meta
                    do_action( 'ensaf_blog_post_meta' );

                    echo '<h2 class="blog-title"><a href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title( ), $allowhtml ).'</a></h2>';

                    echo '<!-- Post Summary -->';
                    echo ensaf_paragraph_tag( array(
                        "text"  => wp_kses( wp_trim_words( get_the_excerpt(), $ensaf_excerpt_length, '' ), $allowhtml ),
                        "class" => 'blog-text',
                    ) );
  
                    if( !empty( $ensaf_blog_readmore_setting ) ){
                        echo '<a href="'.esc_url( get_permalink() ).'" class="link-btn">'.esc_html( $ensaf_blog_readmore_setting ).'<i class="fa-regular fa-arrow-right-long"></i></a>';
                    }

                echo '</div>';
            echo '<!-- End Post Content -->';
        }
    }
