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
 * Award Widget .
 *
 */
class Ensaf_Award extends Widget_Base {

	public function get_name() {
		return 'ensafaward';
	}
	public function get_title() {
		return __( 'Award', 'ensaf' );
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
				'label'     => __( 'Award', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'choose_icon', 'Choose Icon');
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Initial Consultation');
		ensaf_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 
		ensaf_general_fields($repeater, 'year', 'Description', 'TEXT', '2025'); 

		$this->add_control(
			'award_list',
			[
				'label' 		=> __( 'Award Lists', 'ensaf' ),
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

			echo '<div class="award-item-wrapper">';
				foreach( $settings['award_list'] as $data ){
	                echo '<div class="award-item gr-bg5">';
	                    echo '<div class="row align-items-center">';
	                    	if(!empty($data['title'])){
		                        echo '<div class="col-xl-4 col-lg-3 order-1 order-lg-0">';
		                            echo '<h2 class="award-title">'.esc_html($data['title']).'</h2>';
		                        echo '</div>';
		                    }
		                    if(!empty($data['description'])){     
		                        echo '<div class="col-xl-5 col-lg-6 order-2 order-lg-2">';
		                            echo '<p class="award-dsc">'.esc_html($data['description']).'</p>';
		                        echo '</div>';
		                    }    
	                        echo '<div class="col-xl-3 col-lg-3 order-0 order-lg-2">';
	                           echo '<div class="award-brand-box d-flex align-items-center justify-content-lg-end">';
	                                echo '<div class="award-brand-thumb">';
	                                    echo ensaf_img_tag( array(
											'url'   => esc_url( $data['choose_icon']['url'] ),
										));
	                                echo '</div>';
	                                if(!empty($data['year'])){ 
	                                	echo '<h3 class="award-year">'.esc_html($data['year']).'</h3>';
	                                }	
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }    
            echo '</div>';


		}
		
			
	}
}