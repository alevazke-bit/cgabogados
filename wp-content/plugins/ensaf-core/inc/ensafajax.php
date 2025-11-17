<?php
/**
 * @Packge     : Ensaf
 * @Version    : 1.0
 * @Author     : Themehour
 * @Author URI : https://themeforest.net/user/themehour
 *
 */


// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

function ensaf_core_essential_scripts( ) {
    wp_enqueue_script('ensaf-ajax',ENSAF_PLUGDIRURI.'assets/js/ensaf.ajax.js',array( 'jquery' ),'1.0',true);
    wp_localize_script(
    'ensaf-ajax',
    'ensafajax',
        array(
            'action_url' => admin_url( 'admin-ajax.php' ),
            'nonce'	     => wp_create_nonce( 'ensaf-nonce' ),
        )
    );
}

add_action('wp_enqueue_scripts','ensaf_core_essential_scripts');


// ensaf Section subscribe ajax callback function
add_action( 'wp_ajax_ensaf_subscribe_ajax', 'ensaf_subscribe_ajax' );
add_action( 'wp_ajax_nopriv_ensaf_subscribe_ajax', 'ensaf_subscribe_ajax' );

function ensaf_subscribe_ajax( ){
  $apiKey = ensaf_opt('ensaf_subscribe_apikey');
  $listid = ensaf_opt('ensaf_subscribe_listid');
   if( ! wp_verify_nonce($_POST['security'], 'ensaf-nonce') ) {
    echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('You are not allowed.', 'ensaf').'</div>';
   }else{
       if( !empty( $apiKey ) && !empty( $listid )  ){
           $MailChimp = new DrewM\MailChimp\MailChimp( $apiKey );

           $result = $MailChimp->post("lists/{$listid}/members",[
               'email_address'    => esc_attr( $_POST['sectsubscribe_email'] ),
               'status'           => 'subscribed',
           ]);

           if ($MailChimp->success()) {
               if( $result['status'] == 'subscribed' ){
                   echo '<div class="alert alert-success mt-2" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'ensaf').'</div>';
               }
           }elseif( $result['status'] == '400' ) {
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('This Email address is already exists.', 'ensaf').'</div>';
           }else{
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Sorry something went wrong.', 'ensaf').'</div>';
           }
        }else{
           echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Apikey Or Listid Missing.', 'ensaf').'</div>';
        }
   }

   wp_die();

}

add_action('wp_ajax_ensaf_addtocart_notification','ensaf_addtocart_notification');
add_action('wp_ajax_nopriv_ensaf_addtocart_notification','ensaf_addtocart_notification');
function ensaf_addtocart_notification(){

    $_product = wc_get_product($_POST['prodid']);
    $response = [
        'img_url'   => esc_url( wp_get_attachment_image_src( $_product->get_image_id(),array('60','60'))[0] ),
        'title'     => wp_kses_post( $_product->get_title() )
    ];
    echo json_encode($response);

    wp_die();
}