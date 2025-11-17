<?php
    /**
     * Class For Builder
     */
    class EnsafBuilder{

        function __construct(){
            // register admin menus
        	add_action( 'admin_menu', [$this, 'register_settings_menus'] );

            // Custom Footer Builder With Post Type
			add_action( 'init',[ $this,'post_type' ],0 );

 		    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this,'widget_scripts'] );

			add_filter( 'single_template', [ $this, 'load_canvas_template' ] );

            add_action( 'elementor/element/wp-page/document_settings/after_section_end', [ $this,'ensaf_add_elementor_page_settings_controls' ],10,2 );

		}

		public function widget_scripts( ) {
			wp_enqueue_script( 'ensaf-core',ENSAF_PLUGDIRURI.'assets/js/ensaf-core.js',array( 'jquery' ),'1.0',true );
		}


        public function ensaf_add_elementor_page_settings_controls( \Elementor\Core\DocumentTypes\Page $page ){

			$page->start_controls_section(
                'ensaf_header_option',
                [
                    'label'     => __( 'Header Option', 'ensaf' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );


            $page->add_control(
                'ensaf_header_style',
                [
                    'label'     => __( 'Header Option', 'ensaf' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'ensaf' ),
    					'header_builder'       => __( 'Header Builder', 'ensaf' ),
    				],
                    'default'   => 'prebuilt',
                ]
			);

            $page->add_control(
                'ensaf_header_builder_option',
                [
                    'label'     => __( 'Header Name', 'ensaf' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->ensaf_header_choose_option(),
                    'condition' => [ 'ensaf_header_style' => 'header_builder'],
                    'default'	=> ''
                ]
            );

            $page->end_controls_section();

            $page->start_controls_section(
                'ensaf_footer_option',
                [
                    'label'     => __( 'Footer Option', 'ensaf' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );
            $page->add_control(
    			'ensaf_footer_choice',
    			[
    				'label'         => __( 'Enable Footer?', 'ensaf' ),
    				'type'          => \Elementor\Controls_Manager::SWITCHER,
    				'label_on'      => __( 'Yes', 'ensaf' ),
    				'label_off'     => __( 'No', 'ensaf' ),
    				'return_value'  => 'yes',
    				'default'       => 'yes',
    			]
    		);
            $page->add_control(
                'ensaf_footer_style',
                [
                    'label'     => __( 'Footer Style', 'ensaf' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'ensaf' ),
    					'footer_builder'       => __( 'Footer Builder', 'ensaf' ),
    				],
                    'default'   => 'prebuilt',
                    'condition' => [ 'ensaf_footer_choice' => 'yes' ],
                ]
            );
            $page->add_control(
                'ensaf_footer_builder_option',
                [
                    'label'     => __( 'Footer Name', 'ensaf' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->ensaf_footer_build_choose_option(),
                    'condition' => [ 'ensaf_footer_style' => 'footer_builder','ensaf_footer_choice' => 'yes' ],
                    'default'	=> ''
                ]
            );

			$page->end_controls_section();

        }

		public function register_settings_menus(){
			add_menu_page(
				esc_html__( 'Ensaf Builder', 'ensaf' ),
            	esc_html__( 'Ensaf Builder', 'ensaf' ),
				'manage_options',
				'ensaf',
				[$this,'register_settings_contents__settings'],
				'dashicons-admin-site',
				2
			);

			add_submenu_page('ensaf', esc_html__('Footer Builder', 'ensaf'), esc_html__('Footer Builder', 'ensaf'), 'manage_options', 'edit.php?post_type=ensaf_footerbuild');
			add_submenu_page('ensaf', esc_html__('Header Builder', 'ensaf'), esc_html__('Header Builder', 'ensaf'), 'manage_options', 'edit.php?post_type=ensaf_header');
			add_submenu_page('ensaf', esc_html__('Tab Builder', 'ensaf'), esc_html__('Tab Builder', 'ensaf'), 'manage_options', 'edit.php?post_type=ensaf_tab_builder');
			add_submenu_page('ensaf', esc_html__('Megamenu', 'ensaf'), esc_html__('Megamenu', 'ensaf'), 'manage_options', 'edit.php?post_type=ensaf_megamenu');
		}

		// Callback Function
		public function register_settings_contents__settings(){
            echo '<h2>';
			    echo esc_html__( 'Welcome To Header And Footer Builder Of This Theme','ensaf' );
            echo '</h2>';
		}

		public function post_type() {

			$labels = array(
				'name'               => __( 'Footer', 'ensaf' ),
				'singular_name'      => __( 'Footer', 'ensaf' ),
				'menu_name'          => __( 'Ensaf Footer Builder', 'ensaf' ),
				'name_admin_bar'     => __( 'Footer', 'ensaf' ),
				'add_new'            => __( 'Add New', 'ensaf' ),
				'add_new_item'       => __( 'Add New Footer', 'ensaf' ),
				'new_item'           => __( 'New Footer', 'ensaf' ),
				'edit_item'          => __( 'Edit Footer', 'ensaf' ),
				'view_item'          => __( 'View Footer', 'ensaf' ),
				'all_items'          => __( 'All Footer', 'ensaf' ),
				'search_items'       => __( 'Search Footer', 'ensaf' ),
				'parent_item_colon'  => __( 'Parent Footer:', 'ensaf' ),
				'not_found'          => __( 'No Footer found.', 'ensaf' ),
				'not_found_in_trash' => __( 'No Footer found in Trash.', 'ensaf' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'ensaf_footerbuild', $args );

			$labels = array(
				'name'               => __( 'Header', 'ensaf' ),
				'singular_name'      => __( 'Header', 'ensaf' ),
				'menu_name'          => __( 'Ensaf Header Builder', 'ensaf' ),
				'name_admin_bar'     => __( 'Header', 'ensaf' ),
				'add_new'            => __( 'Add New', 'ensaf' ),
				'add_new_item'       => __( 'Add New Header', 'ensaf' ),
				'new_item'           => __( 'New Header', 'ensaf' ),
				'edit_item'          => __( 'Edit Header', 'ensaf' ),
				'view_item'          => __( 'View Header', 'ensaf' ),
				'all_items'          => __( 'All Header', 'ensaf' ),
				'search_items'       => __( 'Search Header', 'ensaf' ),
				'parent_item_colon'  => __( 'Parent Header:', 'ensaf' ),
				'not_found'          => __( 'No Header found.', 'ensaf' ),
				'not_found_in_trash' => __( 'No Header found in Trash.', 'ensaf' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'ensaf_header', $args );

			$labels = array(
				'name'               => __( 'Tab Builder', 'ensaf' ),
				'singular_name'      => __( 'Tab Builder', 'ensaf' ),
				'menu_name'          => __( 'Gesund Tab Builder', 'ensaf' ),
				'name_admin_bar'     => __( 'Tab Builder', 'ensaf' ),
				'add_new'            => __( 'Add New', 'ensaf' ),
				'add_new_item'       => __( 'Add New Tab Builder', 'ensaf' ),
				'new_item'           => __( 'New Tab Builder', 'ensaf' ),
				'edit_item'          => __( 'Edit Tab Builder', 'ensaf' ),
				'view_item'          => __( 'View Tab Builder', 'ensaf' ),
				'all_items'          => __( 'All Tab Builder', 'ensaf' ),
				'search_items'       => __( 'Search Tab Builder', 'ensaf' ),
				'parent_item_colon'  => __( 'Parent Tab Builder:', 'ensaf' ),
				'not_found'          => __( 'No Tab Builder found.', 'ensaf' ),
				'not_found_in_trash' => __( 'No Tab Builder found in Trash.', 'ensaf' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'ensaf_tab_builder', $args );

			$labels = array(
				'name'               => __( 'Megamenu', 'ensaf' ),
				'singular_name'      => __( 'Megamenu', 'ensaf' ),
				'menu_name'          => __( 'ensaf Megamenu', 'ensaf' ),
				'name_admin_bar'     => __( 'Megamenu', 'ensaf' ),
				'add_new'            => __( 'Add New', 'ensaf' ),
				'add_new_item'       => __( 'Add New Megamenu', 'ensaf' ),
				'new_item'           => __( 'New Megamenu', 'ensaf' ),
				'edit_item'          => __( 'Edit Megamenu', 'ensaf' ),
				'view_item'          => __( 'View Megamenu', 'ensaf' ),
				'all_items'          => __( 'All Megamenu', 'ensaf' ),
				'search_items'       => __( 'Search Megamenu', 'ensaf' ),
				'parent_item_colon'  => __( 'Parent Megamenu:', 'ensaf' ),
				'not_found'          => __( 'No Megamenu found.', 'ensaf' ),
				'not_found_in_trash' => __( 'No Megamenu found in Trash.', 'ensaf' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'ensaf_megamenu', $args );
		}

		function load_canvas_template( $single_template ) {

			global $post;

			if ( 'ensaf_footerbuild' == $post->post_type || 'ensaf_header' == $post->post_type || 'ensaf_tab_build' == $post->post_type || 'ensaf_megamenu' == $post->post_type) {

				$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

				if ( file_exists( $elementor_2_0_canvas ) ) {
					return $elementor_2_0_canvas;
				} else {
					return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
				}
			}

			return $single_template;
		}

        public function ensaf_footer_build_choose_option(){

			$ensaf_post_query = new WP_Query( array(
				'post_type'			=> 'ensaf_footerbuild',
				'posts_per_page'	    => -1,
			) );

			$ensaf_builder_post_title = array();
			$ensaf_builder_post_title[''] = __('Select a Footer','ensaf');

			while( $ensaf_post_query->have_posts() ) {
				$ensaf_post_query->the_post();
				$ensaf_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $ensaf_builder_post_title;

		}

		public function ensaf_header_choose_option(){

			$ensaf_post_query = new WP_Query( array(
				'post_type'			=> 'ensaf_header',
				'posts_per_page'	    => -1,
			) );

			$ensaf_builder_post_title = array();
			$ensaf_builder_post_title[''] = __('Select a Header','ensaf');

			while( $ensaf_post_query->have_posts() ) {
				$ensaf_post_query->the_post();
				$ensaf_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $ensaf_builder_post_title;

        }

    }

    $builder_execute = new EnsafBuilder();