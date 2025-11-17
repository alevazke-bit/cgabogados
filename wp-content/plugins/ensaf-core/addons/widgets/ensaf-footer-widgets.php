<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
/**
 * 
 * Footer Widgets .
 *
 */
class Ensaf_Footer_Widgets extends Widget_Base {

	public function get_name() {
		return 'ensaffooterwidgets';
	}
	public function get_title() {
		return __( 'Footer Widgets', 'ensaf' ); 
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label'     => __( 'Footer Widget Style', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

        ensaf_media_fields( $this, 'logo', 'Choose Logo', ['1'] );
		ensaf_general_fields( $this, 'title', 'Title', 'TEXT', 'Title', ['2'] );
		ensaf_general_fields( $this, 'desc', 'Description', 'TEXTAREA', '', ['1', '2'] );

        ensaf_social_fields( $this, 'social_icon_list', 'Social Media', ['1'] );

        ensaf_general_fields( $this, 'n_placeholder', 'Placeholder', 'TEXT', 'Enter your Email', ['2'] );
		// ensaf_general_fields( $this, 'n_button', 'Subscribe Button', 'TEXT', 'Subscribe', ['2'] );
        
        ensaf_general_fields( $this, 'extra', 'Content', 'TEXTAREA', '', ['2'] );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		ensaf_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .widget_title', ['2', '3'] );
		ensaf_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .desc', ['1', '2'] );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="widget footer-widget">';
                echo '<div class="th-widget-about">';
                    if(!empty($settings['logo']['url'])){
                        echo '<div class="about-logo">';
                            echo '<a href="'.esc_url( home_url('/') ).'">';
                                echo ensaf_img_tag( array(
                                    'url'   => esc_url( $settings['logo']['url'] ),
                                ));
                            echo '</a>';
                        echo '</div>';
                    }
                    if($settings['desc']){
                        echo '<p class="about-text desc">'.esc_html($settings['desc']).'</p>';
                    }
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
            echo '</div> ';

		}elseif( $settings['layout_style'] == '2' ){
            echo '<div class="widget footer-widget">';
                if($settings['title']){
                    echo '<h3 class="widget_title">';
                        echo esc_html($settings['title']);
                    echo '</h3>';
                }
                echo '<div class="newsletter-widget">';
                    if($settings['desc']){
                        echo '<p class="footer-text desc">'.esc_html($settings['desc']).'</p>';
                    }
                    echo '<form action="#" class="newsletter-form">';
                        echo '<div class="form-group">';
                            echo '<input class="form-control" type="email" placeholder="'.esc_attr( $settings['n_placeholder'] ).'" required="">';
                        echo '</div>';
                        echo '<button type="submit" class="icon-btn"><i class="fa-solid fa-paper-plane"></i></button>';
                    echo '</form>';
                    if($settings['extra']){
                        echo '<p class="footer-text desc">'.esc_html($settings['extra']).'</p>';
                    }
                echo '</div>';
            echo '</div>';
            
		}elseif( $settings['layout_style'] == '3' ){


        }
	

	}
}
						