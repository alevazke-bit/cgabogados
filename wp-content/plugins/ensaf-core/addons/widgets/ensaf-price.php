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
 * Price Widget .
 *
 */
class Ensaf_Price extends Widget_Base {

	public function get_name() {
		return 'ensafprice';
	}
	public function get_title() {
		return __( 'Price Box', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'price_section',
			[
				'label' 	=> __( 'Price Box', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

		$repeater = new Repeater();

		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Basic Plan');
		ensaf_general_fields($repeater, 'desc', 'Description', 'TEXTAREA2', 'Consultation with a lawyer for your person al solution with basic plan.');
		ensaf_general_fields($repeater, 'price', 'Price', 'TEXTAREA', '$99.00'); 
		ensaf_code_fields($repeater, 'features', 'Features', ''); 
		ensaf_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Get Started');
		ensaf_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'price_lists',
			[
				'label' 		=> __( 'Price Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Basic Plan', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '2']
				]
			]
		);

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		// ensaf_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .box-title' );
		// ensaf_common_style_fields( $this, '03', 'Price', '{{WRAPPER}} .box-price' );
		// ensaf_common_style_fields( $this, '04', 'Features', '{{WRAPPER}} .box-list li' );

		//------Button Style-------
		// ensaf_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th-btn' );

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' || $settings['layout_style'] == '2' ){
			if( $settings['layout_style'] == '2' ){
				$style = 'style-2';
			}else{
				$style = '';
			}
			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['price_lists'] as $key => $data ){
					echo '<div class="col-xl-4 col-md-6">';
						echo '<div class="price-card '.esc_attr__($style).'">';
							echo '<div class="price-card_top">';
								if(!empty($data['title'])){
									echo '<h3 class="price-card_title">'.esc_html($data['title']).'</h3>';
								}
								if(!empty($data['desc'])){
									echo '<p class="box-text">'.esc_html($data['desc']).'</p>';
								}
								if(!empty($data['price'])){
									echo '<h4 class="price-card_price">'.wp_kses_post($data['price']).'</h4>';
								}
							echo '</div>';
							if(!empty($data['button_text'])){
								echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn w-100">'.wp_kses_post($data['button_text']).'<i class="fa-regular fa-arrow-right ms-2"></i></a>';
							}
							echo '<div class="price-card_content">';
								if(!empty($data['features'])){
									echo '<div class="checklist style7">'.wp_kses_post($data['features']).'</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){


		}


	}

}