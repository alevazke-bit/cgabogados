<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
/**
 *
 * Image Widget .
 *
 */
class Ensaf_Image extends Widget_Base {

	public function get_name() {
		return 'ensafimage';
	}
	public function get_title() {
		return __( 'Image', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'image_section',
			[
				'label' 	=> __( 'Image', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five','Style Six','Style Seven','Style Eight','Style Nine','Style Ten','Style Eleven','Style Twelve','Style Thirteen','Style Fourteen','Style Fifthteen','Style Sixteen'] );

		ensaf_media_fields( $this, 'image', 'Choose Image' );
		ensaf_media_fields( $this, 'image2', 'Choose Image', ['1', '4','12','13','14','15','16'] );
		ensaf_media_fields( $this, 'image3', 'Choose Image', ['1','15','16','12'] );

		ensaf_media_fields( $this, 'shape', 'Choose Shape', ['5'] );

		ensaf_general_fields( $this, 'title', 'Title', 'TEXTAREA2', '49', ['4','7','10','11','14'] );
		ensaf_general_fields( $this, 'desc', 'Description', 'TEXTAREA2', 'Years Experience', ['4','10'] );
		ensaf_general_fields($this, 'counter_title', 'Counter Title', 'TEXTAREA2', 'Counter Title',['10']);
		ensaf_general_fields($this, 'counter_number', 'Counter Number', 'TEXT', '12',['10']);
		ensaf_general_fields($this, 'counter_operator', 'Counter Operator', 'TEXT', '+',['10']);

		ensaf_media_fields( $this, 'icon', 'Choose Icon', [ '1', '2', '5' ] );
		ensaf_general_fields( $this, 'circle_text', 'Circle Text', 'TEXTAREA2', 'Ensaf The Best Service Provider', ['1', '2', '5','16' ] );


       $this->end_controls_section();

      	//---------------------------------------
			//Style Section Start
		//---------------------------------------

        ensaf_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .about-7 .about-info-box a', ['11'] );
		ensaf_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} .about-7 .about-info-box span', [ '11'] );
		

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
       
		if( $settings['layout_style'] == '1' ){
			echo '<div class="img-box1 about-1">';
				if(!empty($settings['circle_text'])){
					echo '<div class="shape-mockup logo-shape">';
						echo '<div class="logo-icon-wrap">';
							if(!empty($settings['icon']['url'])){
								echo '<div class="logo-icon">';
									echo ensaf_img_tag( array(
										'url'   => esc_url( $settings['icon']['url'] ),
									));
								echo '</div>';
							}
							echo '<div class="logo-icon-wrap__text bg-theme2">';
								echo '<span class="logo-animation">'.esc_html($settings['circle_text']).'</span>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if(!empty($settings['image']['url'])){
					echo '<div class="img1">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
							'class' => 'tilt-active',
						));
					echo '</div>';
				}
				echo '<div class="img2">';
					if(!empty($settings['image2']['url'])){
						echo '<div class="img2-top">';
							echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['image2']['url'] ),
								'class' => 'tilt-active',
							));
						echo '</div>';
					}
					if(!empty($settings['image3']['url'])){
						echo '<div class="img2-bottom">';
							echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['image3']['url'] ),
								'class' => 'tilt-active',
							));
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="img-box2">';
				if(!empty($settings['circle_text'])){
					echo '<div class="shape-mockup about-2-logo-shape">';
						echo '<div class="logo-icon-wrap">';
							if(!empty($settings['icon']['url'])){
								echo '<div class="logo-icon">';
									echo ensaf_img_tag( array(
										'url'   => esc_url( $settings['icon']['url'] ),
									));
								echo '</div>';
							}
							echo '<div class="logo-icon-wrap__text bg-theme2">';
								echo '<span class="logo-animation">'.esc_html($settings['circle_text']).'</span>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if(!empty($settings['image']['url'])){
					echo '<div class="img2">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
							'class' => 'tilt-active',
						));
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			if(!empty($settings['image']['url'])){
				echo '<div class="faq-img-box2">';
					echo '<div class="img">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				echo '</div>';
			}

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="about-img-box3">';
				if(!empty($settings['image']['url'])){
					echo '<div class="about-img-box3__big">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
							'class' => 'tilt-active',
						));
					echo '</div>';
				}
				echo '<div class="about-img-box3__img2">';
					if(!empty($settings['image2']['url'])){
						echo '<div class="about-img-box3__img-small">';
							echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['image2']['url'] ),
								'class' => 'tilt-active',
							));
						echo '</div>';
					}
					echo '<div class="about-img-box3__counter">';
						if(!empty($settings['title'])){
							echo '<h1 class="box-title"><span>'.wp_kses_post($settings['title']).'</span></h1>';
						}
						if(!empty($settings['desc'])){
							echo '<h4 class="box-title">'.wp_kses_post($settings['desc']).'</h4>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){
			echo '<div class="testi-3-thumb shape-mockup-wrap">';
				if(!empty($settings['circle_text'])){
					echo '<div class="shape-mockup testi_3_logo-icon">';
						echo '<div class="logo-icon-wrap">';
							if(!empty($settings['icon']['url'])){
								echo '<div class="logo-icon">';
									echo ensaf_img_tag( array(
										'url'   => esc_url( $settings['icon']['url'] ),
									));
								echo '</div>';
							}
							echo '<div class="logo-icon-wrap__text bg-theme2">';
								echo '<span class="logo-animation">'.esc_html($settings['circle_text']).'</span>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if(!empty($settings['shape']['url'])){
					echo '<div class="testi_3_left_img-shape">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape']['url'] ),
						));
					echo '</div>';
				}
				echo ensaf_img_tag( array(
					'url'   => esc_url( $settings['image']['url'] ),
				));
			echo '</div>';

		}elseif( $settings['layout_style'] == '6' ){
			echo '<div class="process-thumb process-4-thumb">';
                echo '<div class="img-box1">';
                    echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
					));
                echo '</div>';
            echo '</div>';

        }elseif( $settings['layout_style'] == '7' ){

        	echo '<div class="img-box about-6-imgbox">';
    			echo ensaf_img_tag( array(
					'url'   => esc_url( $settings['image']['url'] ),
					'class' => 'tilt-active'
				));
    			if(!empty($settings['title'])){
                	echo '<span class="ensaf-transparent-text">'.wp_kses_post($settings['title']).'</span>';
                }	
            echo '</div>';

       	}elseif( $settings['layout_style'] == '8' ){

       		echo '<div class="about7-thumb-box">';
       			$image_one= get_template_directory_uri().'/assets/img/ab-7-mask-1.png';
                echo '<div class="img-box7 bg-mask" data-mask-src="'.esc_url($image_one).'">';
                    echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
					));

					$image_two= get_template_directory_uri().'/assets/img/ab-7-border-mask-1.png';
                    echo '<span class="img-box-border" data-mask-src="'.esc_url($image_two).'"></span>';
                echo '</div>';
            echo '</div>';

        }elseif( $settings['layout_style'] == '9' ){   

        	echo '<div class="box-img">';
                echo ensaf_img_tag( array(
					'url'   => esc_url( $settings['image']['url'] ),
				));
            echo '</div>';

        }elseif($settings['layout_style'] == '10'){

        	echo '<div class="choose-item choose-center-item">';
                echo '<div class="box-img">';
                    echo '<div class="media-body">';
                        echo '<h4 class="box-number mb-0">';
                        	if(!empty($settings['counter_number'])){
                        		echo '<span class="counter-number text-white">'.wp_kses_post($settings['counter_number']).'</span>';
                        	}
                            
                        	if(!empty($settings['counter_operator'])){
                            	echo '<span class="plus-simple text-white">'.wp_kses_post($settings['counter_operator']).'</span>';
                            }	
                        echo '</h4>';
                        if(!empty($settings['counter_title'])){
                        	echo '<p class="box-text text-white">'.wp_kses_post($settings['counter_title']).'</p>';
                        }	
                    echo '</div>';

                    echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
					));

                    echo '<div class="choose-content">';
                    	if(!empty($settings['image2']['url'])){
                    		echo '<div class="choose-shape">';
	                            echo ensaf_img_tag( array(
									'url'   => esc_url( $settings['image2']['url'] ),
								));
	                        echo '</div>';
                    	}
                        if(!empty($settings['title'])){
                       		echo '<h3 class="box-title text-white mb-10">'.wp_kses_post($settings['title']).'</h3>';
                       	}
                       	if(!empty($settings['desc'])){
                       		echo ' <p class="box-text text-white">'.wp_kses_post($settings['desc']).'</p>';
                       	}
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }elseif($settings['layout_style'] == '11'){

        	echo '<div class="about-7 d-sm-flex align-items-center justify-content-start">';
                echo '<div class="img-box7">';
                    echo '<div class="img2">';
                    	echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
							'class' => 'tilt-active'
						));
                    echo '</div>';
                    echo '<div class="about-info-box">';
                        echo wp_kses_post($settings['title']);
                    echo '</div>';
               echo ' </div>';
            echo '</div>';

        }elseif($settings['layout_style'] == '12'){

        	echo '<div class="faq-img-box3 d-flex align-items-end justify-content-center justify-content-lg-start">';
                echo '<div class="img-sub d-none d-sm-block">';
                	if(!empty($settings['image']['url'])){
	                    echo '<div class="img-sub-top">';
	                      	echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['image']['url'] ),
							));
	                    echo '</div>';
	                }
                    if(!empty($settings['image2']['url'])){
	                    echo '<div class="img-sub-bottom">';
	                        echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['image2']['url'] ),
							));
	                    echo '</div>';
	                }    
                echo '</div>';

                if(!empty($settings['image3']['url'])){
	                echo '<div class="img-main">';
	                   	echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image3']['url'] ),
						));
	                echo '</div>';
	            }    
            echo '</div>';
        }elseif($settings['layout_style'] == '13'){

        	echo '<div class="img-box9 d-flex justify-content-center justify-content-xl-end">';
                echo '<div class="img1">';
                    echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image2']['url'] ),
					));
                echo '</div>';
                $image_one = get_template_directory_uri().'/assets/img/ab-9-mask.png';
                echo '<div class="img2 bg-mask" data-mask-src="'.esc_url($image_one).'">';
                    echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
						'class' => 'tilt-active'
					));
                echo '</div>';
            echo '</div>  ';

        }elseif($settings['layout_style'] == '14'){

        	echo '<div class="img-box2 img-box10">';
                echo '<div class="shape-mockup about-2-logo-shape">';
                    echo '<div class="logo-icon-wrap">';
                    	if(!empty($settings['image2']['url'])){
                    		echo '<h4 class="logo-icon">';
	                           echo ensaf_img_tag( array(
									'url'   => esc_url( $settings['image2']['url'] ),
								));
	                        echo '</h4>';
                    	}
                        if(!empty($settings['title'])){
                        	echo '<div class="logo-icon-wrap__text bg-theme2">';
                            	echo '<span class="logo-animation">'.wp_kses_post($settings['title']).'</span>';
                        	echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
                if(!empty($settings['image']['url'])){
	                echo '<div class="img2">';
	                    echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
							'class' => 'tilt-active'
						));
	                echo '</div>';
	            }    
            echo '</div>';

        }elseif($settings['layout_style'] == '15'){

        	echo '<div class="choose-4-img-box d-flex align-items-start justify-content-xl-end justify-content-xxl-start">';
                echo '<div class="img-box1">';
                    echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image']['url'] ),
						'class' => 'tilt-active'
					));
                echo '</div>';
                echo '<div class="img-box2 d-none d-md-block d-lg-none d-xl-block">';
                   	echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image2']['url'] ),
						'class' => 'tilt-active'
					));
					echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image3']['url'] ),
						'class' => 'tilt-active'
					));
                echo '</div>';
            echo '</div>';

        }elseif($settings['layout_style'] == '16'){

        	echo '<div class="img-box2 about-5-imgbox">';
                echo '<div class="shape-mockup about-5-logo-shape">';
                    echo '<div class="logo-icon-wrap">';

                        echo '<h4 class="logo-icon">';
                            echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['image']['url'] ),
							));
                        echo '</h4>';

                        if(!empty($settings['circle_text'])){
                        	echo '<div class="logo-icon-wrap__text bg-theme2">';
	                           echo ' <span class="logo-animation">'.wp_kses_post($settings['circle_text']).'</span>';
	                        echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
                echo '<span class="img-dotted-shape"></span>';

                echo '<div class="img2 text-center text-md-start">';
                    echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image2']['url'] ),
						'class' => 'tilt-active'
					));
                echo '</div>';

                echo '<div class="img2-sub d-none d-md-block">';
                    echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image3']['url'] ),
					));
                echo '</div>';

            echo '</div>';

		}


	}

}