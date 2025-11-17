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
 * Megamenu Widget .
 *
 */
class Ensaf_Megamenu extends Widget_Base {

	public function get_name() {
		return 'ensafcat';
	}
	public function get_title() {
		return __( 'Megamenu', 'ensaf' );
	}
	public function get_icon() {
		return 'vt-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'service_section',
			[
				'label'		 	=> __( 'Megamenu', 'ensaf' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One'] );

		$repeater = new Repeater();

		ensaf_general_fields($repeater, 'heading_title', 'Heading Title', 'TEXTAREA2', 'Heading Title');
		ensaf_general_fields($repeater, 'homepage_title', 'Homepage Title', 'TEXTAREA2', 'Homepage Title');
		ensaf_url_fields( $repeater, 'home_url', 'Home URL');
		ensaf_general_fields($repeater, 'onepage_title', 'Onepage Title', 'TEXTAREA', 'Onepage Title');
		ensaf_url_fields( $repeater, 'onepage_url', 'Onepage URL');
		ensaf_general_fields($repeater, 'rtl_title', 'Rtl Title', 'TEXTAREA', 'Rtl Title');
		ensaf_url_fields( $repeater, 'rtl_url', 'Rtl URL');
		ensaf_media_fields($repeater, 'image', 'Choose Image'); 

		$this->add_control(
			'cat_list',
			[
				'label' 		=> __( 'Megamenu Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Professional Technician', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);


        $this->end_controls_section();

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){

			echo '<li>';
                echo '<div class="container">';
	                echo '<div class="row gy-4">';
	                    foreach( $settings['cat_list'] as $data ){
		                    echo '<div class="col-lg-3">';
		                        echo '<div class="mega-menu-box">';
		                            echo '<div class="mega-menu-img">';
		                            	if(!empty( $data['image']['url'])){
		                            		echo '<img src="'.esc_url( $data['image']['url'] ).'" alt="">';
		                            	}
		                                echo '<div class="btn-wrap">';
			                                if( !empty(  $data['home_url']['url'] ) ){
			                                    echo '<a target="_blank" href="'.esc_url( $data['home_url']['url'] ).'" class="th-btn style4">'.esc_html($data['homepage_title']).'</a>';
			                                }
		                                    if( !empty(  $data['onepage_url']['url'] ) ){
			                                    echo '<a target="_blank" href="'.esc_url( $data['onepage_url']['url'] ).'" class="th-btn style4">'.esc_html($data['onepage_title']).'</a>';
			                            	}
			                            	if( !empty(  $data['rtl_url']['url'] ) ){
			                                    echo '<a target="_blank" href="'.esc_url( $data['rtl_url']['url'] ).'" class="th-btn style4">'.esc_html($data['rtl_title']).'</a>';
			                            	}
		                                echo '</div>';
		                            echo '</div>';
		                            
		                        echo '</div>';
		                    echo '</div>';
		                }
	                echo '</div>';
                echo '</div>';
            echo '</li>';
		}
	}
}