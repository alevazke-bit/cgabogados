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
 * Contact Form Widget .
 *
 */
class ensaf_Contact_Form extends Widget_Base {

	public function get_name() {
		return 'ensafcontactform';
	}
	public function get_title() {
		return __( 'Contact Form', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	public function get_as_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $as_cfa         = array();
        $as_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $as_forms       = get_posts( $as_cf_args );
        $as_cfa         = ['0' => esc_html__( 'Select Form', 'ensaf' ) ];
        if( $as_forms ){
            foreach ( $as_forms as $as_form ){
                $as_cfa[$as_form->ID] = $as_form->post_title;
            }
        }else{
            $as_cfa[ esc_html__( 'No contact form found', 'ensaf' ) ] = 0;
        }
        return $as_cfa;
    }

	protected function register_controls() {

		$this->start_controls_section(
			'contact_form_section',
			[
				'label' 	=> __( 'Contact Form', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five' ] ); 

		ensaf_general_fields( $this, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Have Any Questions?', ['1', '2', '3'] );
		ensaf_general_fields( $this, 'title', 'Title', 'TEXTAREA2', 'Get in Touch with Us', ['1', '2', '3', '4', '5'] );

		$this->add_control(
            'ensaf_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'ensaf' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_as_contact_form(),
            ]
        );

		ensaf_media_fields( $this, 'image', 'Choose Image', ['1', '2'] );
		ensaf_media_fields( $this, 'bg', 'Choose Background', ['1', '2'] );

		ensaf_url_fields( $this, 'video_url', 'Video URL', ['2'] );

		$repeater = new Repeater();

		ensaf_general_fields($repeater, 'icon', 'Icon', 'TEXTAREA2', '');
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Label');
		ensaf_general_fields($repeater, 'desc', 'Description', 'TEXTAREA', 'Content');
		
		$this->add_control(
			'contact_lists',
			[
				'label' 		=> __( 'Contact Info', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Label', 'ensaf' ),
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

		ensaf_common_style_fields( $this, '01', 'Subitle', '{{WRAPPER}} .sub', ['1', '2', '3'] );
		ensaf_common_style_fields( $this, '02', 'Title', '{{WRAPPER}} .title', ['1', '2', '3', '4', '5'] );


	}

	protected function render() {

	    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="contact-from-1-wrap">';
				echo '<div class="row gx-60 gy-40">';
					echo '<div class="col-xl-6">';
						echo '<div class="contact-form">';
							echo '<div class="title-area mb-35">';
								if($settings['subtitle']){
									echo '<span class="sub-title justify-content-center sub">'.wp_kses_post($settings['subtitle']).'</span>';
								}
								if($settings['title']){
									echo '<h4 class="sec-title title">'.wp_kses_post($settings['title']).'</h4>';
								}
							echo '</div>';
							echo '<div class="quote-form ajax-contact">';
								if( !empty($settings['ensaf_select_contact_form']) ){
									echo do_shortcode( '[contact-form-7  id="'.$settings['ensaf_select_contact_form'].'"]' ); 
								}else{
									echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'ensaf' ). '</p></div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-xl-6 shape-mockup-wrap">';
						echo '<div class="contact-icon-box-wrap">';
							foreach( $settings['contact_lists'] as $data ){
								echo '<div class="info-box">';
									if(!empty($data['icon'])){
										echo '<div class="info-box_icon">'.wp_kses_post($data['icon']).'</div>';
									}
									echo '<div class="info-contnt">';
										if(!empty($data['title'])){
											echo '<h4 class="footer-info-title">'.esc_html($data['title']).'</h4>';
										}
										if(!empty($data['desc'])){
											echo '<p class="info-box_text">'.wp_kses_post($data['desc']).'</p>';
										}
									echo '</div>';
								echo '</div>';
							}
						echo '</div>';
						if(!empty($settings['bg']['url'])){
							echo '<div class="contact-img">';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $settings['bg']['url'] ),
								));
							echo '</div>';
						}
						if(!empty($settings['image']['url'])){
							echo '<div class="shape-mockup contact_1-man">';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $settings['image']['url'] ),
								));
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<section class="space overflow-hidden" data-overlay="title" data-opacity="8" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				if(!empty($settings['image']['url'])){
					echo '<div class="shape-mockup contact_2-right">';
						echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['image']['url'] ),
						));
					echo '</div>';
				}
				if(!empty($settings['video_url']['url'])){
					echo '<div class="contact-2-video-btn">';
						echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn style2 popup-video">';
							echo '<i class="fa-sharp fa-solid fa-play"></i>';
						echo '</a>';
					echo '</div>';
				}
				echo '<div class="container">';
					echo '<div class="row gx-60 gy-40">';
						echo '<div class="col-lg-6">';
							echo '<div class="contact-form style-2">';
								echo '<div class="title-area mb-35">';
									if($settings['subtitle']){
										echo '<span class="sub-title justify-content-center sub">'.wp_kses_post($settings['subtitle']).'</span>';
									}
									if($settings['title']){
										echo '<h4 class="sec-title title">'.wp_kses_post($settings['title']).'</h4>';
									}
								echo '</div>';
								echo '<div class="quote-form ajax-contact">';
									if( !empty($settings['ensaf_select_contact_form']) ){
										echo do_shortcode( '[contact-form-7  id="'.$settings['ensaf_select_contact_form'].'"]' ); 
									}else{
										echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'ensaf' ). '</p></div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</section>';
			
		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="contact-form style-3">';
				echo '<div class="title-area mb-35">';
					if($settings['subtitle']){
						echo '<span class="sub-title justify-content-center sub">'.wp_kses_post($settings['subtitle']).'</span>';
					}
					if($settings['title']){
						echo '<h4 class="sec-title title">'.wp_kses_post($settings['title']).'</h4>';
					}
				echo '</div>';
				echo '<div class="quote-form ajax-contact">';
					if( !empty($settings['ensaf_select_contact_form']) ){
						echo do_shortcode( '[contact-form-7  id="'.$settings['ensaf_select_contact_form'].'"]' ); 
					}else{
						echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'ensaf' ). '</p></div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="contact-form style-4 ajax-contact">';
				if($settings['title']){
					echo '<h3 class="form-title text-start title">'.wp_kses_post($settings['title']).'</h3>';
				}
				if( !empty($settings['ensaf_select_contact_form']) ){
					echo do_shortcode( '[contact-form-7  id="'.$settings['ensaf_select_contact_form'].'"]' ); 
				}else{
					echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'ensaf' ). '</p></div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){
			echo '<div class="contact-form team-details ajax-contact">';
				if($settings['title']){
					echo '<h4 class="form-title text-start mb-4 title">'.wp_kses_post($settings['title']).'</h4>';
				}
				if( !empty($settings['ensaf_select_contact_form']) ){
					echo do_shortcode( '[contact-form-7  id="'.$settings['ensaf_select_contact_form'].'"]' ); 
				}else{
					echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'ensaf' ). '</p></div>';
				}
			echo '</div>';

		}
		

	}

}