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
 * Service Widget .
 *
 */
class ensaf_Service extends Widget_Base {

	public function get_name() {
		return 'ensafservice';
	}
	public function get_title() {
		return __( 'Services', 'ensaf' );
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
				'label'     => __( 'Services', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four','Style Five','Style Six','Style Seven','Style Eight','Style Nine','Style Ten','Style Eleven' ] );
 
		ensaf_general_fields($this, 'arrow_id', 'Arrow ID or Class', 'TEXT', 'serviceSlider2', ['2', '4']);

		ensaf_general_fields( $this, 'number', 'Number', 'TEXTAREA2', '01', ['9'] );
		ensaf_general_fields( $this, 'subtitle', 'Subitle', 'TEXTAREA2', 'Our Services', ['3','9'] );
		ensaf_general_fields( $this, 'title', 'Title', 'TEXTAREA', 'Legal Services for Your Peace', ['3','9'] );
		ensaf_general_fields( $this, 'desc', 'Description', 'TEXTAREA', '', ['3'] );
        
		ensaf_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'View More Service', ['3','9'] );
		ensaf_url_fields( $this, 'button_url', 'Button URL', ['3','9'] );

		ensaf_media_fields($this, 'choose_image', 'Choose Image One',['9']);
		ensaf_media_fields($this, 'choose_image2', 'Choose Image Two',['9']);

		$this->add_control(
			'active_status',
			[
				'label' => esc_html__( 'Active Status', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'choose_image', 'Choose Image');
		ensaf_media_fields($repeater, 'choose_icon', 'Choose Icon');
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Criminal Law');
		ensaf_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 
		ensaf_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Read More');
		ensaf_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'service_list',
			[
				'label' 		=> __( 'Service Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Criminal Law', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '3','11']
				]
			]
		);

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'choose_icon', 'Choose Icon');
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Criminal Law');
		ensaf_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 
		ensaf_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Read More');
		ensaf_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'service_list2',
			[
				'label' 		=> __( 'Service Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Criminal Law', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['2', '4','5','7','10']
				]
			]
		);

		$service_list3 = new Repeater();

		ensaf_media_fields($service_list3, 'choose_image', 'Choose Image');
		ensaf_media_fields($service_list3, 'choose_icon', 'Choose Icon');
		ensaf_general_fields($service_list3, 'title', 'Title', 'TEXTAREA2', 'Criminal Law');
		ensaf_general_fields($service_list3, 'subtitle', 'Subtitle', 'TEXTAREA', 'subtitle'); 
		ensaf_url_fields($service_list3, 'button_url', 'Button URL');

		$this->add_control(
			'service_list3',
			[
				'label' 		=> __( 'Service Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $service_list3->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Criminal Law', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['6']
				]
			]
		);


		$service_list4 = new Repeater();

		ensaf_media_fields($service_list4, 'choose_image', 'Choose Image');
		ensaf_media_fields($service_list4, 'choose_icon', 'Choose Icon');
		ensaf_general_fields($service_list4, 'title', 'Title', 'TEXTAREA2', 'Criminal Law');
		ensaf_general_fields($service_list4, 'description', 'Description', 'TEXTAREA', '');
		ensaf_general_fields($service_list4, 'number', 'Title', 'TEXT', '01'); 
		ensaf_general_fields($service_list4, 'button_text', 'Button Text', 'TEXT', 'Read More');
		ensaf_url_fields($service_list4, 'button_url', 'Button URL');

		$this->add_control(
			'service_list4',
			[
				'label' 		=> __( 'Service Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $service_list4->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Criminal Law', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['8']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, 'subtitle', 'Section Subtitle', '{{WRAPPER}} .sub-title,{{WRAPPER}} .award-title,{{WRAPPER}} .box-text,{{WRAPPER}} .sec-text', ['3','6','7','9','5','8','10','11']);
		ensaf_common_style_fields( $this, 'title', 'Section Title', '{{WRAPPER}} .sec-title,{{WRAPPER}} .award-dsc,{{WRAPPER}} .box-title a,{{WRAPPER}} .box-title', ['3','6','7','9','5','8','10','11'] );
		ensaf_common_style_fields( $this, 'number', 'Number', '{{WRAPPER}} .box-count', ['9','8'] );

		ensaf_common_style_fields( $this, 'desc', 'Section Description', '{{WRAPPER}} .sec-text', ['3'] );

		ensaf_common2_style_fields( $this, '02', 'Title', '{{WRAPPER}} .box-title a', ['3'] );
		ensaf_common_style_fields( $this, '04', 'Description', '{{WRAPPER}} .sec-text', ['3']  );

		//------Button Style-------
		ensaf_button2_style_fields( $this, '11', 'Button Styling', '{{WRAPPER}} .th_btn,{{WRAPPER}}  .link-btn,{{WRAPPER}} .th_btnth-btn,{{WRAPPER}} .th-btn', ['3','7','9','5','8','10','11']  );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="row gy-30 justify-content-center">';
				foreach( $settings['service_list'] as $data ){
					echo '<div class="col-xl-4 col-md-6">';
						echo '<div class="service-card">';
							if(!empty($data['choose_image']['url'])){
								echo '<div class="shape-mockup service_card-bg-1">';
									echo ensaf_img_tag( array(
										'url'   => esc_url( $data['choose_image']['url'] ),
									));
								echo '</div>';
							}
							if(!empty($data['choose_icon']['url'])){
								echo '<div class="box-icon">';
									echo ensaf_img_tag( array(
										'url'   => esc_url( $data['choose_icon']['url'] ),
									));
								echo '</div>';
							}
							echo '<div class="box-content">';
								if(!empty($data['title'])){
									echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
								}
								if(!empty($data['description'])){
									echo '<p class="box-text">'.esc_html($data['description']).'</p>';
								}
							echo '</div>';
							if(!empty($data['button_text'])){
								echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' || $settings['layout_style'] == '4' ){
			if( $settings['layout_style'] == '4' ){
				$class = 'bg-white';
			}else{
				$class = '';
			}
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider has-shadow" id="'.esc_attr($settings['arrow_id']).'" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}, "autoHeight": "true"}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['service_list2'] as $data ){
							echo '<div class="swiper-slide">';
								echo '<div class="service-card style-2 '.esc_attr($class).'">';
									if(!empty($data['choose_icon']['url'])){
										echo '<div class="box-icon">';
											echo ensaf_img_tag( array(
												'url'   => esc_url( $data['choose_icon']['url'] ),
											));
										echo '</div>';
									}
									echo '<div class="box-content">';
										if(!empty($data['title'])){
											echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
										}
										if(!empty($data['description'])){
											echo '<p class="box-text">'.esc_html($data['description']).'</p>';
										}
									echo '</div>';
									if(!empty($data['button_text'])){
										echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
									}
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="row gy-30 align-items-center">';
				echo '<div class="col-xl-6 pe-xl-5">';
					echo '<div class="title-area mb-2">';
						if(!empty($settings['subtitle'])){
							echo '<span class="sub-title">'.esc_html($settings['subtitle']).'</span>';
						}
						if(!empty($settings['title'])){
							echo '<h2 class="sec-title pe-xl-5">'.wp_kses_post($settings['title']).'</h2>';
						}
						if(!empty($settings['desc'])){
							echo '<p class="sec-text">'.wp_kses_post($settings['desc']).'</p>';
						}
						if(!empty($settings['button_text'])){
							echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="link-btn style-2">'.wp_kses_post($settings['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
						}
					echo '</div>';
				echo '</div>';
				foreach( $settings['service_list'] as $key =>$data ){
					echo '<div class="col-xl-6">';
						echo '<div class="service-3-item">';
							echo '<div class="service-3-item__content">';
								if(!empty($data['choose_icon']['url'])){
									echo '<div class="service-3-item__top-icon">';
										echo ensaf_img_tag( array(
											'url'   => esc_url( $data['choose_icon']['url'] ),
										));
									echo '</div>';
								}
								$dynamic_number = str_pad( $key + 1, 2, '0', STR_PAD_LEFT );
								echo '<h2 class="box-count">' . esc_html( $dynamic_number ) . '</h2>';
								echo '<div class="service-3-item__hover">';
									if(!empty($data['title'])){
										echo '<h4 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h4>';
									}
									if(!empty($data['description'])){
										echo '<p class="sec-text">'.esc_html($data['description']).'</p>';
									}
									if(!empty($data['button_text'])){
										echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style3">'.wp_kses_post($data['button_text']).'</a>';
									}
								echo '</div>';
								if(!empty($data['title'])){
									echo '<h4 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h4>';
								}
							echo '</div>';
							if(!empty($data['choose_image']['url'])){
								echo '<div class="service-3-item__thumb">';
									echo ensaf_img_tag( array(
										'url'   => esc_url( $data['choose_image']['url'] ),
									));
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}
				
			echo '</div>';

		}elseif($settings['layout_style'] == '5'){

			echo '<div class="row gy-30 justify-content-center">';
                echo '<div class="slider-area service-4">';
                    echo '<div class="swiper th-slider has-shadow" id="serviceSlider2" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"},"1400":{"slidesPerView":"4"}}, "autoHeight": "true"}\'>';
                        echo '<div class="swiper-wrapper">';
                        	foreach( $settings['service_list2'] as $data ){
	                            echo '<div class="swiper-slide">';
	                                echo '<div class="service-card style-2 style-4">';
	                                    echo '<div class="box-icon">';
	                                        echo ensaf_img_tag( array(
												'url'   => esc_url( $data['choose_icon']['url'] ),
											));
	                                    echo '</div>';
	                                    echo '<div class="box-content">';
	                                        if(!empty($data['title'])){
												echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
											}
	                                        if(!empty($data['description'])){
												echo '<p class="box-text">'.esc_html($data['description']).'</p>';
											}
	                                    echo '</div>';
	                                    if(!empty($data['button_text'])){
											echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
										}
	                                echo '</div>';
	                            echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="sec-btn mb-0">';
                        echo '<div class="icon-box">';
                            echo '<button data-slider-prev="#serviceSlider2" class="slider-arrow default show-all"><i class="far fa-arrow-left"></i></button>';
                           echo ' <button data-slider-next="#serviceSlider2" class="slider-arrow default show-all"><i class="far fa-arrow-right"></i></button>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
           echo ' </div>';

        }elseif($settings['layout_style'] == '6'){

        	echo '<div class="award-2-wrapper">';
        		foreach( $settings['service_list3'] as $data ){
	                echo '<div class="award-item">';
	                    echo '<div class="award-bg">';
	                        echo ensaf_img_tag( array(
								'url'   => esc_url( $data['choose_image']['url'] ),
							));
	                    echo '</div>';
	                    echo '<div class="row gx-0 align-items-center z-index-2">';
	                        echo '<div class="col-xxl-5 col-xl-4 col-lg-4 order-1 order-lg-0">';
	                            echo '<div class="award-title-box d-lg-flex align-items-center">';
	                                echo '<div class="award-icon">';
	                                    echo ensaf_img_tag( array(
											'url'   => esc_url( $data['choose_icon']['url'] ),
										));
	                                echo ' </div>';
	                                if(!empty($data['title'])){
		                                echo '<h3 class="award-title">'.esc_html($data['title']).'</h3>';
		                            }
	                            echo '</div>';
	                        echo '</div>';
	                        if(!empty($data['subtitle'])){
		                        echo '<div class="col-xxl-5 col-xl-6 col-lg-6 order-2 order-lg-2">';
		                            echo '<p class="award-dsc">'.esc_html($data['subtitle']).'</p>';
		                        echo '</div>';
		                    }
		                    if(!empty($data['button_url']['url'])){    
		                        echo '<div class="col-xxl-2 col-xl-2 col-lg-2 order-3 order-lg-2 text-center text-lg-end">';
		                            echo '<a href="'.esc_url($data['button_url']['url']).'" class="award-btn"><i class="fa-light fa-arrow-right-long"></i></a>';
		                        echo '</div>';
		                    }    
	                    echo '</div>';
	               echo ' </div>';
                }
            echo '</div>';

        }elseif($settings['layout_style'] == '7'){

        	echo '<div class="service-wrapper">';
                echo '<div class="row gy-30 justify-content-center text-center">';
                	foreach( $settings['service_list2'] as $data ){
	                    echo '<div class="col-xl-4 col-lg-6">';
	                        echo '<div class="service-card style-6 z-index-2">';
	                            echo '<div class="box-icon">';
	                                echo ensaf_img_tag( array(
										'url'   => esc_url( $data['choose_icon']['url'] ),
									));
	                            echo '</div>';
	                            echo '<div class="box-content">';
	                                if(!empty($data['title'])){
										echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
									}
                                    if(!empty($data['description'])){
										echo '<p class="box-text">'.esc_html($data['description']).'</p>';
									}
	                            echo '</div>';
	                            if(!empty($data['button_text'])){
	                            	echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).' <i class="fa-regular fa-arrow-right-long"></i></a>';
	                            }
	                        echo '</div>';
	                    echo '</div>';
                    }
                echo '</div>';
            echo '</div>';

        }elseif($settings['layout_style'] == '8'){

        	echo '<div class="row gy-30 align-items-center">';
                echo '<div class="slider-area">';
                    echo '<div class="swiper th-slider has-shadow service-7" id="serviceSlider2" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"}}, "autoHeight": "true"}\'>';
                        echo '<div class="swiper-wrapper">';
                        	foreach( $settings['service_list4'] as $data ){
	                            echo '<div class="swiper-slide">';
	                               echo ' <div class="service-3-item active">';
	                                    echo '<div class="service-3-item__content">';
	                                    	if(!empty($data['choose_icon']['url'])){
		                                        echo '<div class="service-3-item__top-icon">';
		                                            echo ensaf_img_tag( array(
														'url'   => esc_url( $data['choose_icon']['url'] ),
													));
		                                        echo '</div>';
		                                    }    
	                                        if(!empty($data['title'])){
	                                        	echo '<h2 class="box-count">'.wp_kses_post($data['number']).'</h2>';
	                                        }	
	                                        echo '<div class="service-3-item__hover">';
	                                        	if(!empty($data['title'])){
	                                            	echo '<h4 class="box-title">'.wp_kses_post($data['title']).'</h4>';
	                                            }
	                                            if(!empty($data['description'])){	
	                                            	echo '<p class="sec-text">'.wp_kses_post($data['description']).'</p>';
	                                            }
	                                            if(!empty($data['button_text'])){	
	                                            	echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style3">'.wp_kses_post($data['button_text']).'</a>';
	                                            }	
	                                        echo '</div>';
	                                        if(!empty($data['title'])){
	                                        	echo '<h4 class="box-title">'.wp_kses_post($data['title']).'</h4>';
	                                        }	
	                                    echo '</div>';
	                                    if(!empty($data['choose_image']['url'])){
		                                    echo '<div class="service-3-item__thumb">';
		                                        echo ensaf_img_tag( array(
													'url'   => esc_url( $data['choose_image']['url'] ),
												));
		                                    echo '</div>';
	                                    }
	                                echo '</div>';
	                            echo '</div>';
                            }
                       echo ' </div>';
                       echo ' <div class="slider-pagination"></div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }elseif($settings['layout_style'] == '9'){
        	if($settings['active_status'] == 'yes'){
        		$active_class = "active";
        	}else{
        		$active_class = "";
        	}
        	echo '<div class="service-3-item '.esc_attr($active_class).'">';
                echo '<div class="service-3-item__content">';

                    echo '<div class="service-3-item__top-icon">';
                        echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['choose_image2']['url'] ),
						));
                    echo '</div>';

                    if(!empty($settings['number'])){
                    	echo '<h2 class="box-count">'.wp_kses_post($settings['number']).'</h2>';
                    }	
                    echo '<div class="service-3-item__hover">';
                    	if(!empty($settings['title'])){
                        	echo '<h4 class="box-title">'.wp_kses_post($settings['title']).'</h4>';
                        }	
                        if(!empty($settings['subtitle'])){
                        	echo '<p class="sec-text">'.wp_kses_post($settings['subtitle']).'</p>';
                        }
                        	
                        if(!empty($settings['button_text'])){	
                        	echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style3">'.wp_kses_post($settings['button_text']).'</a>';
                        }		
                    echo '</div>';
                    if(!empty($settings['title'])){
                    	echo '<h4 class="box-title">'.wp_kses_post($settings['title']).'</h4>';
                    }
                echo '</div>';

                echo '<div class="service-3-item__thumb">';
                    echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['choose_image']['url'] ),
					));
                echo '</div>';

            echo '</div>';

        }elseif($settings['layout_style'] == '10'){

        	echo '<div class="row gy-30 justify-content-center">';
                echo '<div class="swiper has-shadow th-slider service-slider3 " id="teamSlider" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
                    echo '<div class="swiper-wrapper">';
                    	foreach( $settings['service_list2'] as $data ){
	                        echo '<div class="swiper-slide">';
	                            echo '<div class="service-card style-3">';
	                                echo '<div class="box-icon">';
	                                    echo ensaf_img_tag( array(
											'url'   => esc_url( $data['choose_icon']['url'] ),
										));
	                                echo '</div>';
	                                echo '<div class="box-content">';
	                                    if(!empty($data['title'])){
											echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
										}
	                                    if(!empty($data['description'])){
											echo '<p class="box-text">'.esc_html($data['description']).'</p>';
										}
	                                echo '</div>';
	                                if(!empty($data['button_text'])){
		                            	echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).' <i class="fa-regular fa-arrow-right-long"></i></a>';
		                            }
	                            echo '</div>';
	                        echo '</div>';
                       	}
                    echo '</div>';
                    echo '<div class="slider-pagination"></div>';
                echo '</div>';
            echo '</div>';

        }elseif($settings['layout_style'] == '11'){

        	echo '<div class="service-10-wrapper">';
                echo '<div class="row gy-30 justify-content-center">';
					foreach( $settings['service_list'] as $data ){
			        	echo '<div class="col-xl-4 col-md-6">';
			                echo '<div class="service-card">';
			                	if(!empty($data['choose_image']['url'])){
				                    echo '<div class="shape-mockup service_card-bg-1">';
				                        echo ensaf_img_tag( array(
											'url'   => esc_url( $data['choose_image']['url'] ),
										));
				                    echo '</div>';
				                }
				                if(!empty($data['choose_icon']['url'])){   
				                    echo '<div class="box-icon">';
				                        echo ensaf_img_tag( array(
											'url'   => esc_url( $data['choose_icon']['url'] ),
										));
				                    echo '</div>';
				                }    
			                    echo '<div class="box-content">';
			                        if(!empty($data['title'])){
												echo '<h3 class="box-title"><a href="'.esc_url( $data['button_url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
									}
									if(!empty($data['description'])){
										echo '<p class="box-text">'.esc_html($data['description']).'</p>';
									}
			                    echo '</div>';
			                    if(!empty($data['button_text'])){
									echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="link-btn">'.wp_kses_post($data['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
								}
			                echo '</div>';
			            echo '</div>';
					}
				echo '</div>';
			echo '</div>';
		}

	}

}