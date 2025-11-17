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
 * Step Widget .
 *
 */
class ensaf_Step extends Widget_Base {

	public function get_name() {
		return 'ensafstep';
	}
	public function get_title() {
		return __( 'Step/Process', 'ensaf' );
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
				'label'		 	=> __( 'Steps', 'ensaf' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] );

		$repeater = new Repeater();
 
		ensaf_media_fields($repeater, 'choose_icon', 'Choose Icon');
		ensaf_general_fields($repeater, 'number', 'Number', 'TEXTAREA2', '01');
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Meet Our Team');
		ensaf_general_fields($repeater, 'description', 'Description', 'TEXTAREA', 'Proactively envisioned multimedia based expertisee cross-media growth'); 

		$this->add_control(
			'process_list',
			[
				'label' 		=> __( 'Process Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Meet Our Team', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '2']
				]
			]
		);

		$process_list2 = new Repeater();
 
		
		ensaf_general_fields($process_list2, 'number', 'Number', 'TEXT', '01');
		ensaf_general_fields($process_list2, 'title', 'Title', 'TEXTAREA2', 'Meet Our Team');
		ensaf_general_fields($process_list2, 'description', 'Description', 'TEXTAREA', 'Proactively envisioned multimedia based expertisee cross-media growth');
		ensaf_media_fields($process_list2, 'image', 'Bg Image'); 
		ensaf_media_fields($process_list2, 'direction_image', 'Direction Image'); 

		$this->add_control(
			'process_list2',
			[
				'label' 		=> __( 'Process Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $process_list2->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Meet Our Team', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['3']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title', [ '1', '2', '3' ] );
		ensaf_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} .box-text', [ '1', '2', '3' ] );

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="row gy-40 justify-content-center">';
				foreach( $settings['process_list'] as $data ){
					echo '<div class="col-xl-4 col-lg-4 col-md-6 ">';
						echo '<div class="process-box style-2">';
							if(!empty($data['choose_icon']['url'])){
								echo '<div class="box-icon">';
									if(!empty($data['number'])){
										echo '<span class="number">'.esc_html($data['number']).'</span>';
									}
									echo ensaf_img_tag( array(
										'url'   => esc_url( $data['choose_icon']['url'] ),
									));
								echo '</div>';
							}
							if(!empty($data['title'])){
								echo '<h3 class="box-title">'.wp_kses_post($data['title']).'</h3>';
							}
							if(!empty($data['description'])){
								echo '<p class="box-text">'.wp_kses_post($data['description']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="row gy-50 justify-content-center">';
				foreach( $settings['process_list'] as $data ){
					echo '<div class="col-xl-4 col-lg-4 col-md-6 ">';
						echo '<div class="process-box style-2 theme-3">';
							if(!empty($data['choose_icon']['url'])){
								echo '<div class="box-icon">';
									if(!empty($data['number'])){
										echo '<span class="number">'.esc_html($data['number']).'</span>';
									}
									echo ensaf_img_tag( array(
										'url'   => esc_url( $data['choose_icon']['url'] ),
									));
								echo '</div>';
							}
							if(!empty($data['title'])){
								echo '<h3 class="box-title">'.wp_kses_post($data['title']).'</h3>';
							}
							if(!empty($data['description'])){
								echo '<p class="box-text">'.wp_kses_post($data['description']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){

			echo '<div class="row gy-40 justify-content-center">';
				foreach( $settings['process_list2'] as $data ){
	                echo '<div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6">';
	                    echo '<div class="process-box style-2 style-5">';
	                        echo '<div class="box-icon">';
	                        	if(!empty($data['number'])){
	                            	echo '<span class="number">'.wp_kses_post($data['number']).'</span>';
	                            }	
	                           	echo ensaf_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								));
	                        echo '</div>';
	                        echo '<div class="process-direction">';
	                            echo ensaf_img_tag( array(
									'url'   => esc_url( $data['direction_image']['url'] ),
								));
	                        echo '</div>';
	                        if(!empty($data['title'])){
	                        	echo '<h3 class="box-title">'.wp_kses_post($data['title']).'</h3>';
	                        }
	                        if(!empty($data['description'])){
	                        	echo '<p class="box-text">'.wp_kses_post($data['description']).'</p>';
	                        }
	                    echo '</div>';
	                echo '</div>';
                }
            echo '</div>';

		}
	

	}

}