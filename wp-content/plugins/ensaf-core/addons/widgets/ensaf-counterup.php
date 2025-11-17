<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Counter Up Widget .
 *
 */
class ensaf_Counterup extends Widget_Base {

	public function get_name() {
		return 'ensafcounterup';
	}
	public function get_title() {
		return __( 'Counter Up', 'ensaf' );
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
				'label' 	=> __( 'Counter Up', 'ensaf' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two','Style Three','Style Four','Style Five' ] ); 

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'choose_icon', 'Choose Icon');
		ensaf_general_fields($repeater, 'number', 'Number', 'TEXTAREA2', '100');
		ensaf_general_fields($repeater, 'after_prefix', 'After Prefix', 'TEXT2', 'k');
		ensaf_general_fields($repeater, 'after_prefix2', 'After Prefix 2', 'TEXT2', '+');
		ensaf_general_fields($repeater, 'description', 'Content', 'TEXTAREA2', 'Completed Projects'); 

		$this->add_control(
			'counter_lists',
			[
				'label' 		=> __( 'Counter List', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'number' 	=> __( '100', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1', '2','3','4']
				]
			]
		);

		$counter_list2 = new Repeater();

        ensaf_general_fields($counter_list2, 'number', 'Number', 'TEXTAREA2', '100');
        ensaf_general_fields($counter_list2, 'title', 'Title', 'TEXTAREA2', 'Title'); 
        ensaf_general_fields($counter_list2, 'description', 'Content', 'TEXTAREA2', 'Completed Projects'); 

        $this->add_control(
            'counter_list2',
            [
                'label'         => __( 'Counter List', 'ensaf' ),
                'type'          => Controls_Manager::REPEATER,
                'fields'        => $counter_list2->get_controls(),
                'default'       => [
                    [
                        'number'    => __( '100', 'ensaf' ),
                    ],
                ],
                'condition' => [
                    'layout_style' => ['5']
                ]
            ]
        );



		ensaf_media_fields($this, 'shape_one', 'Shape One', ['3']);
		ensaf_media_fields($this, 'shape_two', 'Shape Two', ['3']);

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------General Style-------
		$this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'Background Styling', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		ensaf_color_fields( $this, 'bg1', 'Background', 'background', '{{WRAPPER}} .counter-card-wrap', ['1', '2'] );     

		$this->end_controls_section();

		ensaf_common_style_fields($this, '01', 'Number', '{{WRAPPER}} .box-number .counter-number, {{WRAPPER}} .box-title .counter-number' );
		ensaf_common_style_fields($this, '02', 'Number Prefix', '{{WRAPPER}} .box-number, {{WRAPPER}} .box-title');
		ensaf_common_style_fields($this, '03', 'Content', '{{WRAPPER}} .box-text');

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '3' ){

			echo '<div class="counter-sec4 counter-4">';
				if(!empty($settings['shape_one']['url'])){
			        echo '<div class="shape-mockup d-none d-sm-block" data-top="0%" data-left="0%">';
			            echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape_one']['url'] ),
						));
			        echo '</div>';
			    }
			    if(!empty($settings['shape_two']['url'])){    
			        echo '<div class="shape-mockup d-none d-sm-block" data-top="0%" data-right="0%">';
			            echo ensaf_img_tag( array(
							'url'   => esc_url( $settings['shape_two']['url'] ),
						));
			        echo '</div>';
			    }   
		        echo '<div class="container">';
		            echo '<div class="counter-card-wrap style-4">';
		            	foreach( $settings['counter_lists'] as $data ){
			                echo '<div class="counter-card">';
			                    echo '<div class="box-icon">';
			                        echo ensaf_img_tag( array(
										'url'   => esc_url( $data['choose_icon']['url'] ),
									));
			                    echo '</div>';
			                    echo '<div class="media-body">';
			                        echo '<h4 class="box-number"><span class="counter-number"> '.esc_html( $data['number'] ).' </span>'.esc_html( $data['after_prefix'] ).' <span class="plus-simple">'.esc_html( $data['after_prefix2'] ).'</span></h4>';
			                        echo '<p class="box-text">'.esc_html( $data['description'] ).'</p>';
			                    echo '</div>';
			                echo '</div>';
			                echo '<div class="divider"></div>';
			            }    
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){

			echo '<div class="counter-card-wrap style-5">';
				foreach( $settings['counter_lists'] as $data ){
	                echo '<div class="counter-card">';
	                    echo '<div class="box-icon">';
	                   		echo ensaf_img_tag( array(
								'url'   => esc_url( $data['choose_icon']['url'] ),
							));
	                    echo '</div>';
	                    echo '<div class="media-body">';
	                        echo '<h4 class="box-number"><span class="counter-number">'.esc_html( $data['number'] ).'</span>'.esc_html( $data['after_prefix'] ).' <span class="plus-simple">'.esc_html( $data['after_prefix2'] ).'</span></h4>';
	                        if(!empty($data['description'])){
								echo '<p class="box-text">'.esc_html( $data['description'] ).'</p>';
							}
	                    echo '</div>';
	                echo '</div>';
	                echo '<div class="divider"></div>';
                }
            echo '</div>';

        }elseif( $settings['layout_style'] == '5' ){

        	echo '<div class="about-2-bottom">';
                foreach( $settings['counter_list2'] as $data ){
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
                            if(!empty($data['title'])){
                                echo '<h5 class="box-title">'.wp_kses_post($data['title']).'</h5>';
                            }
                            if(!empty($data['description'])){    
                                echo '<p>'.wp_kses_post($data['description']).'</p>';
                            }    
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
            
		}else{
			if( $settings['layout_style'] == '2'  ){
                $style = ' style-2';
            }else{
                $style = '';
            }
			echo '<div class="counter-card-wrap '.esc_attr($style).'">';
				foreach( $settings['counter_lists'] as $data ){
					echo '<div class="counter-card">';
						if(!empty($data['choose_icon']['url'])){
							echo '<div class="box-icon">';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $data['choose_icon']['url'] ),
								));
							echo '</div>';
						}
						echo '<div class="media-body">';
							if(!empty($data['number'])){
								echo '<h4 class="box-number"><span class="counter-number">'.esc_html( $data['number'] ).'</span>'.esc_html( $data['after_prefix'] ).'<span class="plus-simple"> '.esc_html( $data['after_prefix2'] ).'</span></h4>';
							}
							if(!empty($data['description'])){
								echo '<p class="box-text">'.esc_html( $data['description'] ).'</p>';
							}
						echo '</div>';
					echo '</div>';
					echo '<div class="divider"></div>';
				}
			echo '</div>';

		}

	
	}

}