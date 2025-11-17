<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}
/**
 * @Packge     : Ensaf
 * @Version    : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 *
*/

// enqueue css
function ensaf_common_custom_css(){
	wp_enqueue_style( 'ensaf-color-schemes', get_template_directory_uri().'/assets/css/color.schemes.css' );

    $CustomCssOpt  = ensaf_opt( 'ensaf_css_editor' );
	if( $CustomCssOpt ){
		$CustomCssOpt = $CustomCssOpt;
	}else{
		$CustomCssOpt = '';
	}

    $customcss = "";
    
    if( get_header_image() ){
        $ensaf_header_bg =  get_header_image();
    }else{
        if( ensaf_meta( 'page_breadcrumb_settings' ) == 'page' ){
            if( ! empty( ensaf_meta( 'breadcumb_image' ) ) ){
                $ensaf_header_bg = ensaf_meta( 'breadcumb_image' );
            }
        }
    }
    
    if( !empty( $ensaf_header_bg ) ){
        $customcss .= ".breadcumb-wrapper{
            background-image:url('{$ensaf_header_bg}')!important;
        }";
    }
    
	// Theme color
	$ensafthemecolor = ensaf_opt('ensaf_theme_color'); 
    if( !empty( $ensafthemecolor ) ){
        list($r, $g, $b) = sscanf( $ensafthemecolor, "#%02x%02x%02x");

        $ensaf_real_color = $r.','.$g.','.$b;
        if( !empty( $ensafthemecolor ) ) {
            $customcss .= ":root {
            --theme-color: rgb({$ensaf_real_color});
            }";
        }
    }

	// Theme color 2
	$ensafthemecolor2 = ensaf_opt('ensaf_theme_color2'); 
    if( !empty( $ensafthemecolor2 ) ){
        list($r, $g, $b) = sscanf( $ensafthemecolor2, "#%02x%02x%02x");

        $ensaf_real_color2 = $r.','.$g.','.$b;
        if( !empty( $ensafthemecolor2 ) ) {
            $customcss .= ":root {
            --theme-color2: rgb({$ensaf_real_color2});
            }";
        }
    }

    // Heading  color
	$ensafheadingcolor = ensaf_opt('ensaf_heading_color');
    if( !empty( $ensafheadingcolor ) ){
        list($r, $g, $b) = sscanf( $ensafheadingcolor, "#%02x%02x%02x");

        $ensaf_real_color = $r.','.$g.','.$b;
        if( !empty( $ensafheadingcolor ) ) {
            $customcss .= ":root {
                --title-color: rgb({$ensaf_real_color});
            }";
        }
    }
    // Body color
	$ensafbodycolor = ensaf_opt('ensaf_body_color');
    if( !empty( $ensafbodycolor ) ){
        list($r, $g, $b) = sscanf( $ensafbodycolor, "#%02x%02x%02x");

        $ensaf_real_color = $r.','.$g.','.$b;
        if( !empty( $ensafbodycolor ) ) {
            $customcss .= ":root {
                --body-color: rgb({$ensaf_real_color});
            }";
        }
    }
    // White color
	$ensafwhitecolor = ensaf_opt('ensaf_white_color');
    if( !empty( $ensafwhitecolor ) ){
        list($r, $g, $b) = sscanf( $ensafwhitecolor, "#%02x%02x%02x");

        $ensaf_real_color = $r.','.$g.','.$b;
        if( !empty( $ensafwhitecolor ) ) {
            $customcss .= ":root {
                --white-color: rgb({$ensaf_real_color});
            }";
        }
    }

     // Body font
     $ensafbodyfont = ensaf_opt('ensaf_theme_body_font', 'font-family');
     if( !empty( $ensafbodyfont ) ) {
         $customcss .= ":root {
             --body-font: $ensafbodyfont ;
         }";
     }
 
     // Heading font
     $ensafheadingfont = ensaf_opt('ensaf_theme_heading_font', 'font-family');
     if( !empty( $ensafheadingfont ) ) {
         $customcss .= ":root {
             --title-font: $ensafheadingfont ;
         }";
     }


    if(ensaf_opt('ensaf_menu_icon_class')){
        $menu_icon_class = ensaf_opt( 'ensaf_menu_icon_class' );
    }else{
        $menu_icon_class = 'f24e';
    }

    if( !empty( $menu_icon_class ) ) {
        $customcss .= ".main-menu ul.sub-menu li a:before {
                content: \"\\$menu_icon_class\" !important;
            }";
    }

	if( !empty( $CustomCssOpt ) ){
		$customcss .= $CustomCssOpt;
	}

    wp_add_inline_style( 'ensaf-color-schemes', $customcss );
}
add_action( 'wp_enqueue_scripts', 'ensaf_common_custom_css', 100 );