<?php
/**
 * @Packge     : Ensaf
 * @Version    : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 *
*/

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * Define constant 
 *
 */

// Base URI
if ( ! defined( 'ENSAF_DIR_URI' ) ) {
    define('ENSAF_DIR_URI', get_parent_theme_file_uri().'/' );
}

// Assist URI
if ( ! defined( 'ENSAF_DIR_ASSIST_URI' ) ) {
    define( 'ENSAF_DIR_ASSIST_URI', get_theme_file_uri('/assets/') );
}


// Css File URI
if ( ! defined( 'ENSAF_DIR_CSS_URI' ) ) {
    define( 'ENSAF_DIR_CSS_URI', get_theme_file_uri('/assets/css/') );
}

// Js File URI
if (!defined('ENSAF_DIR_JS_URI')) {
    define('ENSAF_DIR_JS_URI', get_theme_file_uri('/assets/js/'));
}


// Base Directory
if (!defined('ENSAF_DIR_PATH')) {
    define('ENSAF_DIR_PATH', get_parent_theme_file_path() . '/');
}

//Inc Folder Directory
if (!defined('ENSAF_DIR_PATH_INC')) {
    define('ENSAF_DIR_PATH_INC', ENSAF_DIR_PATH . 'inc/');
}

//ENSAF framework Folder Directory
if (!defined('ENSAF_DIR_PATH_FRAM')) {
    define('ENSAF_DIR_PATH_FRAM', ENSAF_DIR_PATH_INC . 'ensaf-framework/');
}

//Hooks Folder Directory
if (!defined('ENSAF_DIR_PATH_HOOKS')) {
    define('ENSAF_DIR_PATH_HOOKS', ENSAF_DIR_PATH_INC . 'hooks/');
}

//Demo Data Folder Directory Path
if( !defined( 'ENSAF_DEMO_DIR_PATH' ) ){
    define( 'ENSAF_DEMO_DIR_PATH', ENSAF_DIR_PATH_INC.'demo-data/' );
}
    
//Demo Data Folder Directory URI
if( !defined( 'ENSAF_DEMO_DIR_URI' ) ){
    define( 'ENSAF_DEMO_DIR_URI', ENSAF_DIR_URI.'inc/demo-data/' );
}