
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
 * Contact Info Widget .
 *
 */
class Ensaf_Contact_Info extends Widget_Base {

	public function get_name() {
		return 'ensafcontactinfo';
	}
	public function get_title() {
		return __( 'Contact Info', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() { 

		$this->start_controls_section(
			'title_section',
			[
				'label' 	=> __( 'Contact Info', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One', 'Style Two', 'Style Three', 'Style Four' ] );

		ensaf_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'Need Any Help?', ['3']);
		ensaf_general_fields($this, 'desc', 'Description', 'TEXTAREA', 'Need Any Help, Call Us 24/7 For Support', ['3']);

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
					'layout_style' => ['1', '2', '3']
				]
			]
		);

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'icon', 'Choose Icon' );
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Label');
		ensaf_general_fields($repeater, 'desc', 'Description', 'TEXTAREA', 'Content');
		
		$this->add_control(
			'contact_lists2',
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
					'layout_style' => ['4']
				]
			]
		);



        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, '10', 'Section Title', '{{WRAPPER}} .box-title', ['3'] );
		ensaf_common_style_fields( $this, '11', 'Section Description', '{{WRAPPER}} .box_text', ['3'] );

		ensaf_common_style_fields( $this, '01', 'Label', '{{WRAPPER}} .footer-info-title', ['1', '2', '4'] );
		ensaf_common_style_fields( $this, '011', 'Label', '{{WRAPPER}} .info-box_subtitle', ['3'] );
		ensaf_common_style_fields( $this, '02', 'Content', '{{WRAPPER}} .info-box_text, {{WRAPPER}} .info-box_text a', ['1', '2', '3', '4'] );
		
	}

	protected function render() {

        $settings = $this->get_settings_for_display(); 

			
		if( $settings['layout_style'] == '1' ){
			echo '<div class="footer-top">';
				echo '<div class="th-widget-contact">';
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
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="th-widget-contact">';
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

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="widget widget_call  ">';
				echo '<div class="widget-call">';
					if(!empty($settings['title'])){
						echo '<h4 class="box-title">'.esc_html($settings['title']).'</h4>';
					}
					if(!empty($settings['desc'])){
						echo '<p class="box_text">'.wp_kses_post($settings['desc']).'</p>';
					}
					echo '<div class="widget_call">';
						foreach( $settings['contact_lists'] as $data ){
							echo '<div class="info-box">';
								if(!empty($data['icon'])){
									echo '<div class="info-box_icon">'.wp_kses_post($data['icon']).'</div>';
								}
								echo '<div>';
									if(!empty($data['title'])){
										echo '<span class="info-box_subtitle">'.esc_html($data['title']).'</span>';
									}
									if(!empty($data['desc'])){
										echo '<p class="info-box_text">'.wp_kses_post($data['desc']).'</p>';
									}
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="contact-icon-wrap">';
				foreach( $settings['contact_lists2'] as $data ){
					echo '<div class="info-box">';
						if($data['icon']['url'] ){
							echo '<div class="info-box_icon">';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $data['icon']['url'] ),
								));
							echo '</div>';
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

		}
       

	}

}
