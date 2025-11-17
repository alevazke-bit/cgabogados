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
 * CTA Widget .
 *
 */
class ensaf_Cta extends Widget_Base {

	public function get_name() {
		return 'ensafcta';
	}
	public function get_title() {
		return __( 'CTA', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_title_section',
			[
				'label'		 	=> __( 'CTA', 'ensaf' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT, 
				
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One','Style Two' ] );

		ensaf_media_fields( $this, 'image', 'Choose Image', ['1'] );
		ensaf_media_fields( $this, 'shape', 'Choose Shape', ['1'] );

		ensaf_general_fields( $this, 'title', 'Title', 'TEXTAREA2', 'Schedule Your Appointment With Our Exper', ['1','2'] );
		ensaf_general_fields( $this, 'subtitle', 'SubTitle', 'TEXTAREA2', 'SubTitle', ['2'] );
		ensaf_general_fields( $this, 'placeholder_text', 'placeholder', 'TEXTAREA2', 'placeholder', ['2'] );

		ensaf_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'Book Now', [ '1' ] );
		ensaf_url_fields( $this, 'button_url', 'Button URL', [ '1' ] ); 

		ensaf_general_fields( $this, 'icon', 'Icon', 'TEXTAREA2', '<i class="fal fa-phone"></i>', ['1'] );
		ensaf_general_fields( $this, 'label', 'Label', 'TEXTAREA2', 'Call Us 24/7', ['1'] );
		ensaf_general_fields( $this, 'phone', 'Phone', 'TEXTAREA2', '+0 (123) 456 78', ['1'] );
			
        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .sec-title,{{WRAPPER}} .cta-title', ['1','2'] );
		ensaf_common_style_fields( $this, '02', 'Sub-Title', '{{WRAPPER}} .box-text,{{WRAPPER}} .sec-text', ['1','2'] );
		//------Button Style-------
		ensaf_button2_style_fields($this, '10', 'Button Styling', '{{WRAPPER}} .th_btn', ['1']);

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="cta-sec1 " data-bg-src="'.esc_url( $settings['shape']['url'] ).'">';
				if(!empty($settings['image']['url'])){
					echo '<div class="cta-img1">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
				echo '<div class="cta-content">';
					if($settings['title']){
						echo '<h2 class="sec-title mb-37">'.wp_kses_post($settings['title']).'</h2>';
					}
					echo '<div class="btn-group justify-content-center">';
						if(!empty($settings['button_text'])){
							echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn2 th_btn">'.esc_html($settings['button_text']).'<i class="far fa-arrow-right"></i></a>';
						}
						echo '<div class="call-btn">';
							if($settings['icon']){
								echo '<div class="play-btn">'.wp_kses_post($settings['icon']).'</div>';
							}
							echo '<div class="media-body">';
								if($settings['label']){
									echo '<p class="box-label text-white">'.esc_html($settings['label']).'</p>';
								}
								if($settings['phone']){
									echo '<h6 class="box-link text-white">'.wp_kses_post($settings['phone']).'</h6>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){

			echo '<div class="cta-content">';
				if($settings['title']){
                	echo '<h3 class="cta-title">'.wp_kses_post($settings['title']).'</h3>';
                }
                if($settings['subtitle']){	
                	echo '<p class="sec-text mb-30">'.wp_kses_post($settings['subtitle']).'</p>';
                }	
                echo '<div class="cta-form-wrapper">';
                    echo '<form action="#" class="newsletter-form">';
                        echo '<div class="form-group">';
                            echo '<input class="form-control" type="email" placeholder="'.wp_kses_post($settings['placeholder_text']).'" required="">';
                        echo '</div>';
                        echo '<button type="submit" class="icon-btn">';
                            echo '<i class="fa-light fa-arrow-right-long"></i>';
                        echo '</button>';
                    echo '</form>';
                echo '</div>';
            echo '</div>';
			
		}
		

	}

}