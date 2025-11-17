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
 * Team Widget .
 *
 */
class ensaf_Team extends Widget_Base {

	public function get_name() {
		return 'ensafteam';
	}
	public function get_title() {
		return __( 'Team', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'team_section',
			[
				'label'     => __( 'Team Content', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three','Style Four' ] );

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'team_image', 'Team Image');
		ensaf_general_fields($repeater, 'name', 'Name', 'TEXTAREA2', 'John Simon');
		ensaf_url_fields($repeater, 'profile_url', 'Profile URL');
		ensaf_general_fields($repeater, 'designation', 'Designation', 'TEXTAREA2', 'Chief Justice');

		ensaf_url_fields($repeater, 'facebook_url', 'Facebook URL');
		ensaf_url_fields($repeater, 'twitter_url', 'Twitter URL');
		ensaf_url_fields($repeater, 'linkedin_url', 'Linkedin URL');
		ensaf_url_fields($repeater, 'instagram_url', 'Instagram URL');
		
		$this->add_control(
			'team_lists',
			[
				'label' 		=> __( 'Member Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'name' 	=> __( 'John Simon', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '2', '3','4']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//--------------------------------------- 

		//-------Name Style-------
		ensaf_common2_style_fields( $this, '01', 'Name', '{{WRAPPER}} .box-title a' );
		//-------Designation Style-------
		ensaf_common_style_fields( $this, '02', 'Designation', '{{WRAPPER}} .team-desig' );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

			if( $settings['layout_style'] == '1' ){
			echo '<div class="team-1-card-wrap">';
				echo '<div class="swiper has-shadow th-slider" id="testiSlide1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"4"}}}\'>';
					echo '<div class="swiper-wrapper">';
					foreach( $settings['team_lists'] as $data ){
						$target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

						$f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
						$f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
						$t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
						$t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
						$l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
						$l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
						$i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
						$i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';

						echo '<div class="swiper-slide">';
							echo '<div class="team-card">';
								if(!empty($data['team_image']['url'])){
									echo '<div class="team-img">';
										echo ensaf_img_tag( array(
											'url'   => esc_url( $data['team_image']['url']  ),
										));
									echo '</div>';
								}
								echo '<div class="team-content">';
									if($data['name']){
										echo '<h3 class="box-title"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
									}
									if($data['designation']){
										echo '<p class="team-desig">'.esc_html($data['designation']).'</p>';
									}
								echo '</div>';
								echo '<div class="team-content-hover-wrap">';
									echo '<div class="team-content-hover">';
										if(!empty($data['team_image']['url'])){
											echo '<div class="team-img">';
												echo ensaf_img_tag( array(
													'url'   => esc_url( $data['team_image']['url']  ),
												));
											echo '</div>';
										}
										echo '<div class="hover-inner">';
											if($data['name']){
												echo '<h3 class="box-title"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
											}
											if($data['designation']){
												echo '<p class="team-desig">'.esc_html($data['designation']).'</p>';
											}
											if( ! empty( $data['facebook_url']['url'] || $data['twitter_url']['url'] || $data['linkedin_url']['url'] || $data['instagram_url']['url'] ) ){
												echo '<div class="team-social">';
													echo '<div class="th-social">';
														if( ! empty( $data['facebook_url']['url']) ){
															echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
														}
														if( ! empty( $data['twitter_url']['url']) ){
															echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a>';
														}
														if( ! empty( $data['linkedin_url']['url']) ){
															echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
														}
														if( ! empty( $data['instagram_url']['url']) ){
															echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a>';
														}
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
				echo '</div>';
				echo '<button data-slider-prev="#testiSlide1" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
				echo '<button data-slider-next="#testiSlide1" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
			echo '</div>';

			}elseif( $settings['layout_style'] == '2' ){
				echo '<div class="row gy-4">';
					foreach( $settings['team_lists'] as $data ){
						$target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

						$f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
						$f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
						$t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
						$t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
						$l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
						$l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
						$i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
						$i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';

						echo '<div class="col-xl-4 col-lg-4 col-md-6">';
							echo '<div class="team-card style-2">';
								if(!empty($data['team_image']['url'])){
									echo '<div class="team-img">';
										echo ensaf_img_tag( array(
											'url'   => esc_url( $data['team_image']['url']  ),
										));
									echo '</div>';
								}
								echo '<div class="team-content">';
									if($data['name']){
										echo '<h3 class="box-title"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
									}
									if($data['designation']){
										echo '<p class="team-desig">'.esc_html($data['designation']).'</p>';
									}
									echo '<div class="team-social">';
										echo '<div class="th-social">';
											if( ! empty( $data['facebook_url']['url'] || $data['twitter_url']['url'] || $data['linkedin_url']['url'] || $data['instagram_url']['url'] ) ){
												echo '<div class="team-social">';
													echo '<div class="th-social">';
														if( ! empty( $data['facebook_url']['url']) ){
															echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
														}
														if( ! empty( $data['twitter_url']['url']) ){
															echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a>';
														}
														if( ! empty( $data['linkedin_url']['url']) ){
															echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
														}
														if( ! empty( $data['instagram_url']['url']) ){
															echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a>';
														}
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

			}elseif( $settings['layout_style'] == '3' ){
				echo '<div class="swiper has-shadow th-slider" id="testiSlide3" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['team_lists'] as $data ){
							$target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

							$f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
							$f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
							$t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
							$t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
							$l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
							$l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
							$i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
							$i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';

							echo '<div class="swiper-slide">';
								echo '<div class="team-card">';
									if(!empty($data['team_image']['url'])){
										echo '<div class="team-img">';
											echo ensaf_img_tag( array(
												'url'   => esc_url( $data['team_image']['url']  ),
											));
										echo '</div>';
									}
									echo '<div class="team-content">';
										if($data['name']){
											echo '<h3 class="box-title"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
										}
										if($data['designation']){
											echo '<p class="team-desig">'.esc_html($data['designation']).'</p>';
										}
									echo '</div>';
									echo '<div class="team-content-hover-wrap">';
										echo '<div class="team-content-hover">';
											if(!empty($data['team_image']['url'])){
												echo '<div class="team-img">';
													echo ensaf_img_tag( array(
														'url'   => esc_url( $data['team_image']['url']  ),
													));
												echo '</div>';
											}
											echo '<div class="hover-inner">';
												if($data['name']){
													echo '<h3 class="box-title"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
												}
												if($data['designation']){
													echo '<p class="team-desig">'.esc_html($data['designation']).'</p>';
												}
												if( ! empty( $data['facebook_url']['url'] || $data['twitter_url']['url'] || $data['linkedin_url']['url'] || $data['instagram_url']['url'] ) ){
													echo '<div class="team-social">';
														echo '<div class="th-social">';
															if( ! empty( $data['facebook_url']['url']) ){
																echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
															}
															if( ! empty( $data['twitter_url']['url']) ){
																echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a>';
															}
															if( ! empty( $data['linkedin_url']['url']) ){
																echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
															}
															if( ! empty( $data['instagram_url']['url']) ){
																echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a>';
															}
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
				echo '</div>';

			}elseif( $settings['layout_style'] == '4' ){

				echo '<div class="row gy-4">';
	                echo '<div class="col-xl-12">';
	                    echo '<div class="swiper has-shadow th-slider" id="testiSlide3" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}}}\'>';
	                        echo '<div class="swiper-wrapper">';
	                        	foreach( $settings['team_lists'] as $data ){
									$target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
									$nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

									$f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
									$f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
									$t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
									$t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
									$l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
									$l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
									$i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
									$i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';
		                            echo '<div class="swiper-slide">';
		                                echo '<div class="team-card style-6">';
		                                    echo '<div class="team-img h-100">';
		                                        echo ensaf_img_tag( array(
													'url'   => esc_url( $data['team_image']['url']  ),
												));
		                                    echo '</div>';
		                                    echo '<div class="team-content">';

		                                        if($data['name']){
													echo '<h3 class="box-title"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
												}

												if($data['designation']){
													echo '<span class="team-desig">'.esc_html($data['designation']).'</span>';
												}

		                                        echo '<div class="team-social">';
		                                            echo '<div class="th-social">';
		                                                if( ! empty( $data['facebook_url']['url']) ){
															echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
														}
														if( ! empty( $data['twitter_url']['url']) ){
															echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a>';
														}
														if( ! empty( $data['linkedin_url']['url']) ){
															echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
														}
														if( ! empty( $data['instagram_url']['url']) ){
															echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a>';
														}
		                                            echo '</div>';
		                                        echo '</div>';
		                                    echo '</div>';
		                                echo '</div>';
		                            echo '</div>';
		                        }    
	                        echo '</div>';
	                   echo ' </div>';
	                echo '</div>';
	            echo '</div>';	

			}
	
			
	}
}