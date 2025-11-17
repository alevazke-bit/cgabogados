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
 * Service Lists Widget .
 *
 */
class Ensaf_Service_List extends Widget_Base {

	public function get_name() {
		return 'ensafservicelist';
	}
	public function get_title() {
		return __( 'Service Lists', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'service_section',
			[
				'label'     => __( 'Service Lists', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style',['Style One'] );

		ensaf_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'All Services');

		$repeater = new Repeater();

		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Label');
		ensaf_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'service_list',
			[
				'label' 		=> __( 'Service Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Label', 'ensaf' ),
					],
				],
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		ensaf_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .widget_title' );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="widget widget_categories">';
				if($settings['title']){
					echo '<h3 class="widget_title">'.wp_kses_post($settings['title']).'</h3>';
				}
				echo '<ul>';
					foreach( $settings['service_list'] as $data ){
						if(!empty($data['title'])){
							echo '<li>';
								echo '<a href="'.esc_url( $data['button_url']['url'] ).'">'.wp_kses_post($data['title']).'</a>';
                                echo '<span><i class="fa-sharp fa-light fa-arrow-right"></i></span>';
							echo '</li>';
						}
					}
				echo '</ul>';
			echo '</div>';

		}
	

	}

}