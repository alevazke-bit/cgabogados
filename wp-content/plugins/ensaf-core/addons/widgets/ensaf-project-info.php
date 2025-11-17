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
 * Project Info Widget .
 *
 */
class Ensaf_project_List extends Widget_Base {

	public function get_name() {
		return 'ensafprojectinfo';
	}
	public function get_title() {
		return __( 'project Info', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'project_section',
			[
				'label'     => __( 'project Info', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style',['Style One'] );

		ensaf_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'All projects');

        $repeater = new Repeater();

		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Label');
		ensaf_general_fields($repeater, 'description', 'Description', 'TEXTAREA', 'Content'); 
 
		$this->add_control(
			'project_info',
			[
				'label' 		=> __( 'Project Info', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Label', 'ensaf' ),
					],
				],
			]
		);

        ensaf_social_fields( $this, 'social_icon_list', 'Social Media', ['1'] ); 

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		ensaf_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .widget_title' );
		ensaf_common_style_fields( $this, '02', 'Label', '{{WRAPPER}} h6' );
		ensaf_common_style_fields( $this, '03', 'Content', '{{WRAPPER}} p' );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="widget widget_overview">';
                echo '<div class="widget-call">';
                    if($settings['title']){
                        echo '<h4 class="widget_title">'.wp_kses_post($settings['title']).'</h4>';
                    }
                    echo '<div class="widget_overview">';
                        echo '<ul>';
                            foreach( $settings['project_info'] as $data ){
                                echo '<li>';
                                    if(!empty($data['title'])){
                                        echo '<h6>'.esc_html($data['title']).'</h6>';
                                    }
                                    if(!empty($data['description'])){
                                        echo '<p>'.wp_kses_post($data['description']).'</p>';
                                    }
                                echo '</li>';
                            }
                        echo '</ul>';
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
                echo '</div>';
            echo '</div>';

		}
	

	}

}