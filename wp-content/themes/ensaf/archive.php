<?php
/**
 * @Packge     : Ensaf
 * @Version    : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 *
*/

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}   
    // Header
    get_header();

    /**
    * 
    * Hook for Blog Start Wrapper
    *
    * Hook ensaf_blog_start_wrap
    *
    * @Hooked ensaf_blog_start_wrap_cb 10
    *  
    */
    do_action( 'ensaf_blog_start_wrap' );

    /**
    * 
    * Hook for Blog Column Start Wrapper
    *
    * Hook ensaf_blog_col_start_wrap
    *
    * @Hooked ensaf_blog_col_start_wrap_cb 10
    *  
    */
    do_action( 'ensaf_blog_col_start_wrap' );

    /**
    * 
    * Hook for Blog Content
    *
    * Hook ensaf_blog_content
    *
    * @Hooked ensaf_blog_content_cb 10
    *  
    */
    do_action( 'ensaf_blog_content' );

    /**
    * 
    * Hook for Blog Pagination
    *
    * Hook ensaf_blog_pagination
    *
    * @Hooked ensaf_blog_pagination_cb 10
    *  
    */
    do_action( 'ensaf_blog_pagination' ); 

    /**
    * 
    * Hook for Blog Column End Wrapper
    *
    * Hook ensaf_blog_col_end_wrap
    *
    * @Hooked ensaf_blog_col_end_wrap_cb 10
    *  
    */
    do_action( 'ensaf_blog_col_end_wrap' ); 

    /**
    * 
    * Hook for Blog Sidebar
    *
    * Hook ensaf_blog_sidebar
    *
    * @Hooked ensaf_blog_sidebar_cb 10
    *  
    */
    do_action( 'ensaf_blog_sidebar' );     
        
    /**
    * 
    * Hook for Blog End Wrapper
    *
    * Hook ensaf_blog_end_wrap
    *
    * @Hooked ensaf_blog_end_wrap_cb 10
    *  
    */
    do_action( 'ensaf_blog_end_wrap' );

    //footer
    get_footer();