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
 * features Widget .
 *
 */
class Ensaf_Features extends Widget_Base {

	public function get_name() {
		return 'ensaffeatures';
	}
	public function get_title() {
		return __( 'Features', 'ensaf' );
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
				'label'     => __( 'Features', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four','Style Five','Style Six','Style Seven','Style Eight','Style Nine' ] );

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'choose_icon', 'Choose Icon');
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Initial Consultation');
		ensaf_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 

		$this->add_control(
			'feature_list',
			[
				'label' 		=> __( 'Features Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Initial Consultation', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '2', '3','6','7']
				]
			]
		);

		$repeater = new Repeater();

		ensaf_general_fields($repeater, 'choose_icon', 'Choose Icon', 'TEXTAREA2', '');
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Label');
		ensaf_general_fields($repeater, 'description', 'Description', 'TEXTAREA', 'Content'); 

		$this->add_control(
			'feature_list2',
			[
				'label' 		=> __( 'Features Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Location', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['4']
				]
			]
		);

		$feature_list3 = new Repeater();

		ensaf_general_fields($feature_list3, 'number', 'Title', 'TEXT', '01');
		ensaf_general_fields($feature_list3, 'title', 'Title', 'TEXTAREA2', 'Label');
		ensaf_general_fields($feature_list3, 'description', 'Description', 'TEXTAREA', 'Content'); 

		$this->add_control(
			'feature_list3',
			[
				'label' 		=> __( 'Features Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $feature_list3->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Location', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['5']
				]
			]
		);

		ensaf_media_fields($this, 'choose_icon', 'Choose Icon',['8','9']);
		ensaf_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'Initial Consultation',['8','9']);
		ensaf_general_fields($this, 'description', 'Description', 'TEXTAREA',['8','9']); 

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title', ['1', '2', '3','6','8','5'] );
		ensaf_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} p,{{WRAPPER}} .box-text', [ '1', '2', '3','6','8','5'] );

		ensaf_common_style_fields( $this, '011', 'Title', '{{WRAPPER}} .footer-info-title', ['4'] );
		ensaf_common_style_fields( $this, '022', 'Description', '{{WRAPPER}} .info-box_text, {{WRAPPER}} .info-box_text a', [ '4'] );


	}

	protected function render() {

    $settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){
			echo '<div class="process-bottom">';
				foreach( $settings['feature_list'] as $data ){
					echo '<div class="process-bottom-item">';
						if(!empty($data['choose_icon']['url'])){
							echo '<div class="process-bottom-item__icon">';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $data['choose_icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="process-bottom-item__content">';
							if(!empty($data['title'])){
								echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
							}
							if(!empty($data['description'])){
								echo '<p>'.esc_html($data['description']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' || $settings['layout_style'] == '3' ){
			if( $settings['layout_style'] == '3' ){
				$style = 'style-2';
			}else{
				$style = '';
			}
			echo '<div class="about-2-bottom '.esc_attr($style).'">';
				foreach( $settings['feature_list'] as $data ){
					echo '<div class="info-box">';
						if(!empty($data['choose_icon']['url'])){
							echo '<div class="info-box_icon">';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $data['choose_icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="info-contnt">';
							if(!empty($data['title'])){
								echo '<h5 class="box-title">'.wp_kses_post($data['title']).'</h5>';
							}
							if(!empty($data['description'])){
								echo '<p>'.wp_kses_post($data['description']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="contact-icon-box-wrap style-3">';
				foreach( $settings['feature_list2'] as $data ){
					echo '<div class="info-box">';
						if(!empty($data['choose_icon'])){
							echo '<div class="info-box_icon">'.wp_kses_post($data['choose_icon']).'</div>';
						}
						echo '<div class="info-contnt">';
							if(!empty($data['title'])){
								echo '<h4 class="footer-info-title">'.esc_html($data['title']).'</h4>';
							}
							if(!empty($data['description'])){
								echo '<p class="info-box_text">'.wp_kses_post($data['description']).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){

			echo '<div class="process-bottom process-4-bottom">';
				foreach( $settings['feature_list3'] as $data ){
	                echo '<div class="process-bottom-item">';
	                	if(!empty($data['number'])){
		                   	echo '<div class="process-bottom-item__icon">';
		                        echo '<span>'.esc_html($data['number']).'</span>';
		                    echo '</div>';
		                }    
	                    echo '<div class="process-bottom-item__content">';
	                    	if(!empty($data['title'])){
	                        	echo '<h5 class="box-title">'.esc_html($data['title']).'</h5>';
	                        }
	                        if(!empty($data['description'])){	
	                        	echo '<p>'.esc_html($data['description']).'</p>';
	                        }	
	                    echo '</div>';
	                echo '</div>';
               	}
            echo '</div>';

        }elseif( $settings['layout_style'] == '6' ){

        	echo '<div class="about-2-bottom about-4-info">';
        		foreach( $settings['feature_list'] as $data ){
	                echo '<div class="info-box align-items-center">';
	                    echo '<div class="info-box_icon">';
	                        echo ensaf_img_tag( array(
								'url'   => esc_url( $data['choose_icon']['url'] ),
							));
	                    echo '</div>';
	                    echo '<div class="info-contnt">';
	                    	if(!empty($data['title'])){
	                        	echo '<h5 class="box-title">'.esc_html($data['title']).'</h5>';
	                        }
	                        if(!empty($data['description'])){	
	                        	echo '<p>'.esc_html($data['description']).'</p>';
	                        }	
	                    echo '</div>';
	                echo '</div>';
               	}
            echo '</div>';

        }elseif( $settings['layout_style'] == '7' ){

        	echo '<div class="about-feature-box mb-50 d-sm-flex align-items-center">';
        		foreach( $settings['feature_list'] as $data ){
	                echo '<div class="about-feature-item text-center text-sm-start">';
	                    echo '<div class="theme-icon">';
	                        echo ensaf_img_tag( array(
								'url'   => esc_url( $data['choose_icon']['url'] ),
							));
	                    echo '</div>';
	                    echo '<div class="info-contnt">';
	                        if(!empty($data['title'])){
	                        	echo '<h5 class="box-title">'.esc_html($data['title']).'</h5>';
	                        }
	                        if(!empty($data['description'])){	
	                        	echo '<p>'.esc_html($data['description']).'</p>';
	                        }
	                    echo '</div>';
	                echo '</div>';
               	}
            echo '</div>';
        }elseif($settings['layout_style'] == '8'){

        	echo '<div class="choose-content">';
                echo '<div class="choose-shape">';
                   echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['choose_icon']['url'] ),
					));
                echo '</div>';
                if(!empty($settings['title'])){
                	echo '<h3 class="box-title mb-25">'.esc_html($settings['title']).'</h3>';
                }
                if(!empty($settings['description'])){
                	echo '<p class="box-text">'.esc_html($settings['description']).'</p>';
                }
            echo '</div>';
        }elseif($settings['layout_style'] == '9'){
            
	        echo '<div class="choose-content choose-content-3 mb-25">';
	            echo '<div class="choose-shape">';
	                echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['choose_icon']['url'] ),
					));
	            echo '</div>';
	           	if(!empty($settings['title'])){ 	
	           		 echo '<h3 class="box-title text-white mb-25">'.esc_html($settings['title']).'</h3>';
	           	}
	           	if(!empty($settings['description'])){	 
	            	echo '<p class="box-text text-white">'.esc_html($settings['description']).'</p>';
	            }	
	        echo '</div>';
		}
		
			
	}
}