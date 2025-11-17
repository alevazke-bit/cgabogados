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
 * history Widget .
 *
 */
class Ensaf_History extends Widget_Base {

	public function get_name() {
		return 'ensafhistory';
	}
	public function get_title() {
		return __( 'History', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'arrow_section',
			[
				'label'     => __( 'History', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four','Style Five','Style Six','Style Seven' ] );

		$repeater = new Repeater();

		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Initial Consultation');
		ensaf_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 
		ensaf_general_fields($repeater, 'year', 'Year', 'TEXT', '2025');

		$this->add_control(
			'history_list',
			[
				'label' 		=> __( 'History Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Initial Consultation', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

		
        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title', ['1', '2', '3'] );
		ensaf_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} p', [ '1', '2', '3'] );

		ensaf_common_style_fields( $this, '011', 'Title', '{{WRAPPER}} .footer-info-title', ['4'] );
		ensaf_common_style_fields( $this, '022', 'Description', '{{WRAPPER}} .info-box_text, {{WRAPPER}} .info-box_text a', [ '4'] );


	}

	protected function render() {

    $settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){

			echo '<div class="row gy-4">';
                echo '<div class="history-slider-area">';
                    echo '<div class="swiper th-slider has-shadow" id="blogSlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}, "autoHeight": "true"}\'>';
                        echo '<div class="swiper-wrapper">';
                        	foreach( $settings['history_list'] as $data ){
	                            echo '<div class="swiper-slide">';
	                                echo '<div class="history-item text-center">';
	                                	if(!empty($data['year'])){
	                                    	echo '<span class="history-date">'.esc_html($data['year']).'</span>';
	                                    }	
	                                    echo '<span class="history-border"></span>';
	                                    if(!empty($data['title'])){
	                                    	echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
	                                    }
	                                    if(!empty($data['description'])){	
	                                    	echo '<p class="text-box">'.esc_html($data['description']).'</p>';
	                                    }	
	                                echo '</div>';
	                            echo '</div>';
	                        }    
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}
		
			
	}
}