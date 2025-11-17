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

    ensaf_setPostViews( get_the_ID() );

    ?>
    <div <?php post_class(); ?>>
    <?php
        if( class_exists('ReduxFramework') ) {
            $ensaf_post_details_title_position = ensaf_opt('ensaf_post_details_title_position');
        } else {
            $ensaf_post_details_title_position = 'header';
        }

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
        // Blog Post Thumbnail
        do_action( 'ensaf_blog_post_thumb' );
        
        echo '<div class="blog-content">';
            // Blog Post Meta
            do_action( 'ensaf_blog_post_meta' );

            if( $ensaf_post_details_title_position != 'header' ) {
                echo '<h2 class="blog-title">'.wp_kses( get_the_title(), $allowhtml ).'</h2>';
            }

            if( get_the_content() ){

                the_content();
                // Link Pages
                ensaf_link_pages();
            }  

            if( class_exists('ReduxFramework') ) {
                $ensaf_post_details_share_options = ensaf_opt('ensaf_post_details_share_options');
                $ensaf_display_post_tags = ensaf_opt('ensaf_display_post_tags');
                $ensaf_author_options = ensaf_opt('ensaf_post_details_author_desc_trigger');
            } else {
                $ensaf_post_details_share_options = false;
                $ensaf_display_post_tags = false;
                $ensaf_author_options = false;
            }
            
            $ensaf_post_tag = get_the_tags();
            
            if( ! empty( $ensaf_display_post_tags ) || ( ! empty($ensaf_post_details_share_options )) ){
                echo '<div class="share-links clearfix">';
                    echo '<div class="row justify-content-between">';
                        if( is_array( $ensaf_post_tag ) && ! empty( $ensaf_post_tag ) ){
                            if( count( $ensaf_post_tag ) > 1 ){
                                $tag_text = __( 'Tags:', 'ensaf' );
                            }else{
                                $tag_text = __( 'Tag:', 'ensaf' );
                            }
                            if($ensaf_display_post_tags){
                                echo '<div class="col-md-auto">';
                                    echo '<span class="share-links-title">'.esc_html($tag_text).'</span>';
                                    echo '<div class="tagcloud">';
                                        foreach( $ensaf_post_tag as $tags ){
                                            echo '<a href="'.esc_url( get_tag_link( $tags->term_id ) ).'">'.esc_html( $tags->name ).'</a>';
                                        }
                                    echo '</div>';
                                echo '</div>';
                            }
                        }
    
                        /**
                        *
                        * Hook for Blog Details Share Options
                        *
                        * Hook ensaf_blog_details_share_options
                        *
                        * @Hooked ensaf_blog_details_share_options_cb 10
                        *
                        */
                        do_action( 'ensaf_blog_details_share_options' );
    
                    echo '</div>';
    
                echo '</div>';    
            }  
        
        echo '</div>';

    echo '</div>'; 

        /**
        *
        * Hook for Post Navigation
        *
        * Hook ensaf_blog_details_post_navigation
        *
        * @Hooked ensaf_blog_details_post_navigation_cb 10
        *
        */
        do_action( 'ensaf_blog_details_post_navigation' );

        /**
        *
        * Hook for Blog Authro Bio
        *
        * Hook ensaf_blog_details_author_bio
        *
        * @Hooked ensaf_blog_details_author_bio_cb 10
        *
        */
        do_action( 'ensaf_blog_details_author_bio' );

        /**
        *
        * Hook for Blog Details Comments
        *
        * Hook ensaf_blog_details_comments
        *
        * @Hooked ensaf_blog_details_comments_cb 10
        *
        */
        do_action( 'ensaf_blog_details_comments' );
