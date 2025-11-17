<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
/**
 *
 * Menu Select Widget .
 *
 */
class Ensaf_Menu extends Widget_Base {

	public function get_name() {
		return 'ensafmenuselect';
	}
	public function get_title() {
		return __( 'Menu Select', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'section_title_section',
			[
				'label'		 	=> __( 'Navigation Menu', 'ensaf' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style',['Style One', 'Style Two'] );

		ensaf_general_fields( $this, 'title', 'Title', 'TEXT', 'Title', ['1'] );

		$menus = $this->ensaf_menu_select();

		if( !empty( $menus ) ){
	        $this->add_control(
				'ensaf_menu_select',
				[
					'label'     	=> __( 'Select Ensaf Menu', 'ensaf' ),
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

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		ensaf_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .widget_title', ['1'] );

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

        //Menu by menu select
        $ensaf_avaiable_menu   = $this->ensaf_menu_select();

        if( ! $ensaf_avaiable_menu ){
            return;
        }

		$args = [
			'menu' 		=> $settings['ensaf_menu_select'],
			'menu_class' 	=> 'menu',
			'container' 	=> '',
		];

		if( $settings['layout_style'] == '1' ){
			echo '<div class="widget widget_nav_menu footer-widget">';
				if($settings['title']){
					echo '<h3 class="widget_title">';
						echo esc_html($settings['title']);
					echo '</h3>';
				}
				echo '<div class="menu-all-pages-container">';
						if( ! empty( $settings['ensaf_menu_select'] ) ){
							wp_nav_menu( $args );
						} 
				echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="footer-links">';
				if( ! empty( $settings['ensaf_menu_select'] ) ){
					wp_nav_menu( $args );
				} 
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){

		}


	}

}