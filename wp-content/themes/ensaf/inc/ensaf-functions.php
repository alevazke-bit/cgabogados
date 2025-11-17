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
    exit;
}

//register_block_style/register_block_pattern 
if (!function_exists('ensaf_get_nav_menu')) :
    function ensaf_get_nav_menu()
    {
        $menu_list = get_terms(array(
            'taxonomy' => 'nav_menu',
            'hide_empty' => true,
        ));
        $options = [];
        if (!empty($menu_list) && !is_wp_error($menu_list)) {
            foreach ($menu_list as $menu) {
                $options[$menu->slug] = $menu->name;
            }
            return $options;
        }
    }
endif;

if (function_exists('register_block_style')) {
    register_block_style(
        'core/quote',
        array(
            'name'         => 'blue-quote',
            'label'        => __('Blue Quote', 'ensaf'),
            'is_default'   => true,
            'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
        )
    );
}

 // theme option callback
function ensaf_opt( $id = null, $url = null ){
    global $ensaf_opt;

    if( $id && $url ){

        if( isset( $ensaf_opt[$id][$url] ) && $ensaf_opt[$id][$url] ){
            return $ensaf_opt[$id][$url];
        }
    }else{
        if( isset( $ensaf_opt[$id] )  && $ensaf_opt[$id] ){ 
            return $ensaf_opt[$id];
        }
    }
}


// theme logo
function ensaf_theme_logo() {
    // escaping allow html
    $allowhtml = array(
        'a'    => array(
            'href' => array()
        ),
        'span' => array(),
        'i'    => array(
            'class' => array()
        )
    );
    $siteUrl = home_url('/');
    if( has_custom_logo() ) {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $siteLogo = '';
        $siteLogo .= '<a class="logo" href="'.esc_url( $siteUrl ).'">';
        $siteLogo .= ensaf_img_tag( array(
            "class" => "img-fluid",
            "url"   => esc_url( wp_get_attachment_image_url( $custom_logo_id, 'full') )
        ) );
        $siteLogo .= '</a>';

        return $siteLogo;
    } elseif( !ensaf_opt('ensaf_text_title') && ensaf_opt('ensaf_site_logo', 'url' )  ){

        $siteLogo = '<img class="img-fluid" src="'.esc_url( ensaf_opt('ensaf_site_logo', 'url' ) ).'" alt="'.esc_attr__( 'logo', 'ensaf' ).'" />';
        return '<a class="logo" href="'.esc_url( $siteUrl ).'">'.$siteLogo.'</a>';


    }elseif( ensaf_opt('ensaf_text_title') ){
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.wp_kses( ensaf_opt('ensaf_text_title'), $allowhtml ).'</a></h2>';
    }else{
        return '<h2 class="mb-0"><a class="logo" href="'.esc_url( $siteUrl ).'">'.esc_html( get_bloginfo('name') ).'</a></h2>';
    }
}

// custom meta id callback
function ensaf_meta( $id = '' ){
    $value = get_post_meta( get_the_ID(), '_ensaf_'.$id, true );
    return $value;
}


// Blog Date Permalink
function ensaf_blog_date_permalink() {
    $year  = get_the_time('Y');
    $month_link = get_the_time('m');
    $day   = get_the_time('d');
    $link = get_day_link( $year, $month_link, $day);
    return $link;
}

//audio format iframe match
function ensaf_iframe_match() {
    $audio_content = ensaf_embedded_media( array('audio', 'iframe') );
    $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
    return $iframe_match;
}


//Post embedded media
function ensaf_embedded_media( $type = array() ){
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );


    if( in_array( 'audio' , $type) ){
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }

    }else{
        if( count( $embed ) > 0 ){
            $output = $embed[0];
        }else{
           $output = '';
        }
    }
    return $output;
}


// WP post link pages
function ensaf_link_pages(){
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'ensaf' ) . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
        'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'ensaf' ) . ' </span>%',
        'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}


// Data Background image attr
function ensaf_data_bg_attr( $imgUrl = '' ){
    return 'data-bg-img="'.esc_url( $imgUrl ).'"';
}

// image alt tag
function ensaf_image_alt( $url = '' ){
    if( $url != '' ){
        // attachment id by url
        $attachmentid = attachment_url_to_postid( esc_url( $url ) );
       // attachment alt tag
        $image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );
        if( $image_alt ){
            return $image_alt ;
        }else{
            $filename = pathinfo( esc_url( $url ) );
            $alt = str_replace( '-', ' ', $filename['filename'] );
            return $alt;
        }
    }else{
       return;
    }
}


// Flat Content wysiwyg output with meta key and post id

function ensaf_get_textareahtml_output( $content ) {
    global $wp_embed;

    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = wpautop( $content );
    $content = do_shortcode( $content );

    return $content;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */

function ensaf_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'ensaf_pingback_header' );


// Excerpt More
function ensaf_excerpt_more( $more ) {
    return '...';
}

add_filter( 'excerpt_more', 'ensaf_excerpt_more' );


// ensaf comment template callback
function ensaf_comment_callback( $comment, $args, $depth ) {
        $add_below = 'comment';
    ?>
    <li <?php comment_class( array('th-comment-item') ); ?>>
        <div id="comment-<?php comment_ID() ?>" class="th-post-comment">
            <?php
                if( get_avatar( $comment, 100 )  ) :
            ?>
            <!-- Author Image -->
            <div class="comment-avater">
                <?php
                    if ( $args['avatar_size'] != 0 ) {
                        echo get_avatar( $comment, 110 );
                    }
                ?>
            </div>
            <!-- Author Image -->
            <?php endif; ?>
            <!-- Comment Content -->
            <div class="comment-content">
                <span class="commented-on"><?php printf( esc_html__('%1$s', 'ensaf'), get_comment_date() ); ?></span>
                <h3 class="name"><?php echo esc_html( ucwords( get_comment_author() ) ); ?></h3>
                <p class="text"><?php echo get_comment_text(); ?></p>
                <div class="reply_and_edit">
                    <?php
                        $reply_text = wp_kses_post( 'Reply <i class="fa-sharp fa-light fa-reply"></i>', 'ensaf' );

                        $edit_reply_text = wp_kses_post( '<i class="fas fa-pencil-alt"></i> Edit', 'ensaf' );

                        comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 3, 'max_depth' => 5, 'reply_text' => $reply_text ) ) );
                    ?>  
                </div>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'ensaf' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <!-- Comment Content -->
<?php
}

//body class
add_filter( 'body_class', 'ensaf_body_class' );
function ensaf_body_class( $classes ) {
    if( class_exists('ReduxFramework') ) {
        $ensaf_blog_single_sidebar = ensaf_opt('ensaf_blog_single_sidebar');
        if( ($ensaf_blog_single_sidebar != '2' && $ensaf_blog_single_sidebar != '3' ) || ! is_active_sidebar('ensaf-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
        $new_class = is_page() ? ensaf_meta('custom_body_class') : null;

        if ( $new_class ) {
            $classes[] = $new_class;
        }
    } else {
        if( !is_active_sidebar('ensaf-blog-sidebar') ) {
            $classes[] = 'no-sidebar';
        }
    }

    return $classes;
}

//Global Footer
function ensaf_footer_global_option(){
    // Ensaf Widget Enable Disable
    if( class_exists( 'ReduxFramework' ) ){
        $ensaf_footer_widget_enable = ensaf_opt( 'ensaf_footerwidget_enable' );
        $ensaf_footer_bottom_active = ensaf_opt( 'ensaf_disable_footer_bottom' );
    }else{
        $ensaf_footer_widget_enable = '';
        $ensaf_footer_bottom_active = '1';
    }

    if( $ensaf_footer_widget_enable == '1' || $ensaf_footer_bottom_active == '1' ){
        $bg = ensaf_opt('ensaf_footer_background', 'background-image' );
        $footer_bg = $bg ? $bg : '#';

        if( ( is_active_sidebar( 'ensaf-footer-1' ) || is_active_sidebar( 'ensaf-footer-2' ) || is_active_sidebar( 'ensaf-footer-3' ) || is_active_sidebar( 'ensaf-footer-4' ) )) {
            $class = 'footer-layout1';
        }else{
            $class = '';
        }
        
        echo '<!---footer-wrapper start-->';
        echo '<footer class="footer-wrapper '.esc_attr($class).' prebuilt-foo" data-bg-src="'.esc_url(  $footer_bg ).'">';
            if( $ensaf_footer_widget_enable == '1' ){
                if( ( is_active_sidebar( 'ensaf-footer-1' ) || is_active_sidebar( 'ensaf-footer-2' ) || is_active_sidebar( 'ensaf-footer-3' ) || is_active_sidebar( 'ensaf-footer-4' ) )) {
                    echo '<div class="widget-area">';
                        echo '<div class="container">';
                                echo '<div class="row justify-content-between">';
                                    if( is_active_sidebar( 'ensaf-footer-1' )){
                                    dynamic_sidebar( 'ensaf-footer-1' ); 
                                    }
                                    if( is_active_sidebar( 'ensaf-footer-2' )){
                                    dynamic_sidebar( 'ensaf-footer-2' ); 
                                    }
                                    if( is_active_sidebar( 'ensaf-footer-3' )){
                                    dynamic_sidebar( 'ensaf-footer-3' ); 
                                    } 
                                    if( is_active_sidebar( 'ensaf-footer-4' )){
                                    dynamic_sidebar( 'ensaf-footer-4' ); 
                                    }  
                                echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            }

            if( $ensaf_footer_bottom_active == '1' ){
                echo '<div class="copyright-wrap">';
                    echo '<div class="container text-center">';
                        echo '<p class="copyright-text">'.wp_kses_post( ensaf_opt( 'ensaf_copyright_text' ) ).'</p>';
                    echo '</div>';
                echo '</div>';
            }

        echo '</footer>';
        echo '<!---footer-wrapper end-->';
    }
}

// Social link = title / description
function ensaf_social_icon(){
    $ensaf_social_icon = ensaf_opt( 'ensaf_social_links' );
    if( ! empty( $ensaf_social_icon ) && isset( $ensaf_social_icon ) ){
        $social_item = '';
        foreach( $ensaf_social_icon as $social_icon ){
            if( !empty($social_icon['title']) ){
                $social_item .= '<a href="'.esc_url( $social_icon['url'] ).'"><i class="'.esc_attr( $social_icon['title'] ).'"></i></a>';
            }
        }
        return $social_item;
    }
}

// global header 
function ensaf_global_header_option() {

    if( class_exists( 'ReduxFramework' ) ){ 
        echo '<header class="th-header header-layout2 breadcumb-header prebuilt">';

            if(ensaf_opt('ensaf_header_sticky')){
                $sticky = '';
            }else{
                $sticky = '-no';
            }

            if(ensaf_opt('ensaf_menu_icon')){ 
                $menu_icon = '';
            }else{
                $menu_icon = 'hide-icon';
            } 
 
            //Header offcanvas
            echo ensaf_header_offcanvas();
            //Mobile menu
            echo ensaf_mobile_menu();
            //Search box
            echo ensaf_search_box();

            echo '<div class="sticky-wrapper'.esc_attr($sticky).'">';
                echo '<!-- Main Menu Area -->';
                echo '<div class="container">';
                    echo '<div class="menu-area">';
                        echo '<div class="row align-items-center justify-content-between">';
                            echo '<div class="col-auto">';
                                echo '<div class="header-logo">';
                                    echo ensaf_theme_logo();
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="col-auto">';
                                echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
                                    wp_nav_menu( array(
                                        "theme_location"    => 'primary-menu',
                                        "container"         => '',
                                        "menu_class"        => ''
                                    ) ); 
                                echo '</nav>';
                                echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
                            echo '</div>';
                            echo '<div class="col-auto d-none d-xl-block">';
                               echo '<div class="header-button">';
                                    if(!empty(ensaf_opt( 'ensaf_header_search_switcher' )) ){
                                        echo '<button type="button" class="icon-btn searchBoxToggler"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>';
                                    }
                                    if( !empty(ensaf_opt( 'ensaf_btn_text' ) ) ){
                                        echo '<a href="'.esc_url(ensaf_opt( 'ensaf_btn_url' )).'" class="th-btn">'.wp_kses_post(ensaf_opt( 'ensaf_btn_text' )).'<i class="fa-regular fa-arrow-right-long"></i></a>';
                                    }
                                    if(!empty(ensaf_opt( 'ensaf_header_offcanvas_switcher' )) ){
                                        echo '<button type="button" class="icon-btn sideMenuInfo"><i class="fa-solid fa-bars"></i></button>';
                                    }
                                echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        echo '</header>';
    }else{
        echo ensaf_global_header();
    }
}

if( ! function_exists( 'ensaf_header_menu_topbar' ) ){
    function ensaf_header_menu_topbar(){
        if( class_exists( 'ReduxFramework' ) ){
            $ensaf_header_topbar_switcher  = ensaf_opt( 'ensaf_header_topbar_switcher' );
        }else{
            $ensaf_header_topbar_switcher  = '';
        }

        if( $ensaf_header_topbar_switcher ){

            $address     = ensaf_opt( 'ensaf_topbar_address' );
            $office     = ensaf_opt( 'ensaf_topbar_office' );

            $ensaf_menu_icon1 = ensaf_opt('ensaf_menu_icon1') ?? '';
            $ensaf_menu_icon2 = ensaf_opt('ensaf_menu_icon2') ?? '';
            $ensaf_menu_icon3 = ensaf_opt('ensaf_menu_icon3') ?? '';


            echo '<div class="header-top">';
                echo '<div class="container">';
                    echo '<div class="row justify-content-center justify-content-lg-between align-items-center gy-2">';
                        echo '<div class="col-auto d-none d-lg-block">';
                            echo '<div class="header-links">';
                                echo '<ul>';
                                    if( !empty( $address ) ){
                                        echo '<li>'.wp_kses_post( $address ).'</li>';
                                    }
                                    if( !empty( $office ) ){
                                        echo '<li>'.wp_kses_post( $office ).'</li>';
                                    }
                                echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-auto">';
                            echo '<div class="header-links">';
                                echo '<ul>';
                                    if( !empty(ensaf_opt( 'ensaf_menu_text_1' ) ) ){
                                        echo '<li class="d-none d-md-inline-block">'.wp_kses_post($ensaf_menu_icon1).' <a href="'.esc_url(ensaf_opt( 'ensaf_menu_url_1' )).'">'.esc_html(ensaf_opt( 'ensaf_menu_text_1' )).'</a></li>';
                                    }
                                    if( !empty(ensaf_opt( 'ensaf_menu_text_2' ) ) ){
                                        echo '<li>'.wp_kses_post($ensaf_menu_icon2).' <a href="'.esc_url(ensaf_opt( 'ensaf_menu_url_2' )).'">'.esc_html(ensaf_opt( 'ensaf_menu_text_2' )).'</a></li>';
                                    }
                                    if( !empty(ensaf_opt( 'ensaf_menu_text_3' ) ) ){
                                        if ( is_user_logged_in() && class_exists('WooCommerce') ) {
                                            $current_user = wp_get_current_user();
                                            $username = ucwords($current_user->user_login);
                                            echo '<li>'.wp_kses_post($ensaf_menu_icon3).' <a href="'.esc_url(ensaf_opt( 'ensaf_menu_url_3' )).'">'.esc_html($username).'</a></li>';
                                        } else {
                                            echo '<li>'.wp_kses_post($ensaf_menu_icon3).' <a href="'.esc_url(ensaf_opt( 'ensaf_menu_url_3' )).'">'.esc_html(ensaf_opt( 'ensaf_menu_text_3' )).'</a></li>';
                                        }
                                    }
                                echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }
    }
}

// ensaf woocommerce breadcrumb
function ensaf_woo_breadcrumb( $args ) {
    return array(
        'delimiter'   => '',
        'wrap_before' => '<ul class="breadcumb-menu">',
        'wrap_after'  => '</ul>',
        'before'      => '<li>',
        'after'       => '</li>',
        'home'        => _x( 'Home', 'breadcrumb', 'ensaf' ),
    );
}

add_filter( 'woocommerce_breadcrumb_defaults', 'ensaf_woo_breadcrumb' );

function ensaf_custom_search_form( $class ) {
    echo '<!-- Search Form -->';

    echo '<form method="get" action="'.esc_url( home_url( '/' ) ).'" class="'.esc_attr( $class ).'">';
        echo '<label class="searchIcon">';
            echo ensaf_img_tag( array(
                "url"   => esc_url( get_theme_file_uri( '/assets/img/search-2.svg' ) ),
                "class" => "svg"
            ) );
            echo '<input value="'.esc_html( get_search_query() ).'" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'ensaf').'">';
        echo '</label>';
    echo '</form>';
    echo '<!-- End Search Form -->';
}



//Fire the wp_body_open action.
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

//Remove Tag-Clouds inline style
add_filter( 'wp_generate_tag_cloud', 'ensaf_remove_tagcloud_inline_style',10,1 );
function ensaf_remove_tagcloud_inline_style( $input ){
   return preg_replace('/ style=("|\')(.*?)("|\')/','',$input );
}

/* This code filters the Categories archive widget to include the post count inside the link */
add_filter( 'wp_list_categories', 'ensaf_cat_count_span' );
function ensaf_cat_count_span( $links ) {
    $links = str_replace('</a> (', '</a> <span class="category-number">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

/* This code filters the Archive widget to include the post count inside the link */
add_filter( 'get_archives_link', 'ensaf_archive_count_span' );
function ensaf_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="category-number">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

// Ensaf Default Header
if( ! function_exists( 'ensaf_global_header' ) ){
    function ensaf_global_header(){ ?>

        <!--Mobile menu & Search box-->
        <?php 
        echo ensaf_search_box(); 
        echo ensaf_mobile_menu();  
        
        ?>

        <!--======== Header ========-->
        <header class="th-header header-layout2 breadcumb-header unittest-header">
            <div class="not-sticky-wrapper">
                <div class="sticky-active">
                    <div class="menu-area">
                        <div class="container">
                            <div class="row gx-20 align-items-center justify-content-between">

                                <div class="col-auto">
                                    <div class="header-logo">
                                        <div class="logo-bg"></div>
                                        <?php echo ensaf_theme_logo(); ?>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <?php
                                    if( has_nav_menu( 'primary-menu' ) ) { ?>
                                        <nav class="main-menu d-none d-lg-inline-block">
                                            <?php
                                            wp_nav_menu( array(
                                                "theme_location"    => 'primary-menu',
                                                "container"         => '',
                                                "menu_class"        => ''
                                            ) ); ?>
                                        </nav>
                                    <?php } ?>                                   
                                    </nav>
                                    <button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>
                                </div>
                                <div class="col-auto d-none d-xl-block">
                                    <div class="header-button">
                                        <button type="button" class="icon-btn searchBoxToggler"><i class="far fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <?php
    }
}

//header search box
if(! function_exists('ensaf_search_box')){
    function ensaf_search_box(){
        echo '<div class="popup-search-box d-none d-lg-block">';
            echo '<button class="searchClose"><i class="fal fa-times"></i></button>';
            echo '<form method="get" action="'.esc_url( home_url( '/' ) ).'">';
                echo '<input value="'.esc_html( get_search_query() ).'" name="s" required type="search" placeholder="'.esc_attr__('What are you looking for?', 'ensaf').'">';
                echo '<button type="submit"><i class="fal fa-search"></i></button>';
            echo '</form>';
        echo '</div>';
    }
}

//header Offcanvas
if( ! function_exists( 'ensaf_header_offcanvas' ) ){
    function ensaf_header_offcanvas(){
        echo '<div class="sidemenu-wrapper sidemenu-info">';
            echo '<div class="sidemenu-content">';
                echo '<button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>';
                if(is_active_sidebar('ensaf-offcanvas')){
                    dynamic_sidebar( 'ensaf-offcanvas' );
                }else{
                    echo '<h4 class="widget_title">No Widget Added </h4>';
                    echo '<p>Please add some widget in Offcanvs Sidebar</p>';
                }
            echo '</div>';
        echo '</div>';
    }
}

//header Cart Offcanvas
if( ! function_exists( 'ensaf_header_cart_offcanvas' ) ){
    function ensaf_header_cart_offcanvas(){
        echo '<div class="sidemenu-wrapper sidemenu-cart">';
            echo '<div class="sidemenu-content">';
                echo '<button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>';
                echo '<div class="widget woocommerce widget_shopping_cart">';
                    echo '<h3 class="widget_title">'.esc_html__( 'Shopping cart', 'ensaf' ).'</h3>';
                    echo '<div class="widget_shopping_cart_content">';
                        if( class_exists( 'woocommerce' ) ){
                            echo woocommerce_mini_cart();
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}

// mobile logo
function ensaf_mobile_logo() {
    $logo_url = ensaf_opt('ensaf_mobile_logo', 'url' );
    $mobile_menu = '';
    if( !empty($logo_url )){
        $mobile_menu = '<div class="mobile-logo"><a href="'.home_url('/').'"><img src="'.esc_url($logo_url).'" alt="'.esc_attr__( 'logo', 'ensaf' ).'"></a></div>';
    }else{
        $mobile_menu .= '<div class="mobile-logo">';
        $mobile_menu .= ensaf_theme_logo();
        $mobile_menu .= '</div>';
    }

    return $mobile_menu;
 }

//header Mobile Menu
if( ! function_exists( 'ensaf_mobile_menu' ) ){
    function ensaf_mobile_menu(){
    ?>
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <?php  if( class_exists('ReduxFramework') ):?>
                <?php 
                    if(!empty(ensaf_opt('ensaf_menu_menu_show') )){
                        echo ensaf_mobile_logo(); 
                    }
                ?>
            <?php else: ?>
                <div class="mobile-logo">
                    <?php echo ensaf_theme_logo(); ?>
                </div>
            <?php endif; ?>
            <div class="th-mobile-menu">
                <?php 
                    if( has_nav_menu( 'primary-menu' ) ){
                        wp_nav_menu( array(
                            "theme_location"    => 'primary-menu',
                            "container"         => '',
                            "menu_class"        => ''
                        ) );
                    }
                ?>
            </div>
        </div>
    </div>

<?php
    }
}



// Blog post views function
function ensaf_setPostViews( $postID ) {
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    }else{
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

function ensaf_getPostViews( $postID ){
    $count_key  = 'post_views_count';
    $count      = get_post_meta( $postID, $count_key, true );
    if( $count == '' ){
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return __( '0', 'ensaf' );
    }
    return $count;
}


// Add Extra Class On Comment Reply Button
function ensaf_custom_comment_reply_link( $content ) {
    $extra_classes = 'reply-btn';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $content);
}

add_filter('comment_reply_link', 'ensaf_custom_comment_reply_link', 99);

// Add Extra Class On Edit Comment Link
function ensaf_custom_edit_comment_link( $content ) {
    $extra_classes = 'reply-btn';
    return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $extra_classes, $content);
}

add_filter('edit_comment_link', 'ensaf_custom_edit_comment_link', 99);


function ensaf_post_classes( $classes, $class, $post_id ) {
    if ( get_post_type() === 'post' ) {
        $classes[] = "th-blog blog-single has-post-thumbnail";
    }elseif( get_post_type() === 'product' ){
        // Return Class
    }elseif( get_post_type() === 'page' ){
        $classes[] = "page--item";
    }
    
    return $classes;
}
add_filter( 'post_class', 'ensaf_post_classes', 10, 3 );

// Contact form 7
add_filter('wpcf7_autop_or_not', '__return_false');