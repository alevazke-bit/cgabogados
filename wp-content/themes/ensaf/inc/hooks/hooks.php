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

	/**
	* Hook for preloader
	*/
	add_action( 'ensaf_preloader_wrap', 'ensaf_preloader_wrap_cb', 10 );

	/**
	* Hook for offcanvas cart
	*/
	add_action( 'ensaf_main_wrapper_start', 'ensaf_main_wrapper_start_cb', 10 );

	/**
	* Hook for Header
	*/
	add_action( 'ensaf_header', 'ensaf_header_cb', 10 );

	/**
	* Hook for Breadcrumb
	*/
	add_action( 'ensaf_breadcrumb', 'ensaf_breadcrumb_cb', 10 );
	
	/**
	* Hook for Blog Start Wrapper
	*/
	add_action( 'ensaf_blog_start_wrap', 'ensaf_blog_start_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column Start Wrapper
	*/
    add_action( 'ensaf_blog_col_start_wrap', 'ensaf_blog_col_start_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'ensaf_blog_col_end_wrap', 'ensaf_blog_col_end_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'ensaf_blog_end_wrap', 'ensaf_blog_end_wrap_cb', 10 );
	
	/**
	* Hook for Blog Pagination
	*/
    add_action( 'ensaf_blog_pagination', 'ensaf_blog_pagination_cb', 10 );
    
    /**
	* Hook for Blog Content
	*/
	add_action( 'ensaf_blog_content', 'ensaf_blog_content_cb', 10 );
    
    /**
	* Hook for Blog Sidebar
	*/
	add_action( 'ensaf_blog_sidebar', 'ensaf_blog_sidebar_cb', 10 );
    
    /**
	* Hook for Blog Details Sidebar
	*/
	add_action( 'ensaf_blog_details_sidebar', 'ensaf_blog_details_sidebar_cb', 10 );

	/**
	* Hook for Blog Details Wrapper Start
	*/
	add_action( 'ensaf_blog_details_wrapper_start', 'ensaf_blog_details_wrapper_start_cb', 10 );

	/**
	* Hook for Blog Details Post Meta
	*/
	add_action( 'ensaf_blog_post_meta', 'ensaf_blog_post_meta_cb', 10 );

	/**
	* Hook for Blog Details Post Share Options
	*/
	add_action( 'ensaf_blog_details_share_options', 'ensaf_blog_details_share_options_cb', 10 );

	/**
	* Hook for Blog Post Share Options
	*/
	add_action( 'ensaf_blog_post_share_options', 'ensaf_blog_post_share_options_cb', 10 );

	/**
	* Hook for Blog Details Post Author Bio
	*/
	add_action( 'ensaf_blog_details_author_bio', 'ensaf_blog_details_author_bio_cb', 10 );

	/**
	* Hook for Blog Details Tags and Categories
	*/
	add_action( 'ensaf_blog_details_tags_and_categories', 'ensaf_blog_details_tags_and_categories_cb', 10 );

	/**
	* Hook for Blog Details Related Post Navigation
	*/
	add_action( 'ensaf_blog_details_post_navigation', 'ensaf_blog_details_post_navigation_cb', 10 ); 

	/**
	* Hook for Blog Deatils Comments
	*/
	add_action( 'ensaf_blog_details_comments', 'ensaf_blog_details_comments_cb', 10 );

	/**
	* Hook for Blog Deatils Column Start
	*/
	add_action('ensaf_blog_details_col_start','ensaf_blog_details_col_start_cb');

	/**
	* Hook for Blog Deatils Column End
	*/
	add_action('ensaf_blog_details_col_end','ensaf_blog_details_col_end_cb');

	/**
	* Hook for Blog Deatils Wrapper End
	*/
	add_action('ensaf_blog_details_wrapper_end','ensaf_blog_details_wrapper_end_cb');
	
	/**
	* Hook for Blog Post Thumbnail
	*/
	add_action('ensaf_blog_post_thumb','ensaf_blog_post_thumb_cb');
    
	/**
	* Hook for Blog Post Content
	*/
	add_action('ensaf_blog_post_content','ensaf_blog_post_content_cb');
	
    
	/**
	* Hook for Blog Post Excerpt And Read More Button
	*/
	add_action('ensaf_blog_postexcerpt_read_content','ensaf_blog_postexcerpt_read_content_cb');
	
	/**
	* Hook for footer content
	*/
	add_action( 'ensaf_footer_content', 'ensaf_footer_content_cb', 10 );
	
	/**
	* Hook for main wrapper end
	*/
	add_action( 'ensaf_main_wrapper_end', 'ensaf_main_wrapper_end_cb', 10 );
	
	/**
	* Hook for Back to Top Button
	*/
	add_action( 'ensaf_back_to_top', 'ensaf_back_to_top_cb', 10 );

	/**
	* Hook for Page Start Wrapper
	*/
	add_action( 'ensaf_page_start_wrap', 'ensaf_page_start_wrap_cb', 10 );

	/**
	* Hook for Page End Wrapper
	*/
	add_action( 'ensaf_page_end_wrap', 'ensaf_page_end_wrap_cb', 10 );

	/**
	* Hook for Page Column Start Wrapper
	*/
	add_action( 'ensaf_page_col_start_wrap', 'ensaf_page_col_start_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'ensaf_page_col_end_wrap', 'ensaf_page_col_end_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'ensaf_page_sidebar', 'ensaf_page_sidebar_cb', 10 );

	/**
	* Hook for Page Content
	*/
	add_action( 'ensaf_page_content', 'ensaf_page_content_cb', 10 );