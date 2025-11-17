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
 * Review Box Widget .
 *
 */
class Ensaf_Review_Box extends Widget_Base {

	public function get_name() {
		return 'ensafreviewbox';
	}
	public function get_title() {
		return __( 'Review Box', 'ensaf' );
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
				'label'		 	=> __( 'Review Box', 'ensaf' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
				
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		$repeater = new Repeater();
		ensaf_general_fields( $repeater, 'title', 'Title', 'TEXTAREA2', 'Title');
		ensaf_general_fields( $repeater, 'subtitle', 'Sub-Title', 'TEXTAREA2', 'SubTitle');
		ensaf_select_field( $repeater, 'client_rating', 'Client Rating', [ 'One Star', 'Two Star', 'Three Star', 'Four Star', 'Five Star' ]);

		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Slides', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'title_field' 	=> '{{{ title }}}',
				'condition'		=> [ 
					'layout_style' => [ '1'],
				],
			]
		);


        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, '12', 'Title', '{{WRAPPER}} .title', ['1'] );
		ensaf_common_style_fields( $this, '13', 'Description', '{{WRAPPER}} .desc', ['1'] );
		ensaf_common_style_fields( $this, '14', 'Block Quote', '{{WRAPPER}} .about-blockquote p', ['1'] );

		//------Button Style-------
		ensaf_button_style_fields( $this, '16', 'Button Styling', '{{WRAPPER}} .th_btn' );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

			if( $settings['layout_style'] == '1' ){

				echo '<div class="testi-review-box d-flex align-items-center">';
					foreach( $settings['slides'] as $data ){
		                echo '<div class="testi-review-content">';
		                	if(!empty($data['title'])){
		                    	echo '<h3 class="testi-review-title">'.wp_kses_post($data['title']).'</h3>';
		                    }	
		                    if( $data['client_rating'] == '1' ){
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-regular fa-star"></i></span>';
								echo '<span><i class="fa-regular fa-star"></i></span>';
								echo '<span><i class="fa-regular fa-star"></i></span>';
								echo '<span><i class="fa-regular fa-star"></i></span>';
							}elseif( $data['client_rating'] == '2' ){
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-regular fa-star"></i></span>';
								echo '<span><i class="fa-regular fa-star"></i></span>';
								echo '<span><i class="fa-regular fa-star"></i></span>';
							}elseif( $data['client_rating'] == '3' ){
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-regular fa-star"></i></span>';
								echo '<span><i class="fa-regular fa-star"></i></span>';
							}elseif( $data['client_rating'] == '4' ){
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-regular fa-star"></i></span>';
							}else{
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-solid fa-star"></i></span>';
								echo '<span><i class="fa-solid fa-star"></i></span>';
							}
							if(!empty($data['subtitle'])){
		                    	echo '<p class="box-text">'.wp_kses_post($data['subtitle']).'</p>';
		                    }	
		                echo '</div>';
	                }
	            echo '</div>';
			}

	}

}