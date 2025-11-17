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
 * About Widget .
 *
 */
class Ensaf_About extends Widget_Base {

	public function get_name() {
		return 'ensafAbout';
	}
	public function get_title() {
		return __( 'About', 'ensaf' );
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
				'label'     => __( 'About', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One'] );

		ensaf_media_fields($this, 'video_image', 'Video Image',['1']);
		ensaf_media_fields($this, 'video_rounded_image', 'Video Rounded Image',['1']);
		ensaf_url_fields($this, 'video_url', 'Profile URL',['1']);

		ensaf_media_fields($this, 'client_image', 'Client Image',['1']);
		ensaf_general_fields($this, 'review_title', 'Review Title', 'TEXTAREA2', 'Review Title',['1']);
		ensaf_general_fields($this, 'review_desc', 'Review Desc', 'TEXTAREA2', 'Review Desc',['1']);
		ensaf_general_fields($this, 'review', 'Review', 'TEXTAREA2', 'Review',['1']);

		ensaf_general_fields($this, 'transparent_text', 'Transparent Title', 'TEXTAREA2', 'Transparent Title',['1']);

		ensaf_general_fields($this, 'counter_title', 'Counter Title', 'TEXTAREA2', 'Counter Title',['1']);
		ensaf_general_fields($this, 'counter_number', 'Counter Number', 'TEXTAREA2', 'Counter Number',['1']);
		ensaf_general_fields($this, 'counter_operator', 'Counter Operator', 'TEXTAREA2', 'Counter Operator',['1']);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title', ['1', '2', '3'] );
		ensaf_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} p', [ '1', '2', '3'] );

		ensaf_common_style_fields( $this, '011', 'Title', '{{WRAPPER}} .footer-info-title', ['4'] );
		ensaf_common_style_fields( $this, '022', 'Description', '{{WRAPPER}} .info-box_text, {{WRAPPER}} .info-box_text a', [ '4'] );


	}

	protected function render() {

    $settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){

			echo '<div class="about-right about-4-right d-md-flex align-items-center">';
                echo '<div class="img-box2 shape-mockup-wrap">';
                    echo '<div class="shape-mockup about-4-logo-shape">';
                    	if(!empty($settings['video_rounded_image']['url'])):
	                        echo '<a href="'.esc_url($settings['video_url']['url']).'" class="popup-video">';
	                            echo '<div class="logo-icon-wrapp2">';
	                                echo '<div class="logo-circle">';
	                                    echo ensaf_img_tag( array(
											'url'   => esc_url( $settings['video_rounded_image']['url'] ),
										));
	                                    echo '<span class="logo-icon">';
	                                        echo '<i class="fa-solid fa-play"></i>';
	                                    echo '</span>';
	                                echo '</div>';
	                            echo '</div>';
	                        echo '</a>';
	                    endif;
                    echo '</div>';

                    echo '<div class="img2">';
                    	echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['video_image']['url'] ),
							'classs' => 'tilt-active'
						));
                    echo '</div>';

                echo '</div>';
                echo '<div class="client-group-wrap d-block">';

                    echo '<span class="thumb">';
                        echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['client_image']['url'] ),
						));
                    echo '</span>';

                    if(!empty($settings['review_title'] || $settings['review_desc'])):
	                    echo '<div class="client-group-wrap__content">';
	                        echo '<span class="client-group-wrap__box-title">';
	                           echo wp_kses_post($settings['review_title']);
	                        echo '</span>';
	                        echo '<div class="client-group-wrap__box-review">';
	                            echo wp_kses_post($settings['review']);
	                            echo '<p>'.$settings['review_desc'].'</p>';
	                        echo '</div>';
	                    echo '</div>';
	                endif;
                    echo '<div class="about-4-experience-box">';
                    	if(!empty($settings['transparent_text'])):
                        	echo '<span class="ensaf-transparent-text">'.esc_html($settings['transparent_text']).'</span>';
                        endif;
                        if(!empty($settings['counter_number'] || $settings['counter_title'])):
	                        echo '<div class="media-body d-flex align-items-center">';
	                            echo '<h4 class="box-number"><span class="counter-number">'.esc_html($settings['counter_number']).'</span><span class="plus-simple">'.esc_html($settings['counter_operator']).'</span></h4>';
	                            echo '<p class="box-text">'.esc_html($settings['counter_title']).'</p>';
	                        echo '</div>';
	                    endif;
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}
		
			
	}
}