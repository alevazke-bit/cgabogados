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
class Ensaf_Client_Logos extends Widget_Base {

	public function get_name() {
		return 'ensafclientlogos';
	}
	public function get_title() {
		return __( 'Client Logos', 'ensaf' );
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
				'label'     => __( 'Client Logos', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

        $repeater = new Repeater();

		ensaf_media_fields($repeater, 'image', 'Choose Image');
		ensaf_url_fields($repeater, 'logo_url', 'Button URL');
		
		$this->add_control(
			'client_logo',
			[
				'label' 		=> __( 'Logos', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
                'default'   => [
                    [
                        'image'    => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'image'    => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'image'    => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'image'    => Utils::get_placeholder_image_src(),
                    ],
                    [
                        'image'    => Utils::get_placeholder_image_src(),
                    ],
                ],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);


        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------


	}

	protected function render() {

    $settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){
            echo '<div class="swiper th-slider" id="brand-slider-1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"5"},"1400":{"slidesPerView":"6"}}}\'>';
                echo '<div class="swiper-wrapper">';
                    foreach( $settings['client_logo'] as $data ){
                        echo '<div class="swiper-slide">';
                            echo '<div class="brand-box">';
                                echo '<a href="'.esc_url( $data['logo_url']['url'] ).'">';
                                    echo ensaf_img_tag( array(
                                        'url'   => esc_url( $data['image']['url'] ),
                                    ) );
                                echo '</a>';
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
        

		}elseif( $settings['layout_style'] == '3' ){


		}elseif( $settings['layout_style'] == '4' ){


		}
		
			
	}
}