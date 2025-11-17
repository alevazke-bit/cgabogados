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
 * Info Box Widget .
 *
 */
class ensaf_Info_Box extends Widget_Base {

	public function get_name() {
		return 'ensafinfobox';
	}
	public function get_title() {
		return __( 'Info Box', 'ensaf' );
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
				'label'		 	=> __( 'Info Box', 'ensaf' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
				
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		ensaf_common_repeater_field($this, 'features', 'Features', [ 'icon2', 'title', 'text'  ], ['1']);

		ensaf_general_fields( $this, 'blockquote', 'Block Quote Text', 'TEXTAREA', 'Title', ['1'] );
		ensaf_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'EVENT SCHEDULE', ['1'] );
		ensaf_url_fields( $this, 'button_url', 'Button URL', ['1'] );

		ensaf_media_fields( $this, 'icon', 'Choose Icon', ['1'] );
		ensaf_media_fields( $this, 'image', 'Choose Image',['2'] );
		ensaf_general_fields( $this, 'title', 'Title', 'TEXTAREA2', 'Title', ['1','2'] );
		ensaf_general_fields( $this, 'subtitle', 'Sub-Title', 'TEXTAREA2', 'Sub-Title', ['1','2'] );
		ensaf_select_field( $this, 'client_rating', 'Client Rating', [ 'One Star', 'Two Star', 'Three Star', 'Four Star', 'Five Star' ],['2'] );
		ensaf_general_fields( $this, 'phone', 'Description', 'TEXTAREA2', '', ['1'] );


        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, '12', 'Title', '{{WRAPPER}} .title', ['1'] );
		ensaf_common_style_fields( $this, '13', 'Description', '{{WRAPPER}} .desc', ['1'] );
		ensaf_common_style_fields( $this, '14', 'Block Quote', '{{WRAPPER}} .about-blockquote p', ['1'] );

		//------Button Style-------
		ensaf_button_style_fields( $this, '16', 'Button Styling', '{{WRAPPER}} .th_btn' );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

			if( $settings['layout_style'] == '1' ){
			$phone = $settings['phone'] ? $settings['phone'] : '';     
			$replace_phone  = array(' ','-',' - ', '(', ')');
			$with           = array('','','');
			$phoneurl       = str_replace( $replace_phone, $with, $phone );	

				echo '<div class="about-wrapper">';
					echo '<div class="about-item-wrap">';
					foreach( $settings['features'] as $data ){
						echo '<div class="about-item">';
							if(!empty($data['features_icon2'])){
								echo '<div class="about-item_icon">';
									echo wp_kses_post($data['features_icon2']);
								echo '</div>';
							}
							echo '<div class="about-item_centent">';
								if(!empty($data['features_title'])){
									echo '<h3 class="box-title title">'.wp_kses_post($data['features_title']).'</h3>';
								}
								if(!empty($data['features_text'])){
									echo '<p class="about-item_text desc">'.wp_kses_post($data['features_text']).'</p>';
								}
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
					if(!empty($settings['blockquote'])){
					echo '<blockquote class="about-blockquote">';
						echo '<p>'.wp_kses_post($settings['blockquote']).'</p>';
					echo '</blockquote>';
					}
				echo '</div>';
				echo '<div class="btn-group justify-content-start">';
					if(!empty($settings['button_text'])){
						echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn th-icon th_btn">'.wp_kses_post($settings['button_text']).'</a>';
					}
					echo '<div class="feature-wrapper">';
						if(!empty( esc_url( $settings['icon']['url'] ))){
							echo '<div class="feature-icon">';
								echo '<a href="'.esc_attr('tel:' . $phoneurl).'">';
									echo ensaf_img_tag( array(
										'url'   => esc_url( $settings['icon']['url'] ),
									)); 
								echo '</a>';
							echo '</div>';
						}
						echo '<div class="media-body">';
							if(!empty($settings['title'])){
								echo '<span class="header-info_label">'.wp_kses_post($settings['title']).'</span>';
							}
							if(!empty($settings['phone'])){
								echo '<p class="header-info_link"><a href="'.esc_attr('tel:' . $phoneurl).'">'.wp_kses_post($settings['phone']).'</a></p>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
				
			}elseif( $settings['layout_style'] == '2' ){

                echo '<span class="client-group-wrap">';
                	if(!empty($settings['image']['url'])){
                		echo '<span class="thumb">';
	                        echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['image']['url'] ),
							)); 
	                    echo '</span>';
                	}
                    
                    echo '<span class="client-group-wrap__content">';
                    	if(!empty($settings['title'])){
	                        echo '<span class="client-group-wrap__box-title">';
	                           echo wp_kses_post($settings['title']);
	                        echo '</span>';
	                    }    
                        echo '<span class="client-group-wrap__box-review">';
                            if( $settings['client_rating'] == '1' ){
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-regular fa-star"></i>';
								echo '<i class="fa-regular fa-star"></i>';
								echo '<i class="fa-regular fa-star"></i>';
								echo '<i class="fa-regular fa-star"></i>';
							}elseif( $settings['client_rating'] == '2' ){
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-regular fa-star"></i>';
								echo '<i class="fa-regular fa-star"></i>';
								echo '<i class="fa-regular fa-star"></i>';
							}elseif( $settings['client_rating'] == '3' ){
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-regular fa-star"></i>';
								echo '<i class="fa-regular fa-star"></i>';
							}elseif( $settings['client_rating'] == '4' ){
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-regular fa-star"></i>';
							}else{
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-solid fa-star"></i>';
								echo '<i class="fa-solid fa-star"></i>';
							}
							if(!empty($settings['subtitle'])){
								echo '<span>'.wp_kses_post($settings['subtitle']).'</span>';
							}
                        echo '</span>';
                    echo '</span>';
                echo '</span>';

			}

	}

}