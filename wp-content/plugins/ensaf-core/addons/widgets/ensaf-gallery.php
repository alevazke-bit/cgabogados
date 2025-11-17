<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Gallery Widget .
 *
 */
class Ensaf_Gallery extends Widget_Base {

	public function get_name() {
		return 'ensafgallery';
	}
	public function get_title() {
		return __( 'Gallery', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'counter_section',
			[
				'label' 	=> __( 'Gallery', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        ); 

		ensaf_select_field( $this, 'layout_style', 'Layout Style', ['Style One', 'Style Two', 'Style Three', 'Style Four'] );
		
		// $this->add_control(
		// 	'gallery',
		// 	[
		// 		'label' => esc_html__( 'Add Gallery Slider', 'ensaf' ), 
		// 		'type' => \Elementor\Controls_Manager::GALLERY,
		// 		'default' => [],
		// 	]
		// );

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'image', 'Choose Image');
		ensaf_general_fields($repeater, 'icon', 'Number', 'TEXTAREA2', '<i class="fal fa-plus"></i>');
		ensaf_general_fields($repeater, 'col', 'Column Class Name', 'TEXTAREA2', '');

		$this->add_control(
			'gallery_lists',
			[
				'label' 		=> __( 'Gallery Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'condition'	=> [
					'layout_style' => ['1', '2', '4']
				]
			]
		);

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'image', 'Choose Image');
		ensaf_general_fields($repeater, 'icon', 'Number', 'TEXTAREA2', '<i class="fal fa-plus"></i>');
		ensaf_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'gallery_lists2',
			[
				'label' 		=> __( 'Gallery Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'condition'	=> [
					'layout_style' => ['3']
				]
			]
		);

		//---------------------------------------
			//Style Section Start
		//---------------------------------------


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="row gy-30 filter-active overlay-direction">';
				$x=0;
				foreach ( $settings['gallery_lists'] as $data ){
					$x++;
					if(!empty($data['col'])){
						$column = $data['col'];
					}else{
						$column = 'col-xl-3 col-md-6';
					}

					echo '<div class="cat2 '.esc_attr($column).' filter-item  th-gallery-loop">';
						echo '<div class="gallery-card">';
							echo '<a class="box-img popup-image" href="'.esc_url( $data['image']['url'] ).'">';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								));
								echo '<div class="box-content">';
									if(!empty($data['icon'])){
										echo '<span class="box-btn">'.wp_kses_post($data['icon']).'</span>';
									}
								echo '</div>';
							echo '</a>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="row gy-4 filter-active">';
				foreach ( $settings['gallery_lists'] as $data ){
					if(!empty($data['col'])){
						$column = $data['col'];
					}else{
						$column = 'col-xl-3 col-md-6';
					}
					echo '<div class="'.esc_attr($column).' filter-item">';
						echo '<div class="gallery-grid">';
							echo '<div class="box-img">';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								));
							echo '</div>';
							echo '<a href="'.esc_url( $data['image']['url'] ).'" class="icon-btn popup-image">'.wp_kses_post($data['icon']).'</a>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="gallery-sec3">';
				echo '<div class="swiper th-slider" id="gallerySlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"4"},"1300":{"slidesPerView":"5"},"1500":{"slidesPerView":"6"}}}\'>';
					echo '<div class="swiper-wrapper">';
						foreach ( $settings['gallery_lists2'] as $data ){
							echo '<div class="swiper-slide">';
								echo '<div class="gallery-insta">';
									echo '<a target="_blank" href="'.esc_url( $data['button_url']['url'] ).'" class="box-btn">'.wp_kses_post($data['icon']).'</a>';
									echo ensaf_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									));
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="row gy-4 masonary-active">';
				foreach ( $settings['gallery_lists'] as $data ){
					if(!empty($data['col'])){
						$column = $data['col'];
					}else{
						$column = 'col-xl-4 col-md-6';
					}
					echo '<div class="'.esc_attr($column).' filter-item">';
						echo '<div class="service-gallery">';
							echo '<a href="'.esc_url( $data['image']['url'] ).'" class="popup-image box-btn">'.wp_kses_post($data['icon']).'</a>';
							echo ensaf_img_tag( array(
								'url'   => esc_url( $data['image']['url'] ),
								'class' => 'rounded-10 w-100',
							));
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}

		
	}

}