<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
/**
 *
 * Team Info Widget
 *
 */
class ensaf_Team_info extends Widget_Base{

	public function get_name() {
		return 'ensafteaminfo';
	}
	public function get_title() {
		return esc_html__( 'Team Member Info', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'team_member_content',
			[
				'label'		=> esc_html__( 'Member Info','ensaf' ),
				'tab'		=> Controls_Manager::TAB_CONTENT,
			]
		);

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One','Style Two' ] );

		ensaf_media_fields( $this, 'image', 'Choose Image', ['1','2'] );
		ensaf_general_fields( $this, 'name', 'Member Name', 'TEXT', 'Jonson Anderson', ['1'] );
		ensaf_general_fields( $this, 'designation', 'Designation', 'TEXT', 'Designation', ['1'] );
		ensaf_general_fields( $this, 'desc', 'Description', 'TEXTAREA', '', ['1'] );
		
		ensaf_social_fields( $this, 'social_icon_list', 'Social Media', ['1'] );

		ensaf_general_fields( $this, 'title', 'Title', 'TEXTAREA2', 'Title', ['2'] );
		ensaf_general_fields( $this, 'subtitle', 'Sub-Title', 'TEXTAREA2', 'Sub-Title', ['2'] );
		ensaf_select_field( $this, 'client_rating', 'Client Rating', [ 'One Star', 'Two Star', 'Three Star', 'Four Star', 'Five Star' ],['2'] ); 

		$repeater = new Repeater();

		ensaf_general_fields($repeater, 'icon', 'Icon', 'TEXTAREA2', '<i class="fa-solid fa-user"></i>');
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

		ensaf_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'Contact us',['1'] );
		ensaf_url_fields( $this, 'button_url', 'Button URL',['1']  );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		
		ensaf_common_style_fields( $this, '01', 'Name', '{{WRAPPER}} .team-about_title'  );
		ensaf_common_style_fields( $this, '02', 'Designation', '{{WRAPPER}} .team-about_desig' );
		ensaf_common_style_fields( $this, '03', 'Description', '{{WRAPPER}} .team-about_text' );

		ensaf_common_style_fields( $this, '011', 'Label', '{{WRAPPER}} .about-info_subtitle', ['1'] );
		ensaf_common_style_fields( $this, '022', 'Content', '{{WRAPPER}} .about-info_title, {{WRAPPER}} .about-info_title a', ['1'] );
		ensaf_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th_btn' );

	}

	protected function render() {

	$settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){
			echo '<div class="team-details">';
                echo '<div class="row">';
                    echo '<div class="col-xl-5">';
						if(!empty($settings['image']['url'])){
							echo '<div class="mb-40 mb-xl-0">';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $settings['image']['url'] ), 
									'class' => 'w-100'
								));
							echo '</div>';
						}
                    echo '</div>';
                    echo '<div class="col-xl-7 ps-3 ps-xl-5 align-self-center">';
                        echo '<div class="team-about">';
                            echo '<div class="team-wrapp">';
                                echo '<div class="top-wrap">';
                                    echo '<div class="title-wrap">';
										if(!empty($settings['name'])){
											echo '<h3 class="team-about_title">'.esc_html($settings['name']).'</h3>';
										}
										if(!empty($settings['designation'])){
											echo '<p class="team-about_desig">'.esc_html($settings['designation']).'</p>';
										}
                                    echo '</div>';
                                    echo '<div class="th-social">';
										foreach( $settings['social_icon_list'] as $social_icon ){
											$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
											$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';
											echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';
											\Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );
											echo '</a> ';
										}
                                    echo '</div>';
                                echo '</div>';
								if(!empty($settings['desc'])){
									echo '<p class="team-about_text">'.esc_html($settings['desc']).'</p>';
								}
                            echo '</div>';
 
                            echo '<div class="about-info-wrap">';
								foreach( $settings['contact_lists'] as $data ){
									echo '<div class="about-info">';
										if(!empty($data['icon'])){
											echo '<div class="about-info_icon">'.wp_kses_post($data['icon']).'</div>';
										}
										echo '<div class="about-info_content">';
											if(!empty($data['title'])){
												echo '<p class="about-info_subtitle">'.esc_html($data['title']).'</p>';
											}
											if(!empty($data['desc'])){
												echo '<h6 class="about-info_title">'.wp_kses_post($data['desc']).'</h6>';
											}
										echo '</div>';
									echo '</div>';
								}
                            echo '</div>';
							if(!empty($settings['button_text'])){
								echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style2 th_btn">'.wp_kses_post($settings['button_text']).'<i class="fa-regular fa-arrow-right-long"></i></a>';
							}
                        echo '</div>';
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