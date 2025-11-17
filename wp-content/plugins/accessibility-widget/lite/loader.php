<?php
/**
 * Initialize the plugin.
 */

if ( ! function_exists( 'rf_define_constants' ) ) {
	/**
	 * Return parsed URL
	 *
	 * @return void
	 */
	function rf_define_constants() {
	}
}

rf_define_constants();

require_once CY_A11Y_PLUGIN_BASEPATH . 'class-autoloader.php';

$autoloader = new \CookieYes\AccessibilityWidget\Lite\Autoloader();
$autoloader->register();

// register_activation_hook( __FILE__, array( \CookieYes\AccessibilityWidget\Lite\Includes\Activator::get_instance(), 'install' ) );

$cya11y_loader = new \CookieYes\AccessibilityWidget\Lite\Includes\Base();
$cya11y_loader->run();
