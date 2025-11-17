<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Banner Widget.
 *
 */
class ensaf_Banner2 extends Widget_Base {

	public function get_name() {
		return 'ensafbanner2';
	}
	public function get_title() {
		return __( 'Banner / Hero', 'ensaf' );
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
				'label' 	=> __( 'Banner', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two','Style Three' ] );

		ensaf_media_fields( $this, 'bg', 'Choose Background', ['2','3'] );
		ensaf_media_fields( $this, 'image', 'Choose Image', ['1', '2','3'] );

		ensaf_general_fields( $this, 'subtitle', 'Subitle', 'TEXTAREA2', 'Your Legal Champion',['3','1'] );
		ensaf_general_fields( $this, 'title', 'Title', 'TEXTAREA', 'Precision Legal Work, Attorneys Who Care',['3','1'] );
		ensaf_general_fields( $this, 'desc', 'Description', 'TEXTAREA', '', ['2'] );
        
		ensaf_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'Contact us',['3','1']  );
		ensaf_url_fields( $this, 'button_url', 'Button URL',['3','1']  );
		ensaf_general_fields( $this, 'button_text2', 'Button Text', 'TEXT', 'About us', ['2','3'] );
		ensaf_url_fields( $this, 'button_url2', 'Button URL', ['2','3'] );

		ensaf_switcher_fields( $this, 'show_thumb', 'Show Thumb Box?', ['1', '2','3'] );
		ensaf_media_fields($this, 'thumb_img', 'Thumb Image', ['1', '2','3']);
		ensaf_general_fields($this, 'thumb_title', 'Thumb Title', 'TEXTAREA', 'Happy Client', ['1', '2','3']);
		ensaf_general_fields($this, 'thumb_desc', 'Thumb Content', 'TEXTAREA', '', ['1', '2','3']);
		ensaf_general_fields($this, 'thumb_rating', 'Thumb Rating', 'TEXTAREA2', 'Thumb Rating', ['3']);

		ensaf_media_fields( $this, 'shape', 'Choose Shape', ['1', '2','3'] );
		ensaf_media_fields( $this, 'shape2', 'Choose Shape', ['1', '2','3'] );
		ensaf_media_fields( $this, 'shape3', 'Choose Shape', ['2'] );
        
		ensaf_switcher_fields( $this, 'show_circle', 'Show Circle Text?', ['1', '2'] );
		ensaf_media_fields($this, 'circle_icon', 'Circle Icon', ['1', '2']);
		ensaf_general_fields($this, 'circle_title', 'Circle Title', 'TEXTAREA2', 'Best Lawyer For You', ['1', '2']);

		
		ensaf_general_fields($this, 'shadow_text', 'Shadow Title', 'TEXTAREA2', 'Shadow Title', ['3']);

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Subtitle Style-------
		ensaf_common_style_fields( $this, 'subtitle', 'Subtitle', '{{WRAPPER}} .sub,{{WRAPPER}} .box-text ');
		ensaf_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title,{{WRAPPER}} .hero-title' );
		ensaf_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .desc', ['2'] );
		//------Button Style-------
		ensaf_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th_btn,{{WRAPPER}} .th-btn' );
		ensaf_button_style_fields( $this, '11', 'Button Styling', '{{WRAPPER}} .th_btn2,{{WRAPPER}} .th-btn.style3', ['2','3'] );

    }

	protected function render() {

    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="th-hero-wrapper hero-2" id="hero">';
				if($settings['show_circle'] == 'yes'){
					echo '<div class="shape-mockup hero-2-logo-shape">';
						echo '<div class="logo-icon-wrap">';
							if($settings['circle_icon']['url'] ){
								echo '<h4 class="logo-icon">';
									echo ensaf_img_tag( array(
										'url'   => esc_url( $settings['circle_icon']['url'] ),
									));
								echo '</h4>';
							}
							if(!empty($settings['circle_title'])){
								echo '<div class="logo-icon-wrap__text bg-theme2">';
									echo '<span class="logo-animation">'.esc_html($settings['circle_title']).'</span>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}

				if(!empty($settings['shape']['url'])){
					echo '<div class="shape-mockup hero-2-lft-shape" data-left="0" data-bottom="0">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape']['url'] ),
						));
					echo '</div>';
				}
				if(!empty($settings['shape2']['url'])){
					echo '<div class="shape-mockup hero-2-top-shape d-xl-block d-none">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape2']['url'] ),
						));
					echo '</div>';
				}
				if(!empty($settings['image']['url'])){
					echo '<div class="shape-mockup hero-2-right-main">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}

				echo '<div class="hero-inner">';
					echo '<div class="container">';
						echo '<div class="row align-items-center">';
							echo '<div class="col-12">';
								echo '<div class="hero-style2">';
									if(!empty($settings['subtitle'])){
										echo '<span class="sub-title sub">'.esc_html($settings['subtitle']).'</span>';
									}
									if(!empty($settings['title'])){
										echo '<h1 class="hero-title title">'.wp_kses_post($settings['title']).'</h1>';
									}
									echo '<div class="btn-group justify-content-center">';
										if(!empty($settings['button_text'])){
											echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style2 th_btn">'.wp_kses_post($settings['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
										}
										if($settings['show_thumb'] == 'yes'){
											echo '<div class="client-group-wrap">';
												if($settings['thumb_img']['url'] ){
													echo '<span class="thumb">';
														echo ensaf_img_tag( array(
															'url'   => esc_url( $settings['thumb_img']['url'] ),
														));
													echo '</span>';
												}
												echo '<div class="client-group-wrap__content">';
													if(!empty($settings['thumb_title'])){
														echo '<span class="client-group-wrap__box-title">'.wp_kses_post($settings['thumb_title']).'</span>';
													}
													if(!empty($settings['thumb_desc'])){
														echo '<div class="client-group-wrap__box-review">'.wp_kses_post($settings['thumb_desc']).'</div>';
													}
												echo '</div>';
											echo '</div>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				
			echo '</div>';
           
		}elseif( $settings['layout_style'] == '2' ){

		    echo '<div class="th-hero-wrapper hero-3" id="hero3" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				if(!empty($settings['shape']['url'])){
					echo '<div class="shape-mockup jump-reverse" data-left="0%" data-bottom="0%">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape']['url'] ),
						));
					echo '</div>';
				}
				if(!empty($settings['shape2']['url'])){
					echo '<div class="shape-mockup jump-reverse d-none d-sm-block" data-right="0%" data-bottom="0%">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape2']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="container">';
					echo '<div class="row  gy-4 align-items-center">';
						echo '<div class="col-xl-7 col-lg-7">';
							echo '<div class="hero-style3">';
								if(!empty($settings['subtitle'])){
									echo '<span class="sub-title text-center text-lg-start sub">'.esc_html($settings['subtitle']).'</span>';
								}
								if(!empty($settings['title'])){
									echo '<h1 class="hero-title title">'.wp_kses_post($settings['title']).'</h1>';
								}
								if(!empty($settings['desc'])){
									echo '<p class="hero-text desc">'.wp_kses_post($settings['desc']).'</p>';
								}
								echo '<div class="btn-group justify-content-center">';
									if(!empty($settings['button_text'])){
										echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn th_btn">'.wp_kses_post($settings['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
									}
									if(!empty($settings['button_text2'])){
										echo '<a href="'.esc_url( $settings['button_url2']['url'] ).'" class="th-btn style3 th_btn2">'.wp_kses_post($settings['button_text2']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
									}
								echo '</div>';
								if($settings['show_thumb'] == 'yes'){
									echo '<div class="client-group-wrap">';
										if($settings['thumb_img']['url'] ){
											echo '<span class="thumb">';
												echo ensaf_img_tag( array(
													'url'   => esc_url( $settings['thumb_img']['url'] ),
												));
											echo '</span>';
										}
										echo '<div class="client-group-wrap__content">';
											if(!empty($settings['thumb_title'])){
												echo '<span class="client-group-wrap__box-title">'.wp_kses_post($settings['thumb_title']).'</span>';
											}
											if(!empty($settings['thumb_desc'])){
												echo '<div class="client-group-wrap__box-review">'.wp_kses_post($settings['thumb_desc']).'</div>';
											}
										echo '</div>';
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
						echo '<div class="col-xl-5 col-lg-5">';
							echo '<div class="hero-img shape-mockup-wrap">';
								if($settings['show_circle'] == 'yes'){
									echo '<div class="shape-mockup logo-icon-hero-3">';
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
								if(!empty($settings['image']['url'])){
									echo '<div class="img-main">';
										if(!empty($settings['shape3']['url'])){
											echo '<div class="hero_3_1-shape">';
												echo ensaf_img_tag( array(
													'url'   => esc_url( $settings['shape3']['url'] ),
												));
											echo '</div>';
										}
										echo ensaf_img_tag( array(
											'url'   => esc_url( $settings['image']['url'] ),
										));
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){

			echo '<div class="th-hero-wrapper">';
		        echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
		            echo '<img class="hero-6-overlay" src="'.esc_url( $settings['image']['url'] ).'" alt="'.get_bloginfo('title').'">';
		        echo '</div>';
		        echo '<div class="hero-inner hero-style6">';
		            echo '<div class="container">';
		                echo '<div class="row gy-4 align-items-center">';
		                    echo '<div class="col-xl-7 col-lg-7">';
		                        echo '<div class="hero-content">';
		                        	if(!empty($settings['title'])){
		                            	echo '<h1 class="hero-title">'.wp_kses_post($settings['title']).'</h1>';
		                            }
		                            if(!empty($settings['subtitle'])){	
		                            	echo '<p class="box-text text-white mb-40">'.wp_kses_post($settings['subtitle']).'</p>';
		                            }
		                            if(!empty($settings['button_text'] || $settings['button_text2'])){
			                            echo '<div class="btn-group mb-50 justify-content-center">';
			                            	if(!empty($settings['button_text'])){
			                                	echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn">'.wp_kses_post($settings['button_text']).' <i class="fa-regular fa-arrow-right-long"></i></a>';
			                                }
			                                if(!empty($settings['button_text2'])){	
			                                	echo '<a href="'.esc_url( $settings['button_url2']['url'] ).'" class="th-btn style3">'.wp_kses_post($settings['button_text2']).' <i class="fa-regular fa-arrow-right-long"></i></a>';
			                                }
			                            echo '</div>';
			                        }
			                        if($settings['show_thumb'] == 'yes'){
			                            echo '<div class="client-group-wrap">';
			                            	if(!empty($settings['shape']['url'])):
				                                echo '<span class="thumb">';
				                                    echo ensaf_img_tag( array(
														'url'   => esc_url( $settings['thumb_img']['url'] ),
													));
				                                echo '</span>';
				                            endif;
				                            if(!empty($settings['thumb_title'] || $settings['thumb_desc'])):    
				                                echo '<div class="client-group-wrap__content">';
				                                    echo '<span class="client-group-wrap__box-title text-white">';
				                                      	echo  wp_kses_post($settings['thumb_title']);
				                                    echo '</span>';
				                                    echo '<div class="client-group-wrap__box-review">';
				                                        echo  wp_kses_post($settings['thumb_rating']);
				                                        echo'<p>';
				                                        	echo  wp_kses_post($settings['thumb_desc']);
				                                        echo'</p>';
				                                    echo '</div>';
				                                echo '</div>';
				                            endif;
			                            echo '</div>';
			                        }    
		                        echo '</div>';
		                    echo '</div>';
		                    echo '<div class="col-xl-5 col-lg-5">';
		                        echo '<div class="hero-img">';
		                        	if(!empty($settings['shape']['url'])):
			                            echo '<div class="img-main">';
			                                echo ensaf_img_tag( array(
												'url'   => esc_url( $settings['shape']['url'] ),
											));
			                            echo '</div>';
			                        endif;
			                        if(!empty($settings['shape2']['url'])):
			                            echo ' <div class="hero-shape">';
			                                echo ensaf_img_tag( array(
												'url'   => esc_url( $settings['shape2']['url'] ),
											));
			                            echo '</div>';
			                        endif;
			                        if(!empty($settings['shadow_text'])){	    
			                            echo '<div class="hero-big-text">';
			                                echo '<h3 data-text="Ensaf" class="th-big-title">'.wp_kses_post($settings['shadow_text']).'</h3>';
			                            echo '</div>';
			                        }    
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		       echo ' </div>';
		    echo '</div>';

		}

		
	}

}