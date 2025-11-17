<?php
/**
 *
 * @Packge      Ensaf 
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 * @version     1.0
 *
 */

/** 
 * Enqueue style of child theme  
 */
function ensaf_child_enqueue_styles() {

    wp_enqueue_style( 'ensaf-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'ensaf-child-style', get_stylesheet_directory_uri() . '/style.css',array( 'ensaf-style' ),wp_get_theme()->get('Version'));
}
add_action( 'wp_enqueue_scripts', 'ensaf_child_enqueue_styles', 100000 );   

add_action('wpcf7_before_send_mail', 'enviar_correo_resend');
function enviar_correo_resend($contact_form) {
    $submission = WPCF7_Submission::get_instance();
    
    if ($submission) {
        $datos = $submission->get_posted_data();
        
        $nombre = sanitize_text_field($datos['text-65']);
        $telefono = sanitize_text_field($datos['number-66']);
        $email = sanitize_email($datos['email-67']);
        $servicio = is_array($datos['select-68']) ? implode(', ', $datos['select-68']) : $datos['select-68'];
        $mensaje = sanitize_textarea_field($datos['textarea-69']);

        // Configurar los datos para la API de Resend
        $resend_api_key = 're_i74DwQqX_B4GHJDgsCPhNeMZ3HNYn1FQK';
        $email_destino = 'joscalle98@gmail.com';

        $data = [
            'from' => 'WEB CGAbogados <onboarding@resend.dev>',
            'to' => [$email_destino],
            'subject' => 'Nuevo mensaje de contacto',
            'html' => "<p><strong>Nombre:</strong> $nombre</p>
                       <p><strong>Teléfono:</strong> $telefono</p>
                       <p><strong>Correo:</strong> $email</p>
                       <p><strong>Servicio:</strong> $servicio</p>
                       <p><strong>Mensaje:</strong> $mensaje</p>"
        ];

        // Enviar el correo con la API de Resend
        $response = wp_remote_post('https://api.resend.com/emails', [
            'method'    => 'POST',
            'headers'   => [
                'Authorization' => 'Bearer ' . $resend_api_key,
                'Content-Type'  => 'application/json',
            ],
            'body'      => json_encode($data),
            'data_format' => 'body',
        ]);

        if (is_wp_error($response)) {
            error_log('Error enviando email con Resend: ' . $response->get_error_message());
        } else {
            $response_body = wp_remote_retrieve_body($response);
            error_log('Respuesta de Resend: ' . $response_body); // Depuración
        }
    }
}