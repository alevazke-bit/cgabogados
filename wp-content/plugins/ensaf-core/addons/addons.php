<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Ensaf Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */

final class Ensaf_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';


	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */

	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}


		// Add Plugin actions

		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );


        // Register widget scripts

		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);


		// Specific Register widget scripts

		// add_action( 'elementor/frontend/after_register_scripts', [ $this, 'ensaf_regsiter_widget_scripts' ] );
		// add_action( 'elementor/frontend/before_register_scripts', [ $this, 'ensaf_regsiter_widget_scripts' ] );


        // category register

		add_action( 'elementor/elements/categories_registered',[ $this, 'ensaf_elementor_widget_categories' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'ensaf' ),
			'<strong>' . esc_html__( 'Ensaf Core', 'ensaf' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ensaf' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */

			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ensaf' ),
			'<strong>' . esc_html__( 'Ensaf Core', 'ensaf' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ensaf' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(

			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ensaf' ),
			'<strong>' . esc_html__( 'Ensaf Core', 'ensaf' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'ensaf' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function init_widgets() {

		$widget_register = \Elementor\Plugin::instance()->widgets_manager;

		// Header Include file & Widget Register
		require_once( ENSAF_ADDONS . '/header/header.php' );
		require_once( ENSAF_ADDONS . '/header/header2.php' );
		require_once( ENSAF_ADDONS . '/header/ensaf-megamenu.php' );

		$widget_register->register ( new \Ensaf_Header() );
		$widget_register->register ( new \Ensaf_Header2() );
		$widget_register->register ( new \Ensaf_Megamenu() );


		// Include All Widget Files
		foreach($this->Ensaf_Include_File() as $widget_file_name){
			require_once( ENSAF_ADDONS . '/widgets/ensaf-'."$widget_file_name".'.php' );
		}
		// All Widget Register
		foreach($this->Ensaf_Register_File() as $name){
			$widget_register->register ( $name );
		}
		
	}

	public function Ensaf_Include_File(){
		return [
			'banner', 
			'banner2', 
			'section-title', 
			'button', 
			'blog', 
			'service', 
			'testimonial', 
			'team', 
			'team-info', 
			'image', 
			'contact-info', 
			'contact-form', 
			'counterup', 
			'faq', 
			'client-logo', 
			'cta', 
			'gallery', 
			// 'info-box', 
			'newsletter', 
			'menu-select',
			'footer-widgets',

			'before-after',

			'social',
			'animated-shape', 
			'arrows', 
			'tab-builder', 
			'skill', 
			'step', 
			'features', 
			'video', 
			'price',
			'project',
			'project-info',
			'choose-us',
			'service-list',
			'award',
			'about',
			'history',
			'review-box'
		];
	}

	public function Ensaf_Register_File(){
		return [
			new \Ensaf_Banner1(),
			new \Ensaf_Banner2(),
			new \Ensaf_Section_Title(),
			new \Ensaf_Button(),
			new \Ensaf_Blog(),
			new \Ensaf_Service(),
			new \Ensaf_Testimonial(),
			new \Ensaf_Team(),
			new \Ensaf_Team_info(),
			new \Ensaf_Image(),
			new \Ensaf_Contact_Info(),
			new \Ensaf_Contact_Form(),
			new \Ensaf_Counterup(),
			new \Ensaf_Faq(),
			new \Ensaf_Client_Logos(), 
			new \Ensaf_Cta(),
			new \Ensaf_Gallery(),
			// new \Ensaf_Info_Box(),
			new \ensaf_Newsletter(),
			new \Ensaf_Menu(),
			new \Ensaf_Footer_Widgets(),

			new \Ensaf_Before_After(),
			new \Ensaf_Social(),
			new \Ensaf_Social(),
			new \Ensaf_Animated_Shape(),
			new \Ensaf_Arrows(),
			new \Ensaf_Tab_Builder(),
			new \ensaf_Skill(),
			new \ensaf_Step(),
			new \Ensaf_Features(),
			new \ensaf_Video(),
			new \Ensaf_Price(),
			new \Ensaf_Project(), 
			new \Ensaf_project_List(), 
			new \ensaf_Choose_Us(),
			new \Ensaf_Service_List(),
			new \Ensaf_Award(),
			new \Ensaf_About(),
			new \Ensaf_History(),
			new \Ensaf_Review_Box()


		];
	}

    public function widget_scripts() {

        // wp_enqueue_script(
        //     'ensaf-frontend-script',
        //     ENSAF_PLUGDIRURI . 'assets/js/ensaf-frontend.js',
        //     array('jquery'),
        //     false,
        //     true
		// );

	}


    function ensaf_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'ensaf',
            [
                'title' => __( 'Ensaf', 'ensaf' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

        $elements_manager->add_category(
            'ensaf_footer_elements',
            [
                'title' => __( 'Ensaf Footer Elements', 'ensaf' ),
                'icon' 	=> 'fa fa-plug',
            ]
		);

		$elements_manager->add_category(
            'ensaf_header_elements',
            [
                'title' => __( 'Ensaf Header Elements', 'ensaf' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );
	}
}

Ensaf_Extension::instance();