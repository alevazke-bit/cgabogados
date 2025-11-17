<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Countdown Widget .
 *
 */
class Ensaf_Countdown extends Widget_Base {

	public function get_name() {
		return 'ensafcountdown';
	}
	public function get_title() {
		return __( 'Countdown', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'counter_section',
			[
				'label' 	=> __( 'Countdown', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One','Style Two' ] ); 

        ensaf_media_fields( $this, 'shape', 'Choose Shape', ['1'] );
		ensaf_general_fields( $this, 'title', 'Title', 'TEXTAREA', 'Noise' );
		ensaf_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'GET TICKETS' );
		ensaf_url_fields( $this, 'button_url', 'Button URL' );
        ensaf_switcher_fields( $this, 'show_date', 'Show Countdown?', ['1'] );
        $this->add_control(
			'date', [
				'label' 		=> __( 'Offer End Date With Time', 'ensaf' ),
				'type' 			=> Controls_Manager::DATE_TIME,
				'label_block' 	=> true,
			]
        );

        $repeater = new Repeater();

        ensaf_general_fields($repeater, 'number', 'Number', 'TEXTAREA2', '100');
        ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Title'); 
        ensaf_general_fields($repeater, 'description', 'Content', 'TEXTAREA2', 'Completed Projects'); 

        $this->add_control(
            'counter_lists',
            [
                'label'         => __( 'Counter List', 'ensaf' ),
                'type'          => Controls_Manager::REPEATER,
                'fields'        => $repeater->get_controls(),
                'default'       => [
                    [
                        'number'    => __( '100', 'ensaf' ),
                    ],
                ],
                'condition' => [
                    'layout_style' => ['2']
                ]
            ]
        );


		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		
        //-------Title Style-------
        ensaf_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title' );
        //------Button Style (gradient-color)-------
        ensaf_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th_btn' );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            $offer_date_end = $settings['date'];
            $replace 	= array('-');
            $with 		= array('/');
    
            $date 	= str_replace( $replace, $with, $offer_date_end );

			echo '<div class="countdown-area" data-bg-src="'.esc_url($settings['bg']['url']).'">';
                echo '<div class="row gx-60 align-items-center">';
                if($settings['show_date'] == 'yes'){
                    echo '<div class="col-xl-7">';
                        echo '<ul class="counter-list event-counter" data-offer-date="'.esc_attr($date).'">';
                            echo '<li>';
                                echo '<div class="day count-number">00</div>';
                                echo '<span class="count-name">'.esc_html__('Days', 'ensaf').'</span>';
                            echo '</li>';
                            echo '<li>';
                                echo '<div class="hour count-number">00</div>';
                                echo '<span class="count-name">'.esc_html__('Hour', 'ensaf').'</span>';
                            echo '</li>';
                            echo '<li>';
                                echo '<div class="minute count-number">00</div>';
                                echo '<span class="count-name">'.esc_html__('Minute', 'ensaf').'</span>';
                            echo '</li>';
                            echo '<li>';
                                echo '<div class="seconds count-number">00</div>';
                                echo '<span class="count-name">'.esc_html__('Second', 'ensaf').'</span>';
                            echo '</li>';
                        echo '</ul>';
                    echo '</div>';
                }
                    echo '<div class="col-xl-5">';
                        echo '<div class="ms-0 ms-xl-3 mt-35 mt-xl-0 text-center text-xl-start">';
                            if(!empty($settings['title'])){
                                echo '<h3 class="sec-title mb-20 title">'.wp_kses_post($settings['title']).'</h3>';
                            }
                            if(!empty($settings['button_text'])){
                                echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn gr-bg1 shadow-none th_btn">'.wp_kses_post($settings['button_text']).'</a>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){

            echo '<div class="about-2-bottom">';
                foreach( $settings['counter_lists'] as $data ){
                    echo '<div class="info-box">';
                        echo '<div class="about-progress">';
                            echo '<section class="" data-pos-space=".circle-bg" data-sec-space="margin-bottom" data-margin-bottom="225px">';
                               echo ' <div class="container p-0">';
                                    echo '<div class="row gx-0 gy-4">';
                                        echo '<div class="col-xl-2 col-lg-3 col-sm-4">';
                                            echo '<div class="circle-progressbar">';
                                                echo '<div class="circular-progress" data-target="90" data-theme-color="#B68C5A">';
                                                    echo '<svg viewBox="0 0 36 36">
                                                        <path class="circle-bg" d="M18 2 a16 16 0 1 1 0 32 a16 16 0 1 1 0 -32" />
                                                        <path class="circle" d="M18 2 a16 16 0 1 1 0 32 a16 16 0 1 1 0 -32" />
                                                    </svg>';
                                                    if(!empty($data['number'])){
                                                        echo '<div class="circle-progressbar-content">';
                                                            echo '<h6 class="percentage">'.wp_kses_post($data['number']).'</h6>';
                                                        echo '</div>';
                                                    }
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</section>';
                        echo '</div>';
                        echo '<div class="info-contnt">';
                            if(!empty($data['button_text'])){
                                echo '<h5 class="box-title">'.wp_kses_post($data['title']).'</h5>';
                            }
                            if(!empty($data['button_text'])){    
                                echo '<p>'.wp_kses_post($data['title']).'</p>';
                            }    
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
		

		}

	
	}

}