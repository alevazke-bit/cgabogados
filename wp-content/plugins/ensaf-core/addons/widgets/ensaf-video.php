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
 * Video Widget .
 *
 */
class ensaf_Video extends Widget_Base {

	public function get_name() {
		return 'ensafvideo';
	}
	public function get_title() {
		return __( 'Video Box', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'video_section',
			[
				'label' 	=> __( 'video Box', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One','Style Two'] ); 

		ensaf_general_fields( $this, 'title', 'Title', 'TEXTAREA2', 'Title', ['2'] );
		ensaf_general_fields( $this, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Subtitle', ['2'] );

		ensaf_media_fields( $this, 'image1', 'Choose Image', [ '1', '2'] );
		ensaf_media_fields( $this, 'image2', 'Choose Image', [ '2'] );
		ensaf_media_fields( $this, 'image3', 'Choose Image', [ '2'] );
		ensaf_general_fields( $this, 'icon', 'Icon', 'TEXTAREA2', '<i class="fa-sharp fa-solid fa-play"></i>' );

		
		ensaf_url_fields( $this, 'video_url', 'Video URL' );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

	
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="process-thumb">';
				echo '<div class="img-box1">';
					echo '<div class="process-play-btn-wrap">';
						if(!empty($settings['video_url']['url'])){
							echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn style2 popup-video">'.wp_kses_post($settings['icon']).'</a>';
						}
					echo '</div>';
					echo ensaf_img_tag( array(
						'url'   => esc_url( $settings['image1']['url'] ),
					));
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			
            echo '<div class="img-box8">';
                echo '<div class="img-box-top d-flex justify-content-between">';
                    echo '<div class="img1 d-none d-xl-block">';
                        echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image1']['url'] ),
							'class' => 'tilt-active',
						));
                    echo '</div>';
                    echo '<div class="about-img-box3__counter d-none d-lg-block">';
                        if(!empty($settings['title'])){
                    	echo '<h1>'.wp_kses_post($settings['title']).'</h1>';
	                    }
	                    if(!empty($settings['subtitle'])){	
	                    	echo '<h4 class="box-title">'.wp_kses_post($settings['subtitle']).'</h4>';
	                    }	
                    echo '</div>';
                echo '</div>';
                echo '<div class="img2">';
                    if(!empty($settings['image2']['url'])){
	                    echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image2']['url'] ),
						));
	                }
	                if(!empty($settings['video_url']['url'])){    	
	                    echo '<div class="img-video-btn">';
	                       echo ' <a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn style2 popup-video">
	                            <i class="fa-sharp fa-solid fa-play"></i>
	                        </a>';
	                    echo '</div>';
	                } 
                echo '</div>';
                if(!empty($settings['image3']['url'])){
	                echo '<div class="shape-mockup jump" data-bottom="1%" data-left="9%">';
	                    echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image3']['url'] ),
						));
	                echo '</div>';
	            }
            echo '</div>';

		}


	}

}