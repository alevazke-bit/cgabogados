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
 * Project Widget .
 *
 */
class Ensaf_Project extends Widget_Base {

	public function get_name() {
		return 'ensafproject';
	}
	public function get_title() {
		return __( 'Projects', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'project_section',
			[
				'label'		 	=> __( 'Projects', 'ensaf' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three','Style Four' ] );


		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'image', 'Choose Image');
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Initial Consultation');
		ensaf_general_fields($repeater, 'desc', 'Description', 'TEXTAREA2', 'Your Legal Shield');
		ensaf_url_fields($repeater, 'project_url', 'Button URL');
		
		$this->add_control(
			'projects',
			[
				'label' 		=> __( 'Projects', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Initial Consultation', 'ensaf' ),
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

		ensaf_common2_style_fields( $this, '02', 'Title', '{{WRAPPER}} .box-title a' );
		ensaf_common_style_fields( $this, '03', 'Description', '{{WRAPPER}} .box-text' );



	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="row gy-4 masonary-active">';
				foreach( $settings['projects'] as $key => $data ) {
					// Determine the column class based on the index
					$col_class = 'col-xxl-3'; // Default class
					if (in_array($key, [1, 6])) {
						$col_class = 'col-xxl-4';
					} elseif (in_array($key, [3, 4])) {
						$col_class = 'col-xxl-2';
					}
				
					echo '<div class="col-md-6 col-lg-6 col-xl-6 ' . esc_attr($col_class) . ' filter-item">';
						echo '<div class="gallery-card">';
							echo '<div class="gallery-img">';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								));
								echo '<div class="gallery-content">';
									echo '<a href="' . esc_url( $data['image']['url'] ) . '" class="popup-icon popup-image"><i class="fa-solid fa-eye"></i></a>';
									if (!empty($data['title'])) {
										echo '<h3 class="box-title"><a href="' . esc_url( $data['project_url']['url'] ) . '">' . wp_kses_post($data['title']) . '</a></h3>';
									}
									if (!empty($data['desc'])) {
										echo '<p class="box-text">' . esc_html($data['desc']) . '</p>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';			

		}elseif( $settings['layout_style'] == '2' ){
            echo '<div class="row justify-content-center">';
                echo '<div class="gallery-2-wrapper">';
					foreach( $settings['projects'] as $key => $data ){
						echo '<div class="gallery-card2 " data-bg-src="'.esc_url( $data['image']['url'] ).'">';
							echo '<div class="gallery-img">';
								echo '<div class="gallery-content">';
									echo '<a href="'.esc_url( $data['image']['url'] ).'" class="icon-btn popup-image"><i class="fa-solid fa-eye"></i> </a>';
									if(!empty($data['title'])){
										echo '<h2 class="box-title"><a href="'.esc_url( $data['project_url']['url'] ).'">'.wp_kses_post($data['title']).'</a></h2>';
									}
									if(!empty($data['desc'])){
										echo '<p class="box-text">'.esc_html($data['desc']).'</p>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['projects'] as $key => $data ){
					echo '<div class="col-xl-4 col-md-6">';
						echo '<div class="gallery-card2 inner" data-bg-src="'.esc_url( $data['image']['url'] ).'">';
							echo '<div class="gallery-img">';
								echo '<div class="gallery-content">';
									echo '<a href="'.esc_url( $data['image']['url'] ).'" class="icon-btn popup-image"><i class="fa-solid fa-eye"></i> </a>';
									if(!empty($data['title'])){
										echo '<h2 class="box-title"><a href="'.esc_url( $data['project_url']['url'] ).'">'.wp_kses_post($data['title']).'</a></h2>';
									}
									if(!empty($data['desc'])){
										echo '<p class="box-text">'.esc_html($data['desc']).'</p>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){

			echo '<div class="row justify-content-center">';
                echo '<div class="gallery-4-wrapper">';
                    echo '<div class="swiper th-slider" id="testiSlide2" data-slider-options=\'{"loop": true,"centeredSlides":true,"slidesPerView": "auto"}\'>';
                        echo '<div class="swiper-wrapper">';
                        	foreach( $settings['projects'] as $key => $data ){
	                            echo '<div class="swiper-slide">';
	                                echo '<div class="gallery-card2 style-2" data-bg-src="'.esc_url( $data['image']['url'] ).'">';
	                                    echo '<div class="gallery-img">';
	                                       echo '<div class="gallery-content">';
	                                       		if(!empty($data['image']['url'])){
	                                            	echo '<a href="'.esc_url( $data['image']['url'] ).'" class="icon-btn popup-image"><i class="fa-solid fa-eye"></i> </a>';
	                                            }	
	                                            if(!empty($data['title'])){
													echo '<h2 class="box-title"><a href="'.esc_url( $data['project_url']['url'] ).'">'.wp_kses_post($data['title']).'</a></h2>';
												}

	                                           	if(!empty($data['desc'])){
													echo '<p class="box-text">'.esc_html($data['desc']).'</p>';
												}
	                                       echo '</div>';
	                                    echo '</div>';
	                                echo '</div>';
	                            echo '</div>';
                            }	
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}
	

	}

}