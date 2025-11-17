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

/**
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/ensaf-constants.php';

//theme setup
require_once ENSAF_DIR_PATH_INC . 'theme-setup.php';

//essential scripts
require_once ENSAF_DIR_PATH_INC . 'essential-scripts.php';

// Woo Hooks
require_once ENSAF_DIR_PATH_INC . 'woo-hooks/ensaf-woo-hooks.php';

// Woo Hooks Functions
require_once ENSAF_DIR_PATH_INC . 'woo-hooks/ensaf-woo-hooks-functions.php';

// plugin activation
require_once ENSAF_DIR_PATH_FRAM . 'plugins-activation/ensaf-active-plugins.php';

// theme dynamic css
require_once ENSAF_DIR_PATH_INC . 'ensaf-commoncss.php';

// meta options
require_once ENSAF_DIR_PATH_FRAM . 'ensaf-meta/ensaf-config.php';

// page breadcrumbs
require_once ENSAF_DIR_PATH_INC . 'ensaf-breadcrumbs.php';

// sidebar register
require_once ENSAF_DIR_PATH_INC . 'ensaf-widgets-reg.php';

//essential functions
require_once ENSAF_DIR_PATH_INC . 'ensaf-functions.php';

// helper function
require_once ENSAF_DIR_PATH_INC . 'wp-html-helper.php';

// Demo Data
require_once ENSAF_DEMO_DIR_PATH . 'demo-import.php';

// pagination
require_once ENSAF_DIR_PATH_INC . 'wp_bootstrap_pagination.php';

// ensaf options
require_once ENSAF_DIR_PATH_FRAM . 'ensaf-options/ensaf-options.php';

// hooks
require_once ENSAF_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once ENSAF_DIR_PATH_HOOKS . 'hooks-functions.php'; 


add_action('wp_ajax_update_cart_count', 'update_cart_count');
add_action('wp_ajax_nopriv_update_cart_count', 'update_cart_count');

function update_cart_count() {
    if (class_exists('woocommerce')) {
        global $woocommerce;
        $product_id = intval($_POST['product_id']);
        $woocommerce->cart->add_to_cart($product_id); // Add the product to the cart

        $cart_count = $woocommerce->cart->cart_contents_count;
        echo esc_html($cart_count);
    }
    wp_die();
}

