<?php
/**
 * Utility functions class
 *
 * @link       https://www.cookieyes.com/
 * @since      3.0.0
 *
 * @author     CookieYes <info@cookieyes.com>
 * @package    CookieYes\AccessibilityWidget\Lite\Includes
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! function_exists( 'cya11y_parse_url' ) ) {
	/**
	 * Return parsed URL
	 *
	 * @param string $url URL string to be parsed.
	 * @return array URL parts.
	 */
	function cya11y_parse_url( $url ) {
		return function_exists( 'wp_parse_url' )
			? wp_parse_url( $url )
			: parse_url( $url ); // phpcs:ignore WordPress.WP.AlternativeFunctions.parse_url_parse_url
	}
}

if ( ! function_exists( 'cya11y_is_admin_request' ) ) {
	/**
	 * Get localized date.
	 *
	 * @return boolean
	 */
	function cya11y_is_admin_request() {
		return is_admin() && ! cya11y_is_ajax_request();
	}
}
if ( ! function_exists( 'cya11y_is_ajax_request' ) ) {
	/**
	 * Get localized date.
	 *
	 * @return boolean
	 */
	function cya11y_is_ajax_request() {
		if ( function_exists( 'wp_doing_ajax' ) ) {
			return wp_doing_ajax();
		} else {
			return ( defined( 'DOING_AJAX' ) && DOING_AJAX );
		}
	}
}
if ( ! function_exists( 'cya11y_is_rest_request' ) ) {

	/**
	 * Check if a request is a rest request
	 *
	 * @return boolean
	 */
	function cya11y_is_rest_request() {
		if ( empty( $_SERVER['REQUEST_URI'] ) ) {
			return false;
		}
		$rest_prefix = trailingslashit( rest_get_url_prefix() );
		$request     = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : false;
		if ( ! $request ) {
			return false;
		}
		$is_rest_api_request = ( false !== strpos( $request, $rest_prefix ) );

		return apply_filters( 'cya11y_is_rest_api_request', $is_rest_api_request );
	}
}
if ( ! function_exists( 'cya11y_is_cloud_request' ) ) {

	/**
	 * Check if a request is a rest request
	 *
	 * @return boolean
	 */
	function cya11y_is_cloud_request() {
		return ( defined( 'CYA11Y_CLOUD_REQUEST' ) && CYA11Y_CLOUD_REQUEST );
	}
}
if ( ! function_exists( 'cya11y_array_search' ) ) {

	/**
	 * Get settings of element from banner properties by using the tag "data-cya11y-tag"
	 *
	 * @param array  $array Array to be searched.
	 * @param string $key Tag to be used for searching.
	 * @param string $value  Tag name.
	 * @return array
	 */
	function cya11y_array_search( $array = array(), $key = '', $value = '' ) {

		$results = array();
		if ( is_array( $array ) ) {
			if ( isset( $array[ $key ] ) && $array[ $key ] === $value ) {
				$results = $array;
			}
			foreach ( $array as $sub_array ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
				$results = array_merge( $results, cya11y_array_search( $sub_array, $key, $value ) );
			}
		}
		return $results;
	}
}
if ( ! function_exists( 'cya11y_first_time_install' ) ) {

	/**
	 * Check if the plugin is activated for the first time.
	 *
	 * @return boolean
	 */
	function cya11y_first_time_install() {
		return (bool) get_site_transient( 'cya11y_first_time_install' ) || (bool) get_option( 'cya11y_first_time_activated_plugin' );
	}
}

if ( ! function_exists( 'cya11y_is_admin_page' ) ) {

	/**
	 * Check if the plugin is activated for the first time.
	 *
	 * @return boolean
	 */
	function cya11y_is_admin_page() {
		if ( ! is_admin() ) {
			return false;
		}
		if ( function_exists( 'get_current_screen' ) && ! empty( get_current_screen() ) ) {
			$screen = get_current_screen();
			$page   = isset( $screen->id ) ? $screen->id : false;
			if ( false !== strpos( $page, 'accessibility-widget' ) ) {
				return true;
			}
			if ( ! empty( $screen->parent_base ) && false !== strpos( $screen->parent_base, 'accessibility-widget' ) ) {
				return true;
			}
		} else {
			$page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}
		return false !== strpos( $page, 'accessibility-widget' );
	}
}

if ( ! function_exists( 'cya11y_is_front_end_request' ) ) {

	/**
	 * Check if request coming from front-end.
	 *
	 * @return boolean
	 */
	function cya11y_is_front_end_request() {
		if ( is_admin() || cya11y_is_rest_request() || cya11y_is_ajax_request() ) {
			return false;
		}
		return true;
	}
}
if ( ! function_exists( 'cya11y_disable_banner' ) ) {

	/**
	 * Check if request coming from front-end.
	 *
	 * @return boolean
	 */
	function cya11y_disable_banner() {
		global $wp_customize;
		if ( isset( $_GET['et_fb'] ) || isset( $_GET['et_fb'] )
		|| ( defined( 'ET_FB_ENABLED' ) && ET_FB_ENABLED )
		|| isset( $_GET['elementor-preview'] )
		|| isset( $_POST['cs_preview_state'] )
		|| isset( $wp_customize ) ) {
			return true;
		}
		return false;
	}
}
if ( ! function_exists( 'cya11y_missing_tables' ) ) {

	/**
	 * Check if request coming from front-end.
	 *
	 * @return array
	 */
	function cya11y_missing_tables() {
		return get_option( 'cya11y_missing_tables', array() );
	}
}
