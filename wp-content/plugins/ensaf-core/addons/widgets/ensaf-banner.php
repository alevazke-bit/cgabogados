<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Banner Slider Widget.
 *
 */
class Ensaf_Banner1 extends Widget_Base {

	public function get_name() {
		return 'ensafbanner1';
	}
	public function get_title() {
		return __( 'Banner Slider', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'banner_section',
			[
				'label' 	=> __( 'Banner Slider', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', ['Style One','Style Two','Style Three','Style Four','Style Five','Style Six','Style Seven'] ); 

		ensaf_media_fields($this, 'bg', 'Choose Background', ['1','4','6','7']);
		ensaf_media_fields($this, 'overlay', 'Choose Overlay', ['1','4','6','7']);
		ensaf_media_fields($this, 'icon', 'Choose Icon', ['6','7']);
		ensaf_general_fields($this, 'rounded_text', 'Rounded Text', 'TEXTAREA2', 'Your Legal Shield',['6','7']);

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'image', 'Choose Image');
		ensaf_general_fields($repeater, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Your Legal Shield');
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA', 'Experienced Lawyers, Proven');
		ensaf_general_fields($repeater, 'title2', 'Title2', 'TEXTAREA2', 'Results');
		ensaf_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Contact us');
		ensaf_url_fields($repeater, 'button_url', 'Button URL');

		ensaf_switcher_fields( $repeater, 'show_info_box', 'Show Client Info?' );
		ensaf_media_fields($repeater, 'client_image', 'Client Image');
		ensaf_general_fields($repeater, 'client_title', 'Client  Title', 'TEXTAREA', 'Happy Client');
		ensaf_general_fields($repeater, 'client_content', 'Client Content', 'TEXTAREA', '35k Reviews');
		
		$this->add_control(
			'banner_slides',
			[
				'label' 		=> __( 'Banners', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'We offer home', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

		$banner_slides2 = new Repeater();

		ensaf_media_fields($banner_slides2, 'image', 'Choose Image');
		ensaf_general_fields($banner_slides2, 'title', 'Title', 'TEXTAREA', 'Experienced Lawyers, Proven');
		ensaf_general_fields($banner_slides2, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Your Legal Shield');
		ensaf_general_fields($banner_slides2, 'button_text', 'Button Text', 'TEXT', 'Contact us');
		ensaf_url_fields($banner_slides2, 'button_url', 'Button URL');
		ensaf_media_fields($banner_slides2, 'client_image', 'Client Image');
		ensaf_general_fields($banner_slides2, 'client_title', 'Client  Title', 'TEXTAREA', 'Happy Client');
		ensaf_general_fields($banner_slides2, 'client_content', 'Client Content', 'TEXTAREA', '35k Reviews');
		ensaf_media_fields( $banner_slides2, 'shape', 'Choose Shape' );
		ensaf_media_fields( $banner_slides2, 'tab_image', 'Tab Shape' );

		
		$this->add_control(
			'banner_slides2',
			[
				'label' 		=> __( 'Banners', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $banner_slides2->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'We offer home', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['2']
				]
			]
		);

		$banner_slides3 = new Repeater();
		ensaf_general_fields($banner_slides3, 'title', 'Title', 'TEXTAREA', 'Experienced Lawyers, Proven');
		ensaf_media_fields($banner_slides3, 'image', 'Choose Image');
		ensaf_general_fields($banner_slides3, 'button_text_one', 'Button Text One', 'TEXT', 'Contact us');
		ensaf_url_fields($banner_slides3, 'button_url_one', 'Button URL One');
		ensaf_general_fields($banner_slides3, 'button_text_two', 'Button Text Two', 'TEXT', 'Contact us');
		ensaf_url_fields($banner_slides3, 'button_url_two', 'Button URL Two');

		$this->add_control(
			'banner_slides3',
			[
				'label' 		=> __( 'Banners', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $banner_slides3->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'We offer home', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['3']
				]
			]
		);

		$banner_slides4 = new Repeater();
		ensaf_general_fields($banner_slides4, 'title', 'Title', 'TEXTAREA', 'Experienced Lawyers, Proven');
		ensaf_general_fields($banner_slides4, 'subtitle', 'Sub-Title', 'TEXTAREA', 'Subtitle');
		ensaf_media_fields($banner_slides4, 'image', 'Choose Image');
		ensaf_general_fields($banner_slides4, 'button_text_one', 'Button Text', 'TEXT', 'Contact us');
		ensaf_url_fields($banner_slides4, 'button_url_one', 'Button URL');

		$this->add_control(
			'banner_slides4',
			[
				'label' 		=> __( 'Banners', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $banner_slides4->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'We offer home', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['4','6']
				]
			]
		);


		$banner_slides5 = new Repeater();

		ensaf_general_fields($banner_slides5, 'title', 'Title', 'TEXTAREA', 'Experienced Lawyers, Proven');
		ensaf_general_fields($banner_slides5, 'subtitle', 'Sub-Title', 'TEXTAREA', 'Subtitle');
		ensaf_media_fields($banner_slides5, 'image', 'Choose Image One');
		ensaf_media_fields($banner_slides5, 'image2', 'Choose Image Two');
		ensaf_media_fields($banner_slides5, 'image3', 'Client Image');
		ensaf_general_fields($banner_slides5, 'client_title', 'Client Title', 'TEXTAREA', 'Client Title');
		ensaf_general_fields($banner_slides5, 'client_text', 'Review Text', 'TEXTAREA', 'Review Text');
		ensaf_select_field( $banner_slides5, 'client_rating', 'Client Rating', [ 'One Star', 'Two Star', 'Three Star', 'Four Star', 'Five Star' ] );
		ensaf_general_fields($banner_slides5, 'button_text_one', 'Button Text', 'TEXT', 'Contact us');
		ensaf_url_fields($banner_slides5, 'button_url_one', 'Button URL');

		$this->add_control(
			'banner_slides5',
			[
				'label' 		=> __( 'Banners', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $banner_slides5->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'We offer home', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['5']
				]
			]
		);

		$banner_slides6 = new Repeater();

		ensaf_general_fields($banner_slides6, 'title', 'Title', 'TEXTAREA', 'Experienced Lawyers, Proven');
		ensaf_general_fields($banner_slides6, 'subtitle', 'Sub-Title', 'TEXTAREA', 'Subtitle');
		ensaf_media_fields($banner_slides6, 'image', 'Choose Image');
		ensaf_media_fields($banner_slides6, 'team', 'Choose Team');
		ensaf_media_fields($banner_slides6, 'shape', 'Choose Shape');
		ensaf_general_fields($banner_slides6, 'button_text_one', 'Button Text', 'TEXT', 'Contact us');
		ensaf_url_fields($banner_slides6, 'button_url_one', 'Button URL');

		$this->add_control(
			'banner_slides6',
			[
				'label' 		=> __( 'Banners', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $banner_slides6->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'We offer home', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['7']
				]
			]
		);


		ensaf_media_fields($this, 'shape_one', 'Shape One', ['2']);
		ensaf_media_fields($this, 'shape_two', 'Shape Two', ['2']);
		ensaf_media_fields($this, 'shape_three', 'Shape Three', ['2']);
		ensaf_media_fields($this, 'shape_four', 'Shape Four', ['2']);

		ensaf_media_fields($this, 'previous_image', 'Previous Image', ['2','3','7']);
		ensaf_media_fields($this, 'next_image', 'Next Image', ['2','3','7']);

		ensaf_switcher_fields( $this, 'show_circle', 'Show Circle Text?', ['1'] );
		ensaf_media_fields($this, 'circle_icon', 'Circle Icon', ['1']);
		ensaf_general_fields($this, 'circle_title', 'Circle Title', 'TEXTAREA2', 'Best Lawyer For You', ['1']);

		ensaf_switcher_fields( $this, 'show_arrow', 'Show Arrow ID (#scroll-sec (Use id for scroll))', ['1','2','3'] );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, '01', 'Subtitle', '{{WRAPPER}} .hero-text,{{WRAPPER}} .text-white,{{WRAPPER}} .sub-title', ['1','4','2','6','7'] );
		ensaf_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .hero-title', ['1','3','4','2','6','7'] );

		ensaf_common_style_fields( $this, '001', 'Client Title', '{{WRAPPER}} .client-group-wrap__box-title', ['1','2'] );
		ensaf_common_style_fields( $this, '002', 'Client Content', '{{WRAPPER}} .client-group-wrap__box-review', ['1','2'] );
		//------Button Style-------
		ensaf_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th-btn,{{WRAPPER}} .th-btn.style2', ['1','3','4','2','6','7'] );
		ensaf_button_style_fields( $this, '11', 'Button Styling Two', '{{WRAPPER}} .th-btn.style3', ['3'] );

    }

	protected function render() {

    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="th-hero-wrapper hero-1">';
				if($settings['show_circle'] == 'yes'){
					echo '<div class="shape-mockup hero-img-shape-1">';
						echo '<div class="logo-icon-wrap">';
							if($settings['circle_icon']['url'] ){
								echo '<h4 class="logo-icon">';
									echo ensaf_img_tag( array(
										'url'   => esc_url( $settings['circle_icon']['url'] ),
									));
								echo '</h4>';
							}
							if(!empty($settings['circle_title'])){
								echo '<div class="logo-icon-wrap__text">';
									echo '<span class="logo-animation">'.esc_html($settings['circle_title']).'</span>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}
				echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
					echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['overlay']['url'] ),
					)); 
				echo '</div>';
				if($settings['show_arrow'] == 'yes'){
					echo '<div class="hero-1-scroll-icon-bg-shape scroll-down">';
						echo '<div class="hero-1-scroll-icon-wrap">';
							echo '<a href="#scroll-sec">';
								echo '<div class="shape-thumb">';
									echo '<div class="icon-btn">';
										echo '<i class="fa-sharp fa-solid fa-arrow-down"></i>';
									echo '</div>';
									echo '<img src="'.ENSAF_ASSETS.'img/shape/hero-1-scroll-icon.png">';
								echo '</div>';
							echo '</a>';
						echo '</div>';
					echo '</div>';
				}
		
				echo '<div class="swiper th-slider " id="heroSlidee1" data-slider-options=\'{"effect":"fade", "autoHeight": "true"}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['banner_slides'] as $key => $data ){
							echo '<div class="swiper-slide">';
								echo '<div class="hero-inner hero-style1">';
									echo '<div class="container">';
										echo '<div class="row  gy-4 align-items-center">';
											echo '<div class="col-xl-7 col-lg-7">';
												if(!empty($data['subtitle'])){
													echo '<span class="sub-title" data-ani="slideinup" data-ani-delay="0.2s">'.esc_html($data['subtitle']).'</span>';
												}
												echo '<div data-ani="slideinup" data-ani-delay="0.4s">';
													if(!empty($data['title'])){
														echo '<h1 class="hero-title">'.esc_html($data['title']).'</h1>';
													}
													echo '<div class="hero-title">';
													echo esc_html($data['title2']);
														if($data['show_info_box'] == 'yes'){
															echo '<div class="client-group-wrap">';
																if($data['client_image']['url'] ){
																	echo '<span class="thumb">';
																		echo ensaf_img_tag( array(
																			'url'   => esc_url( $data['client_image']['url'] ),
																		));
																	echo '</span>';
																}
																echo '<div class="client-group-wrap__content">';
																	if(!empty($data['client_title'])){
																		echo '<span class="client-group-wrap__box-title">'.wp_kses_post($data['client_title']).'</span>';
																	}
																	if(!empty($data['client_content'])){
																		echo '<div class="client-group-wrap__box-review">'.wp_kses_post($data['client_content']).'</div>';
																	}
																echo '</div>';
															echo '</div>';
														}
													echo '</div>';
												echo '</div>';
												if(!empty($data['button_text'])){
													echo '<div class="btn-group justify-content-center" data-ani="slideinup" data-ani-delay="0.6s">';
														echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn">'.esc_html($data['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
													echo '</div>';
												}
											echo '</div>';
											echo '<div class="col-xl-5 col-lg-5">';
												if($data['image']['url'] ){
													echo '<div class="hero-img">';
														echo '<div class="img-main" data-ani="slideinrighthero" data-ani-delay="0.8s">';
															echo ensaf_img_tag( array(
																'url'   => esc_url( $data['image']['url'] ),
															)); 
														echo '</div>';
													echo '</div>';
												}
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
					echo '<div class="slider-pagination"></div>';
				echo '</div>';
			echo '</div>';
           
		}elseif( $settings['layout_style'] == '2' ){
			
			echo '<div class="th-hero-wrapper hero-1 position-relative">';
				if(!empty( $settings['shape_one']['url'])):
			        echo '<div class="shape-mockup jump z-index-1" data-top="2%" data-left="2%">';
			           	echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape_one']['url'] ),
						)); 
			        echo '</div>';
			    endif;
			    if(!empty( $settings['shape_two']['url'])):
			        echo '<div class="shape-mockup jump z-index-1" data-bottom="0%" data-left="0%">';
			            echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape_two']['url'] ),
						));
			        echo '</div>';
			    endif;
			    if(!empty( $settings['shape_three']['url'])):    
			        echo '<div class="shape-mockup z-index-1 d-none d-xxl-block" data-bottom="0%" data-right="0%">';
			            echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape_three']['url'] ),
						));
			        echo '</div>';
			    endif;
			    if(!empty( $settings['shape_four']['url'])):     
			        echo '<div class="th-hero-bg">';
			            echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape_four']['url'] ),
						));
			        echo '</div>';
			    endif;    
				echo '<div class="swiper th-slider" id="heroSlider4" data-slider-options=\'{"effect":"fade", "autoHeight": "false","thumbs":{"swiper":".thumb-slider4"}}\'>';
		            echo '<div class="swiper-wrapper">';
		            	foreach( $settings['banner_slides2'] as $key => $data ){
			                echo '<div class="swiper-slide">';
			                    echo '<div class="hero-inner hero-style4">';
			                        echo '<div class="container">';
			                            echo '<div class="row  gy-4 align-items-center justify-content-center">';
			                                echo '<div class="col-xl-7 col-lg-9">';
			                                    echo '<div class="hero-content text-center text-xl-start">';
			                                    	if(!empty( $data['shape']['url'])){
			                                    		echo '<span class="ensaf-shape d-none d-xl-block">';
				                                        	echo ensaf_img_tag( array(
																'url'   => esc_url( $data['shape']['url'] ),
															));
				                                        echo '</span>';	
			                                    	}
				                                        
			                                        if(!empty($data['subtitle'])){
			                                        	echo '<span class="sub-title" data-ani="slideinup" data-ani-delay="0.2s">'.wp_kses_post($data['subtitle']).'</span>';
			                                        }
			                                        if(!empty($data['title'])){	
				                                        echo '<div data-ani="slideinup" data-ani-delay="0.4s">';
				                                            echo '<h1 class="hero-title">'.wp_kses_post($data['title']).'</h1>';
				                                        echo '</div>';
				                                    }    
			                                        echo '<div class="btn-group justify-content-center" data-ani="slideinup" data-ani-delay="0.6s">';
			                                        	if(!empty($data['button_text'])){
			                                            	echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn">'.wp_kses_post($data['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
			                                            }	
			                                            echo '<span class="client-group-wrap">';
			                                            	if(!empty( $data['client_image']['url'])):
				                                                echo '<span class="thumb">';
				                                           			echo ensaf_img_tag( array(
																		'url'   => esc_url( $data['client_image']['url'] ),
																	)); 
				                                                echo '</span>';
				                                            endif;
			                                                echo '<span class="client-group-wrap__content">';
																if(!empty($data['client_title'])){
				                                                    echo '<span class="client-group-wrap__box-title">';
				                                       					echo wp_kses_post($data['client_title']);
				                                                    echo '</span>';
				                                                }
			                                                    if(!empty($data['client_content'])){	
			                                                    	echo '<span class="client-group-wrap__box-review">'.wp_kses_post($data['client_content']).'</span>';
			                                                    }	
			                                                echo '</span>';
			                                            echo '</span>';
			                                        echo '</div>';
			                                    echo '</div>';
			                                echo '</div>';
			                                if(!empty( $data['image']['url'])):
				                                echo '<div class="col-xl-5">';
				                                    echo '<div class="hero-img text-center text-xl-end z-index-2">';
				                                        echo '<div class="img-main slideinright" data-ani="slideinrighthero" data-ani-delay="0.8s">';
				                                           echo ensaf_img_tag( array(
																'url'   => esc_url( $data['image']['url'] ),
															)); 
				                                        echo '</div>';
				                                    echo '</div>';
				                                echo '</div>';
				                            endif;    
			                            echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>';
		                }
		            echo '</div>';
		        echo '</div>';

		        echo '<div class="slider-thumb-area slider-4-thumb-box">';
		            echo '<div class="swiper th-slider thumb-slider4 slider-tab" data-slider-options=\'{"loop":true,"autoplay":"true","direction":"vertical","centeredSlides":true,"slideToClickedSlide":true,"watchSlidesVisibility":true,"watchSlidesProgress":true,"centeredSlidesBounds":true,"breakpoints":{"0":{"slidesPerView":3},"576":{"slidesPerView":"3"}}}\'>';
		                echo '<div class="swiper-wrapper">';
		                	foreach( $settings['banner_slides2'] as $key => $data ){
			                    echo '<div class="swiper-slide">';
			                        echo '<div class="tab-btn slider-4-thumb-box">';
			                            echo ensaf_img_tag( array(
											'url'   => esc_url( $data['tab_image']['url'] ),
										)); 
			                       echo ' </div>';
			                    echo '</div>';
		                    }
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		        if($settings['show_arrow'] == 'yes'){
			        echo '<div class="slider-4-pagination">';
			            echo '<button data-slider-prev="#heroSlider4" class="slider-arrow default">';
			               	echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['previous_image']['url'] ),
							)); 
			            echo '</button>';
			            echo '<button data-slider-next="#heroSlider4" class="slider-arrow default">';
			                echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['next_image']['url'] ),
							)); 
			           echo ' </button>';
			        echo '</div>';
			    }    
		    echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
    
			echo '<div class="th-hero-wrapper position-relative">';
		        echo '<div class="swiper th-slider" id="heroSlider2" data-slider-options=\'{"pagination":true,"effect":"fade", "autoHeight": "true"}\'>';
		            echo '<div class="swiper-wrapper">';
		            	foreach( $settings['banner_slides3'] as $key => $data ){
			                echo '<div class="swiper-slide">';
			                	if(!empty( $data['image']['url'])):
			                    	echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['image']['url'] ).'"></div>';
			                    endif;	
			                    echo '<div class="hero-inner-5">';
			                        echo '<div class="container">';
			                            echo '<div class="row gy-4 gx-0 align-items-center">';
			                                echo '<div class="col-xl-8 col-lg-10">';
			                                    echo '<div class="hero-content-5">';
			                                    	if(!empty($data['title'])){
			                                       	 	echo '<h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.4s">'.wp_kses_post($data['title']).'</h1>';
			                                       	} 	
			                                        echo '<div class="btn-group" data-ani="slideinup" data-ani-delay="0.8s">';
				                                        if(!empty($data['button_text_one'])){
				                                            echo '<a href="'.esc_url( $data['button_url_one']['url'] ).'" class="th-btn style2">'.wp_kses_post($data['button_text_one']).' <i class="fa-regular fa-arrow-right-long"></i></a>';
				                                        }
				                                        if(!empty($data['button_text_two'])){    
			                                            	echo '<a href="'.esc_url( $data['button_url_two']['url'] ).'" class="th-btn style3">'.wp_kses_post($data['button_text_two']).' <i class="fa-regular fa-arrow-right-long"></i></a>';
			                                            }	
			                                        echo '</div>';
			                                    echo '</div>';
			                                echo '</div>';
			                            echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>';
		                }
		            echo ' </div>';
		            if($settings['show_arrow'] == 'yes'){
			            echo '<div class="slider-5-control">';
			                echo '<div class="slider-pagination2"></div>';
			                echo '<div class="slider-4-pagination">';
			                    echo '<button data-slider-prev="#heroSlider2" class="slider-arrow default show-all">';
			                        echo ensaf_img_tag( array(
										'url'   => esc_url( $settings['previous_image']['url'] ),
									)); 
			                    echo '</button>';
			                    echo '<button data-slider-next="#heroSlider2" class="slider-arrow default show-all">';
			                        echo ensaf_img_tag( array(
										'url'   => esc_url( $settings['next_image']['url'] ),
									)); 
			                    echo '</button>';
			                echo '</div>';
			            echo '</div>';
			        }    
		        echo '</div>';
		    echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){  

			echo '<div class="th-hero-wrapper">';
				if(!empty($settings['bg']['url'])){
					echo '<div class="shape-mockup jump z-index-1" data-top="2%" data-right="2%">';
			            echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['bg']['url'] ),
						));
			        echo '</div>';
				}

				if(!empty($settings['overlay']['url'])){
					echo '<div class="th-hero-bg">';
			            echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['overlay']['url'] ),
						));
			        echo '</div>';
				}
		         
		        echo '<div class="swiper th-slider slider-7 " id="heroSlidee1" data-slider-options=\'{"effect":"fade", "autoHeight": "true"}\'>';
		            echo '<div class="swiper-wrapper">';
		            	foreach( $settings['banner_slides4'] as $key => $data ){
			                echo '<div class="swiper-slide">';
			                    echo '<div class="hero-inner hero-style7">';
			                        echo '<div class="container">';
			                            echo '<div class="row gy-4 align-items-start">';
			                                echo '<div class="col-xxl-8 col-xl-7 col-lg-8">';
				                                if(!empty($data['title'])){
				                                    echo '<div data-ani="slideinup" data-ani-delay="0.4s">';
				                                        echo '<h1 class="hero-title">'.wp_kses_post($data['title']).'</h1>';
				                                    echo '</div>';
				                                }    
			                                echo '</div>';
			                                echo '<div class="col-xxl-4 col-xl-5 col-lg-9">';
			                                	if(!empty($data['subtitle'])){
			                                    	echo '<p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.5s">'.wp_kses_post($data['subtitle']).'</p>';
			                                    }
			                                    if(!empty($data['button_text_one'])){		
				                                    echo '<div class="btn-group justify-content-center" data-ani="slideinup" data-ani-delay="0.6s">';
				                                        echo '<a href="'.esc_url( $data['button_url_one']['url'] ).'" class="th-btn">'.wp_kses_post($data['button_text_one']).' <i class="fa-regular fa-arrow-right-long"></i></a>';
				                                    echo '</div>';
				                                }    
			                                echo '</div>';
			                            echo '</div>';
			                        echo '</div>';
			                        if(!empty($data['image']['url'])){
				                        echo '<div class="hero-img">';
				                            echo '<div class="img-main" data-ani="slideinrighthero" data-ani-delay="0.8s">';
				                                echo ensaf_img_tag( array(
													'url'   => esc_url( $data['image']['url'] ),
												));
				                            echo '</div>';
				                        echo '</div>';
			                        }
			                    echo '</div>';
			                echo '</div>';
		               	}
		            echo '</div>';
		            echo '<div class="slider-pagination"></div>';
		        echo '</div>';
		    echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){

			echo '<div class="th-hero-8-area">';
		        echo '<div class="hero-8-wrapper">';
		            echo '<div class="swiper th-slider" id="heroSlider2" data-slider-options=\'{"effect":"fade", "autoHeight": "true","thumbs":{"swiper":".thumb-slider3"}}\'>';
		                echo '<div class="swiper-wrapper">';
		                	foreach( $settings['banner_slides5'] as $key => $data ){
			                    echo '<div class="swiper-slide">';
			                        echo '<div class="th-hero-bg" data-bg-src="'.esc_url($data['image']['url']).'">';
			                            echo '<div class="hero-inner z-index-2">';
			                                echo '<div class="container">';
			                                    echo '<div class="row gy-4 gx-0 align-items-xl-center justify-content-center justify-xl-content-start text-center text-xl-start">';
			                                        echo '<div class="col-xxl-8 col-xl-7 col-lg-8">';
			                                            echo '<div class="hero-style8">';
			                                            	if(!empty($data['title'])){
			                                                	echo '<h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.4s">'.wp_kses_post($data['title']).'</span></h1>';
			                                                }
			                                                if(!empty($data['subtitle'])){	
			                                                	echo '<p class="box-text text-white mb-40" data-ani="slideinup" data-ani-delay="0.7s">'.wp_kses_post($data['subtitle']).'</p>';
			                                                }	
			                                                echo '<div class="btn-group justify-content-center" data-ani="slideinup" data-ani-delay="0.9s">';
			                                                	if(!empty($data['button_text_one'])){	
			                                                    	echo '<a href="'.esc_url( $data['button_url_one']['url'] ).'" class="th-btn style2">'.wp_kses_post($data['button_text_one']).' <i class="fas fa-arrow-up-right"></i></a>';
			                                                    }	
			                                                    echo '<div class="client-group-wrap">';
			                                                        echo '<span class="thumb">';
			                                                            echo ensaf_img_tag( array(
																			'url'   => esc_url( $data['image3']['url'] ),
																		));
			                                                        echo '</span>';
			                                                        if(!empty($data['client_title'] || $data['client_text'])){
				                                                        echo '<div class="client-group-wrap__content mt-0">';
				                                                            echo '<span class="client-group-wrap__box-title text-white">';
				                                                                echo wp_kses_post($data['client_title']);
				                                                            echo '</span>';
				                                                            echo '<div class="client-group-wrap__box-review">';
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
				                                                                echo '<p>'.wp_kses_post($data['client_text']).'</p>';
				                                                            echo '</div>';
				                                                        echo '</div>';
				                                                    }
			                                                    echo '</div>';
			                                                echo '</div>';
			                                            echo '</div>';
			                                        echo '</div>';
			                                        echo '<div class="col-xl-4">';
			                                            echo '<div class="hero-img">';
			                                           	 	echo ensaf_img_tag( array(
																'url'   => esc_url( $data['image2']['url'] ),
															));
			                                            echo '</div>';
			                                        echo '</div>';
			                                    echo '</div>';
			                                echo '</div>';
			                            echo '</div>';
			                       echo ' </div>';
			                    echo '</div>';
		                    }
		                    echo '<div class="slider-pagination"></div>';
		                echo '</div>';
		           echo ' </div>';
		        echo '</div>';
		    echo '</div> ';

		}elseif( $settings['layout_style'] == '6' ){

			echo '<div class="th-hero-wrapper">';
		        echo '<div class="shape-mockup hero-img-shape-1">';
		            echo '<div class="logo-icon-wrap">';
		            	if(!empty($settings['icon']['url'] )){
			                echo '<div class="logo-icon">';
			                 	echo ensaf_img_tag( array(
									'url'   => esc_url( $settings['icon']['url'] ),
								));
			                echo '</div>';
			            }
			            if(!empty($settings['rounded_text'])){
			                echo '<div class="logo-icon-wrap__text">';
			                    echo '<span class="logo-animation">'.wp_kses_post($settings['rounded_text']).'</span>';
			                echo '</div>';
			            }
		           echo ' </div>';
		        echo '</div>';

		       
		        echo '<div class="swiper th-slider slider-9 bg-mask" data-mask-src="'.esc_url( $settings['bg']['url'] ).'" id="heroSlider2" data-slider-options=\'{"effect":"fade", "autoHeight": "true","thumbs":{"swiper":".thumb-slider3"}}\'>';
		            echo '<div class="swiper-wrapper">';
		            	foreach( $settings['banner_slides4'] as $key => $data ){
			                echo '<div class="swiper-slide">';
			                	if(!empty($data['image']['url'])){
			                		echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['image']['url'] ).'"></div>';
			                	}
			                    echo '<div class="hero-inner hero-style9">';
			                        echo '<div class="container">';
			                            echo '<div class="row gy-4 gx-0 align-items-center">';
			                                echo '<div class="col-xl-6 col-lg-9">';
			                                    echo '<div class="hero-content9">';
			                                    	if(!empty($data['title'])){
			                                        	echo '<h1 class="hero-title" data-ani="slideinup" data-ani-delay="0.3s">'.wp_kses_post($data['title']).'</h1>';
			                                        }
			                                        if(!empty($data['subtitle'])){	
			                                        	echo '<p class="box-text text-white mb-30" data-ani="slideinup" data-ani-delay="0.5s">'.wp_kses_post($data['subtitle']).'</p>';
			                                        }
			                                        if(!empty($data['button_text_one'])){		
				                                        echo '<div class="btn-group justify-content-center" data-ani="slideinup" data-ani-delay="0.7s">';
				                                            echo '<a href="'.esc_url( $data['button_url_one']['url'] ).'" class="th-btn style2">'.wp_kses_post($data['button_text_one']).' <i class="fa-regular fa-arrow-right-long"></i></a>';
				                                        echo '</div>';
				                                    }    
			                                    echo '</div>';
			                                echo '</div>';
			                            echo '</div>';
			                        echo '</div>';
			                   echo ' </div>';
			                echo '</div>';
		                }
		            echo '</div>';
		            echo '<div class="slider-pagination"></div>';
		        echo '</div>';
		    echo '</div>';

		}elseif( $settings['layout_style'] == '7' ){

			echo '<div class="th-hero-wrapper position-relative">';
				if(!empty($settings['bg']['url'])){
			        echo '<div class="shape-mockup jump z-index-1" data-bottom="0" data-left="0">';
			           	echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['bg']['url'] ),
						));
			        echo '</div>';
			    }    
		        echo '<div class="shape-mockup hero-10-circle">';
		            echo '<div class="logo-icon-wrap">';
		            	if(!empty($settings['icon']['url'])){
			                echo '<div class="logo-icon">';
			                    echo ensaf_img_tag( array(
									'url'   => esc_url( $settings['icon']['url'] ),
								));
			                echo '</div>';
			            }    
		                echo '<div class="logo-icon-wrap__text">';
		                    echo '<span class="logo-animation">'.wp_kses_post($settings['rounded_text']).'</span>';
		                echo '</div>';

		            echo '</div>';
		        echo '</div>';
		        if(!empty($settings['overlay']['url'])){
			        echo '<div class="th-hero-bg">';
			            echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['overlay']['url'] ),
						));
			        echo '</div>';
			    }    
		        echo '<div class="swiper th-slider" id="heroSlidee1" data-slider-options=\'{"effect":"fade", "autoplay": "true","thumbs":{"swiper":".thumb-slider4"}}\'>';
		            echo '<div class="swiper-wrapper">';
		            	foreach( $settings['banner_slides6'] as $key => $data ){
			                echo '<div class="swiper-slide">';
			                    echo '<div class="hero-inner hero-style10">';
			                        echo '<div class="container">';
			                            echo '<div class="row  gy-4 align-items-center">';
			                                echo '<div class="col-xl-6 col-lg-6">';
			                                    echo '<div class="hero-content text-center text-lg-start">';
			                                    	if(!empty($data['title'])){
				                                        echo '<div data-ani="slideinup" data-ani-delay="0.3s">';
				                                            echo '<h1 class="hero-title">'.wp_kses_post($data['title']).'</h1>';
				                                        echo '</div>';
				                                    }
				                                    if(!empty($data['subtitle'])){    
			                                        	echo '<p class="box-text mb-35 text-white" data-ani="slideinup" data-ani-delay="0.5s">'.wp_kses_post($data['subtitle']).'</p>';
			                                        }
			                                        if(!empty($data['button_text_one'])){ 	
				                                        echo '<div class="btn-group justify-content-center" data-ani="slideinup" data-ani-delay="0.7s">';
				                                            echo '<a href="'.esc_url( $data['button_url_one']['url'] ).'" class="th-btn">'.wp_kses_post($data['button_text_one']).' <i class="fa-regular fa-arrow-right-long"></i></a>';
				                                        echo '</div>';
				                                    }    
			                                    echo '</div>';
			                                echo '</div>';
			                           echo ' </div>';
			                        echo '</div>';
			                        if(!empty($data['image']['url'])){
			                        	$image_one= get_template_directory_uri().'/assets/img/hero-10-shape.png';  
				                        echo '<div class="hero-img text-end z-index-2 bg-mask" data-mask-src="'.esc_url($image_one).'">';
				                            echo '<div class="img-main" data-ani="slideinrighthero" data-ani-delay="0.9s">';
				                              	echo ensaf_img_tag( array(
													'url'   => esc_url( $data['image']['url'] ),
												));
				                            echo '</div>';
				                        echo '</div>';
			                        }
			                    echo '</div>';
			                echo '</div>';
		               	}
		            echo ' </div>';
		        echo '</div>';
		        echo '<div class="slider-10-control d-none d-sm-block">';
		        echo '<div class="slider-thumb-area slider-10-thumb-box">';
		                echo '<div class="swiper th-slider thumb-slider4 slider-tab" data-slider-options=\'{"loop":true,"autoplay":"true","centeredSlides":true,"slideToClickedSlide":true,"watchSlidesVisibility":true,"watchSlidesProgress":true,"centeredSlidesBounds":true,"breakpoints":{"0":{"slidesPerView":3},"576":{"slidesPerView":"3"}}}\'>';
		                    echo '<div class="swiper-wrapper">';
		                    	foreach( $settings['banner_slides6'] as $key => $data ){
			                        echo '<div class="swiper-slide">';
			                            echo '<div class="tab-btn slider-4-thumb-box">';
			                              	echo ensaf_img_tag( array(
												'url'   => esc_url( $data['team']['url'] ),
											));
			                            echo '</div>';
			                        echo '</div>';
		                        }
		                   echo '</div>';
		                echo '</div>';
		            echo '</div>';

		            echo '<div class="slider-4-pagination">';

		                echo '<button data-slider-prev="#heroSlidee1" class="slider-arrow default show-all">';
		                    echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['previous_image']['url'] ),
							)); 
		                echo '</button>';

		                echo '<button data-slider-next="#heroSlidee1" class="slider-arrow default show-all">';
		                    echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['next_image']['url'] ),
							)); 
		                echo '</button>';

		            echo ' </div>';

		       echo '</div>';
		    echo '</div>';   

		}

		
	}

} 