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

    if( class_exists( 'ReduxFramework' ) ) {
        $ensaf404title     = ensaf_opt( 'ensaf_error_title' ); 
        $ensaf404description  = ensaf_opt( 'ensaf_error_description' );
        $ensaf404btntext      = ensaf_opt( 'ensaf_error_btn_text' );
    } else {
        $ensaf404title     = __( 'Opp’s That Page Can’t be Found', 'ensaf' );
        $ensaf404description  = __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ensaf' );
        $ensaf404btntext      = __( 'Back To Home', 'ensaf');

    }

    // get header //
    get_header(); 

    if(!empty(ensaf_opt('ensaf_error_bg', 'url' ) )){
        $bg_url = ensaf_opt('ensaf_error_bg', 'url' );
    }else{
        $bg_url = '';
    }
    
        echo '<div class="space">';
            echo '<div class="container">';
                echo '<div class="error-img">';
                    if(!empty(ensaf_opt('ensaf_error_img', 'url' ) )){
                        echo '<img src="'.esc_url( ensaf_opt('ensaf_error_img', 'url' ) ).'" alt="'.esc_attr__('404 image', 'ensaf').'">';
                    }else{
                        echo '<img src="'.get_template_directory_uri().'/assets/img/error.svg" alt="'.esc_attr__('404 image', 'ensaf').'">';
                    }
                echo '</div>';
                echo '<div class="error-content">';
                    if(!empty($ensaf404title)){
                        echo '<h2 class="error-title">'.wp_kses_post( $ensaf404title ).'</h2>';
                    }
                    if(!empty($ensaf404description)){
                        echo '<p class="error-text">'.esc_html( $ensaf404description ).'</p>';
                    }
                    echo '<a href="'.esc_url( home_url('/') ).'" class="th-btn style2 error-btn"><i class="fal fa-home me-2"></i>'.esc_html( $ensaf404btntext ).'</a>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

    //footer
    get_footer();