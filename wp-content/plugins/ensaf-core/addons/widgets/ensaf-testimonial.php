<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Testimonial Slider Widget .
 *
 */
class ensaf_Testimonial extends Widget_Base{

	public function get_name() {
		return 'ensaftestimonialslider';
	}
	public function get_title() {
		return __( 'Testimonials', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'testimonial_slider_section',
			[
				'label' 	=> __( 'Testimonial Slider', 'ensaf' ), 
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four','Style Five','Style Six' ] );

		ensaf_general_fields($this, 'arrow_id', 'Arrow ID or Class', 'TEXT', 'testiSlide11', ['1']);
		ensaf_media_fields( $this, 'quote', 'Quote Icon',['1','2','3','4'] );
		
		$repeater = new Repeater();

		ensaf_media_fields( $repeater, 'client_image', 'Client Image' );
		ensaf_general_fields( $repeater, 'client_name', 'Client Name', 'TEXT', 'Alex Michel' );
		ensaf_general_fields( $repeater, 'client_desig', 'Client Designation', 'TEXT', 'Ui/Ux Designer' );
		ensaf_general_fields( $repeater, 'client_feedback', 'Client Feedback', 'TEXTAREA', 'Our knowledgeable technicians are happy to provide tips' );

		ensaf_select_field( $repeater, 'client_rating', 'Client Rating', [ 'One Star', 'Two Star', 'Three Star', 'Four Star', 'Five Star' ] );

		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Slides', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'client_image'	=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ client_name }}}',
				'condition'		=> [ 
					'layout_style' => [ '1', '2', '3', '4','5','6'],
				],
			]
		);

		ensaf_switcher_fields( $this, 'show_arrow', 'Show Arrow ID (#scroll-sec (Use id for scroll))', ['5'] );


		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		
		ensaf_common_style_fields( $this, '01', 'Name', '{{WRAPPER}} .box-title', ['1', '2', '4','6'] );
		ensaf_common_style_fields( $this, '011', 'Name', '{{WRAPPER}} .box-title', ['3'], '--white-color' );
		ensaf_common_style_fields( $this, '02', 'Designation', '{{WRAPPER}} .box-desig' );
		ensaf_common_style_fields( $this, '03', 'Feedback', '{{WRAPPER}} .box-text' );
		
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="testi-card-slide">';
				echo '<div class="swiper has-shadow th-slider" id="'.esc_attr($settings['arrow_id']).'" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"}}}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['slides'] as $data ){
							echo '<div class="swiper-slide">';
								echo '<div class="testi-block shape-mockup-wrap" dir="ltr">';
									if(!empty($settings['quote']['url'])){
										echo '<div class="shape-mockup testi-icon-1-top">';
											echo ensaf_img_tag( array(
												'url'	=> esc_url( $settings['quote']['url'] ),
											) );
										echo '</div>';
									}
									echo '<div class="testi-block-top">';
										if(!empty($data['client_image']['url'])){
											echo '<div class="box-img">';
												echo ensaf_img_tag( array(
													'url'	=> esc_url( $data['client_image']['url'] ),
												) );
											echo '</div>';
										}
										echo '<div class="content">';
											if(!empty($data['client_name'])){
												echo '<h3 class="box-title">'.esc_html( $data['client_name'] ).'</h3>';
											}
											if(!empty($data['client_desig'])){
												echo '<p class="box-desig">'.esc_html( $data['client_desig'] ).'</p>';
											}
											echo '<div class="box-review">';
												if( $data['client_rating'] == '1' ){
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
												}elseif( $data['client_rating'] == '2' ){
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
												}elseif( $data['client_rating'] == '3' ){
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
												}elseif( $data['client_rating'] == '4' ){
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
												}else{
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
												}
											echo '</div>';
										echo '</div>';
									echo '</div>';
									if(!empty($data['client_feedback'])){
										echo '<p class="box-text">'.esc_html( $data['client_feedback'] ).'</p>';
									}
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="testi-card-slide">';
				echo '<div class="swiper has-shadow th-slider" id="'.esc_attr($settings['arrow_id']).'" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"}}}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['slides'] as $data ){
							echo '<div class="swiper-slide">';
								echo '<div class="testi-block style-2 shape-mockup-wrap" dir="ltr">';
									if(!empty($settings['quote']['url'])){
										echo '<div class="shape-mockup testi-icon-2-bottom">';
											echo ensaf_img_tag( array(
												'url'	=> esc_url( $settings['quote']['url'] ),
											) );
										echo '</div>';
									}
									if(!empty($data['client_image']['url'])){
										echo '<div class="box-img2">';
											echo ensaf_img_tag( array(
												'url'	=> esc_url( $data['client_image']['url'] ),
											) );
										echo '</div>';
									}
									echo '<div class="content-wrapper">';
										echo '<div class="testi-block-top">';
											echo '<div class="content">';
												if(!empty($data['client_feedback'])){
													echo '<p class="box-text">'.esc_html( $data['client_feedback'] ).'</p>';
												}
												echo '<div class="auth-info-wrap">';
													if(!empty($data['client_name'])){
														echo '<h3 class="box-title">'.esc_html( $data['client_name'] ).'</h3>';
													}
													if(!empty($data['client_desig'])){
														echo '<p class="box-desig">'.esc_html( $data['client_desig'] ).'</p>';
													}
													echo '<div class="box-review">';
														if( $data['client_rating'] == '1' ){
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-regular fa-star"></i>';
															echo '<i class="fa-regular fa-star"></i>';
															echo '<i class="fa-regular fa-star"></i>';
															echo '<i class="fa-regular fa-star"></i>';
														}elseif( $data['client_rating'] == '2' ){
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-regular fa-star"></i>';
															echo '<i class="fa-regular fa-star"></i>';
															echo '<i class="fa-regular fa-star"></i>';
														}elseif( $data['client_rating'] == '3' ){
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-regular fa-star"></i>';
															echo '<i class="fa-regular fa-star"></i>';
														}elseif( $data['client_rating'] == '4' ){
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-regular fa-star"></i>';
														}else{
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-solid fa-star"></i>';
															echo '<i class="fa-solid fa-star"></i>';
														}
													echo '</div>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="testi-3-slider-wrapper">';
				echo '<div class="swiper th-slider has-shadow" id="testiSlide_3" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"1"}}, "autoHeight": "true"}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['slides'] as $data ){
							echo '<div class="swiper-slide">';
								echo '<div class="testi-block style-3 shape-mockup-wrap" dir="ltr">';
									if(!empty($settings['quote']['url'])){
										echo '<div class="shape-mockup testi-3-bg-icon" data-left="25%">';
											echo ensaf_img_tag( array(
												'url'	=> esc_url( $settings['quote']['url'] ),
											) );
										echo '</div>';
									}
									if(!empty($data['client_feedback'])){
										echo '<p class="box-text">'.esc_html( $data['client_feedback'] ).'</p>';
									}
									echo '<div class="testi-block-top">';
										if(!empty($data['client_image']['url'])){
											echo '<div class="box-img">';
												echo ensaf_img_tag( array(
													'url'	=> esc_url( $data['client_image']['url'] ),
												) );
											echo '</div>';
										}
										echo '<div class="content">';
											if(!empty($data['client_name'])){
												echo '<h3 class="box-title">'.esc_html( $data['client_name'] ).'</h3>';
											}
											if(!empty($data['client_desig'])){
												echo '<p class="box-desig">'.esc_html( $data['client_desig'] ).'</p>';
											}
											echo '<div class="box-review">';
												if( $data['client_rating'] == '1' ){
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
												}elseif( $data['client_rating'] == '2' ){
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
												}elseif( $data['client_rating'] == '3' ){
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
												}elseif( $data['client_rating'] == '4' ){
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-regular fa-star"></i>';
												}else{
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
													echo '<i class="fa-solid fa-star"></i>';
												}
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
				echo '<div class="icon-box">';
					echo '<button data-slider-prev="#testiSlide_3" class="slider-arrow default show-all"><i class="far fa-arrow-left"></i></button>';
					echo '<button data-slider-next="#testiSlide_3" class="slider-arrow default show-all"><i class="far fa-arrow-right"></i></button>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['slides'] as $data ){
					echo '<div class="col-lg-6">';
						echo '<div class="testi-block inner bg-smoke2 shape-mockup-wrap">';
							if(!empty($settings['quote']['url'])){
								echo '<div class="shape-mockup testi-icon-1-top">';
									echo ensaf_img_tag( array(
										'url'	=> esc_url( $settings['quote']['url'] ),
									) );
								echo '</div>';
							}
							echo '<div class="testi-block-top">';
								if(!empty($data['client_image']['url'])){
									echo '<div class="box-img">';
										echo ensaf_img_tag( array(
											'url'	=> esc_url( $data['client_image']['url'] ),
										) );
									echo '</div>';
								}
								echo '<div class="content">';
									if(!empty($data['client_name'])){
										echo '<h3 class="box-title">'.esc_html( $data['client_name'] ).'</h3>';
									}
									if(!empty($data['client_desig'])){
										echo '<p class="box-desig">'.esc_html( $data['client_desig'] ).'</p>';
									}
									echo '<div class="box-review">';
										if( $data['client_rating'] == '1' ){
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-regular fa-star"></i>';
											echo '<i class="fa-regular fa-star"></i>';
											echo '<i class="fa-regular fa-star"></i>';
											echo '<i class="fa-regular fa-star"></i>';
										}elseif( $data['client_rating'] == '2' ){
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-regular fa-star"></i>';
											echo '<i class="fa-regular fa-star"></i>';
											echo '<i class="fa-regular fa-star"></i>';
										}elseif( $data['client_rating'] == '3' ){
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-regular fa-star"></i>';
											echo '<i class="fa-regular fa-star"></i>';
										}elseif( $data['client_rating'] == '4' ){
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-regular fa-star"></i>';
										}else{
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-solid fa-star"></i>';
											echo '<i class="fa-solid fa-star"></i>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
							if(!empty($data['client_feedback'])){
								echo '<p class="box-text">'.esc_html( $data['client_feedback'] ).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){

            echo '<div class="row justify-content-center align-items-center mb-35">';
                echo '<div class="col-xl-6 col-lg-7 col-md-9 col-sm-8">';
                    echo '<div class="swiper th-slider" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":3},"576":{"slidesPerView":"3"},"768":{"slidesPerView":"5"},"992":{"slidesPerView":"5"},"1200":{"slidesPerView":"5"}}, "centeredSlides": "true","thumbs":{"swiper":".thumb-slider4"}}\'>';
                        echo '<div class="swiper-wrapper">';
                        	foreach( $settings['slides'] as $data ){
			                    echo '<div class="swiper-slide">';
			                       echo ' <div class="testi-slider-wrapper">';
			                            echo '<div class="box-img">';
			                                echo ensaf_img_tag( array(
												'url'	=> esc_url( $data['client_image']['url'] ),
											) );
			                            echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
		                    }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="row justify-content-center">';
                echo '<div class="col-xl-10">';
                    echo '<div class="testi-4-slider-wrapper text-center">';
                        echo '<div class="swiper th-slider thumb-slider4 has-shadow" id="testiSlide_4" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"1"}},"autoHeight": "true"}\'>';
                            echo '<div class="swiper-wrapper">';
                            	foreach( $settings['slides'] as $data ){
	                                echo '<div class="swiper-slide">';
	                                    echo '<div class="testi-slider-wrapper">';
	                                        echo '<div class="content">';
	                                            if(!empty($data['client_name'])){
													echo '<h3 class="box-title">'.esc_html( $data['client_name'] ).'</h3>';
												}
												if(!empty($data['client_desig'])){
													echo '<p class="box-desig">'.esc_html( $data['client_desig'] ).'</p>';
												}
	                                            if(!empty($data['client_feedback'])){
													echo '<p class="box-text mb-45">'.esc_html( $data['client_feedback'] ).'</p>';
												}
	                                            echo ' <div class="box-review">';
	                                                if( $data['client_rating'] == '1' ){
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-regular fa-star"></i>';
														echo '<i class="fa-regular fa-star"></i>';
														echo '<i class="fa-regular fa-star"></i>';
														echo '<i class="fa-regular fa-star"></i>';
													}elseif( $data['client_rating'] == '2' ){
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-regular fa-star"></i>';
														echo '<i class="fa-regular fa-star"></i>';
														echo '<i class="fa-regular fa-star"></i>';
													}elseif( $data['client_rating'] == '3' ){
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-regular fa-star"></i>';
														echo '<i class="fa-regular fa-star"></i>';
													}elseif( $data['client_rating'] == '4' ){
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-regular fa-star"></i>';
													}else{
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-solid fa-star"></i>';
														echo '<i class="fa-solid fa-star"></i>';
													}
	                                            echo '</div>';
	                                        echo '</div>';
	                                   echo ' </div>';
	                               echo ' </div>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            if($settings['show_arrow'] == 'yes'){
	            echo '<div class="icon-box d-none d-xl-block">';
	                echo '<button data-slider-prev="#testiSlide_4" class="slider-arrow default show-all">';
	                    echo '<i class="far fa-arrow-left"></i>';
	                echo '</button>';
	                echo '<button data-slider-next="#testiSlide_4" class="slider-arrow default show-all">';
	                    echo '<i class="far fa-arrow-right"></i>';
	               echo ' </button>';
	            echo ' </div>';	
	        }
	    }elseif( $settings['layout_style'] == '6' ){

	    	echo '<div class="testi-6-wrapper ml-45">';
	    		foreach( $settings['slides'] as $data ){
	                echo '<div class="testi-block style-6" dir="ltr">';
	                    echo '<div class="testi-block-top d-flex align-items-center justify-content-between">';
	                        echo '<div class="testi-avater d-sm-flex align-items-center">';
	                            echo '<div class="box-img mr-20">';
	                                echo ensaf_img_tag( array(
										'url'	=> esc_url( $data['client_image']['url'] ),
									) );
	                            echo '</div>';
	                            echo '<div class="content">';
	                            	if(!empty($data['client_name'])){
	                                	echo '<h3 class="box-title">'.esc_html( $data['client_name'] ).'</h3>';
	                                }
	                                if(!empty($data['client_desig'])){
	                                	echo '<p class="box-desig">'.esc_html( $data['client_desig'] ).'</p>';
	                                }
	                            echo '</div>';
	                        echo '</div>';
	                        echo '<div class="box-review">';
	                            if( $data['client_rating'] == '1' ){
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-regular fa-star"></i>';
									echo '<i class="fa-regular fa-star"></i>';
									echo '<i class="fa-regular fa-star"></i>';
									echo '<i class="fa-regular fa-star"></i>';
								}elseif( $data['client_rating'] == '2' ){
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-regular fa-star"></i>';
									echo '<i class="fa-regular fa-star"></i>';
									echo '<i class="fa-regular fa-star"></i>';
								}elseif( $data['client_rating'] == '3' ){
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-regular fa-star"></i>';
									echo '<i class="fa-regular fa-star"></i>';
								}elseif( $data['client_rating'] == '4' ){
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-regular fa-star"></i>';
								}else{
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-solid fa-star"></i>';
									echo '<i class="fa-solid fa-star"></i>';
								}
	                        echo '</div>';
	                    echo '</div>';
	                    if(!empty($data['client_feedback'])){
	                    	echo '<p class="box-text">'.esc_html( $data['client_feedback'] ).'</p>';
	                    }
	                echo '</div>';
                }
            echo '</div>';  
		}


	}

}