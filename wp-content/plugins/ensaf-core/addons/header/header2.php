<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Header Widget . 
 *
 */
class Ensaf_Header2 extends Widget_Base {

	public function get_name() {
		return 'ensafheader2';
	}
	public function get_title() {
		return __( 'Header V2', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label' 	=> __( 'Header', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', ['Style One', 'Style Two'] );

		$this->add_control(
			'logo_image',

			[
				'label' 		=> __( 'Upload Logo', 'ensaf' ),
				'type' 			=> Controls_Manager::MEDIA,
			]
		);				

		$menus = $this->ensaf_menu_select();

		if( !empty( $menus ) ){
	        $this->add_control(
				'ensaf_menu_select',
				[
					'label'     	=> __( 'Select ensaf Menu', 'ensaf' ),
					'type'      	=> Controls_Manager::SELECT,
					'options'   	=> $menus,
					'description' 	=> sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'ensaf' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		}else {
			$this->add_control(
				'no_menu',
				[
					'type' 				=> Controls_Manager::RAW_HTML,
					'raw' 				=> '<strong>' . __( 'There are no menus in your site.', 'ensaf' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'ensaf' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' 		=> 'after',
					'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		ensaf_switcher_fields($this, 'show_search_btn', 'Show Search Button?', ['1', '2']);

		ensaf_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'Free consultation', ['1', '2'] );
		ensaf_url_fields( $this, 'button_url', 'Button URL', ['1', '2'] );

		ensaf_switcher_fields($this, 'show_offcanvas_btn', 'Show Offcanvas Button?', ['1', '2']);

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------General Style-------
		 $this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'Background Styling', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

		ensaf_color_fields( $this, 'menu_bg', 'Background', 'background', '{{WRAPPER}} .sticky-wrapper', ['1', '2'] );                      

		$this->end_controls_section();

		//------Menu Bar Style-------
        $this->start_controls_section(
			'menubar_styling2',
			[
				'label'     => __( 'Menu Styling', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

		ensaf_color_fields( $this, 'menu_color1', 'Color', 'color', '{{WRAPPER}} .main-menu>ul>li>a' );
		ensaf_color_fields( $this, 'menu_color2', 'Hover Color', 'color', '{{WRAPPER}} .main-menu>ul>li>a:hover' );
		ensaf_color_fields( $this, 'menu_color3', 'Dropdown Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a' );
		ensaf_color_fields( $this, 'menu_color4', 'Dropdown Hover Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a:hover' );
		ensaf_color_fields( $this, 'menu_color5', 'Menu Icon Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a:before, {{WRAPPER}} .main-menu ul li.menu-item-has-children > a:after' );

		ensaf_typography_fields( $this, 'menu_font', 'Menu Trpography', '{{WRAPPER}} .main-menu>ul>li>a, {{WRAPPER}} .main-menu ul.sub-menu li a' );

		ensaf_dimensions_fields( $this, 'menu_margin', 'Menu Margin', 'margin', '{{WRAPPER}} .main-menu>ul>li>a' );
		ensaf_dimensions_fields( $this, 'menu_padding', 'Menu Padding', 'padding', '{{WRAPPER}} .main-menu>ul>li>a' );

		$this->end_controls_section();

		//------Button Style-------
		ensaf_button_style_fields( $this, '12', 'Button Styling', '{{WRAPPER}} .th_btn' );

    }

    public function ensaf_menu_select(){
	    $ensaf_menu = wp_get_nav_menus();
	    $menu_array  = array();
		$menu_array[''] = __( 'Select A Menu', 'ensaf' );
	    foreach( $ensaf_menu as $menu ){
	        $menu_array[ $menu->slug ] = $menu->name;
	    }
	    return $menu_array;
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		global $woocommerce;

        //Menu by menu select
        $ensaf_avaiable_menu   = $this->ensaf_menu_select();
		if( ! $ensaf_avaiable_menu ){
			return;
		}
		$args = [
			'menu' 			=> $settings['ensaf_menu_select'],
			'menu_class' 	=> 'ensaf-menu',
			'container' 	=> '',
		];

		//Mobile menu, Offcanvas, Search
        echo ensaf_mobile_menu();
		// echo ensaf_header_cart_offcanvas();
		if(!empty( $settings['show_offcanvas_btn'])){
			echo ensaf_header_offcanvas();
		}
		if(!empty( $settings['show_search_btn'])){
			echo ensaf_search_box();
		}
		// Header sub-menu icon
		if( class_exists( 'ReduxFramework' ) ){ 
			if(ensaf_opt('ensaf_header_sticky')){
                $sticky = '';
            }else{
                $sticky = '-no';
            }

			if(ensaf_opt('ensaf_menu_icon')){
				$menu_icon = '';
			}else{
				$menu_icon = 'hide-icon';
			}
		}

		if( $settings['layout_style'] == '1' ){
			echo '<div class="th-header header-layout2">';
				echo '<div class="sticky-wrapper'.esc_attr($sticky).'">';
					echo '<!-- Main Menu Area -->';
					echo '<div class="menu-area">';
						echo '<div class="container">';
							echo '<div class="row align-items-center justify-content-between">';
								echo '<div class="col-auto">';
									echo '<div class="header-logo">';
										echo '<a href="'.esc_url( home_url( '/' ) ).'">';
											echo ensaf_img_tag( array(
												'url'   => esc_url( $settings['logo_image']['url'] ),
											));
										echo '</a>';
									echo '</div>';
								echo '</div>';
								echo '<div class="col-auto">';
									echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
										if( ! empty( $settings['ensaf_menu_select'] ) ){
											wp_nav_menu( $args );
										}else{
											wp_nav_menu( array(
												"theme_location"    => 'primary-menu',
												"container"         => '',
												"menu_class"        => ''
											) );
										}
									echo '</nav>';
									echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
								echo '</div>';
								echo '<div class="col-auto d-none d-xl-block">';
									echo '<div class="header-button">';
										if(!empty($settings['show_search_btn'])){
											echo '<button type="button" class="icon-btn searchBoxToggler"><i class="far fa-magnifying-glass"></i></button>';
										}
										if(!empty( $settings['button_text'])){
											echo '<a class="th-btn th_btn" href="'.esc_attr($settings['button_url']['url']).'">'.esc_html($settings['button_text']).'<i class="far fa-arrow-right-long"></i></a>';
										}
										if(!empty($settings['show_offcanvas_btn'])){
											echo '<button type="button" class="icon-btn sideMenuInfo"><i class="fa-solid fa-bars"></i></button>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		
		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="th-header header-layout2 bg-black2">';
				echo '<div class="sticky-wrapper'.esc_attr($sticky).'">';
					echo '<!-- Main Menu Area -->';
					echo '<div class="menu-area">';
						echo '<div class="container">';
							echo '<div class="row align-items-center justify-content-between">';
								echo '<div class="col-auto">';
									echo '<div class="header-logo">';
										echo '<a href="'.esc_url( home_url( '/' ) ).'">';
											echo ensaf_img_tag( array(
												'url'   => esc_url( $settings['logo_image']['url'] ),
											));
										echo '</a>';   
									echo '</div>';
								echo '</div>';
								echo '<div class="col-auto">';
									echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
										if( ! empty( $settings['ensaf_menu_select'] ) ){
											wp_nav_menu( $args );
										}else{
											wp_nav_menu( array(
												"theme_location"    => 'primary-menu',
												"container"         => '',
												"menu_class"        => ''
											) );
										}
									echo '</nav>';
									echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
								echo '</div>';
								echo '<div class="col-auto d-none d-xl-block">';
									echo '<div class="header-button">';
										if(!empty($settings['show_search_btn'])){
											echo '<button type="button" class="icon-btn searchBoxToggler"><i class="far fa-magnifying-glass"></i></button>';
										}
										if(!empty( $settings['button_text'])){
											echo '<a class="th-btn th_btn" href="'.esc_attr($settings['button_url']['url']).'">'.esc_html($settings['button_text']).'<i class="far fa-arrow-right-long"></i></a>';
										}
										if(!empty($settings['show_offcanvas_btn'])){
											echo '<button type="button" class="icon-btn sideMenuInfo"><i class="fa-solid fa-bars"></i></button>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}


	}
}