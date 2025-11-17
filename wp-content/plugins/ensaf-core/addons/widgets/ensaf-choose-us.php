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
 * Choose Us Widget .
 *
 */
class ensaf_Choose_Us extends Widget_Base {

	public function get_name() {
		return 'ensafchooseus';
	}
	public function get_title() {
		return __( 'Choose Us', 'ensaf' );
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
				'label'		 	=> __( 'Choose Us', 'ensaf' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
				
			]
        );

		ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One','Style Two' ] );

		ensaf_media_fields( $this, 'image', 'Choose Image', [ '1','2'] );
		ensaf_url_fields( $this, 'video_url', 'Video URL', [ '1','2']  );

		$repeater = new Repeater();

		ensaf_media_fields($repeater, 'choose_icon', 'Choose Icon');
		ensaf_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Professional Technician');
		ensaf_general_fields($repeater, 'description', 'Description', 'TEXTAREA', ''); 

		$this->add_control(
			'choose_list',
			[
				'label' 		=> __( 'Choose Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Professional Technician', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

		$choose_list2 = new Repeater();

		ensaf_media_fields($choose_list2, 'choose_icon', 'Choose Icon');
		ensaf_general_fields($choose_list2, 'title', 'Title', 'TEXTAREA2', 'Professional Technician');
		ensaf_general_fields($choose_list2, 'description', 'Description', 'TEXTAREA', '');
		ensaf_url_fields($choose_list2, 'url', 'URL'); 

		$this->add_control(
			'choose_list2',
			[
				'label' 		=> __( 'Choose Lists', 'ensaf' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $choose_list2->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Professional Technician', 'ensaf' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['2']
				]
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		ensaf_common_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title' );
		ensaf_common_style_fields( $this, '02', 'Description', '{{WRAPPER}} P' );


	}


	protected function render() {

        $settings = $this->get_settings_for_display();

			if( $settings['layout_style'] == '1' ){
				echo '<div class="row gy-4 gy-md-5 gy-xl-3 align-items-center">';
					echo '<div class="col-md-6 col-xl-3 order-2 order-xl-0">';
						echo '<div class="row justify-content-xl-end gy-4 gy-md-5">';
							foreach( $settings['choose_list'] as $key => $data ){
								if ($key % 2 == 0) {
									echo '<div class="col-xxl-12">';
										echo '<div class="choose-card text-center text-sm-start flex-xl-row-reverse">';
											if(!empty($data['choose_icon']['url'])){
												echo '<div class="icon">';
													echo ensaf_img_tag( array(
														'url'   => esc_url( $data['choose_icon']['url'] ),
													));
												echo '</div>';
											}
											echo '<div class="content text-xl-end">';
												if(!empty($data['title'])){
													echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
												}
												if(!empty($data['description'])){
													echo '<p>'.esc_html($data['description']).'</p>';
												}
											echo '</div>';
										echo '</div>';
									echo '</div>';
								}
							}
						echo '</div>';
					echo '</div>';
					echo '<div class="col-xl-6 order-1 order-xl-0">';
						if(!empty($settings['image']['url'])){
							echo '<div class="choose-card-thumb text-center mb-5 mb-md-0">';
								echo '<div class="choose-card-thumb-play-btn">';
									if(!empty($settings['video_url']['url'])){
										echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn style2 popup-video">';
											echo '<i class="fa-sharp fa-solid fa-play"></i>';
										echo '</a>';
									}
								echo '</div>';
								echo ensaf_img_tag( array(
									'url'   => esc_url( $settings['image']['url'] ),
								));
							echo '</div>';
						}
					echo '</div>';
					echo '<div class="col-md-6 col-xl-3 order-3 order-xl-0">';
						echo '<div class="row gy-4 gy-md-5">';
							foreach( $settings['choose_list'] as $key => $data ){
								if ($key % 2 !== 0) {
									echo '<div class="col-xxl-12">';
										echo '<div class="choose-card text-center text-sm-start">';
											if(!empty($data['choose_icon']['url'])){
												echo '<div class="icon">';
													echo ensaf_img_tag( array(
														'url'   => esc_url( $data['choose_icon']['url'] ),
													));
												echo '</div>';
											}
											echo '<div class="content">';
												if(!empty($data['title'])){
													echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
												}
												if(!empty($data['description'])){
													echo '<p>'.esc_html($data['description']).'</p>';
												}
											echo '</div>';
										echo '</div>';
									echo '</div>';
								}
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
				
			}elseif( $settings['layout_style'] == '2' ){

				echo '<div class="row gy-4 gy-md-5 gy-xl-3 align-items-center">';
	                echo '<div class="col-md-6 col-xl-3 order-2 order-xl-0">';
	                    echo '<div class="row justify-content-xl-end gy-4 gy-md-5">';
	                    	foreach( $settings['choose_list2'] as $key => $data ){
								if ($key % 2 == 0) {
			                        echo '<div class="col-xxl-12">';
			                            echo '<div class="choose-card text-center text-sm-start flex-xl-row-reverse">';
			                                echo '<div class="icon">';
			                                	echo ensaf_img_tag( array(
													'url'   => esc_url( $data['choose_icon']['url'] ),
												));
			                                echo '</div>';
			                                echo '<div class="content why-content3 text-xl-end">';
			                                	if(!empty($data['title'])){
			                                    	echo '<h3 class="box-title"><a href="'.esc_url($data['url']['url']).'">'.esc_html($data['title']).'</a></h3>';
			                                    }
			                                    if(!empty($data['description'])){	
			                                    	echo '<p>'.esc_html($data['description']).'</p>';
			                                    }	
			                                echo '</div>';
			                            echo '</div>';
			                        echo '</div>';
	                        	}
							}
	                    echo '</div>';
	                echo '</div>';
	                echo '<div class="col-xl-6 order-1 order-xl-0">';
						echo '<div class="choose-card-thumb text-center mb-5 mb-md-0">';
	                        echo '<div class="choose-card-thumb-play-btn">';
	                            echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn style2 popup-video">
	                                <i class="fa-sharp fa-solid fa-play"></i>
	                            </a>';
	                        echo '</div>';
	                       echo ensaf_img_tag( array(
								'url'   => esc_url( $settings['image']['url'] ),
							));
	                    echo '</div>';
	                echo '</div>';
	                echo '<div class="col-md-6 col-xl-3 order-3 order-xl-0">';
	                    echo '<div class="row gy-4 gy-md-5">';
	                    	foreach( $settings['choose_list2'] as $key => $data ){
								if ($key % 2 !== 0) {
			                        echo '<div class="col-xxl-12">';
			                            echo '<div class="choose-card text-center text-sm-start">';
			                                echo '<div class="icon">';
			                                    echo ensaf_img_tag( array(
													'url'   => esc_url( $data['choose_icon']['url'] ),
												));
			                                echo '</div>';
			                                echo ' <div class="content why-content3">';
			                                	if(!empty($data['description'])){
			                                    	echo '<h3 class="box-title"><a href="'.esc_url($data['url']['url']).'">'.esc_html($data['title']).'</a></h3>';
			                                    }
			                                    if(!empty($data['description'])){
			                                    	echo '<p>'.esc_html($data['description']).'</p>';
			                                    }	
			                                echo '</div>';
			                            echo '</div>';
			                        echo '</div>';
	                        	}
							}
	                    echo '</div>';
	                echo '</div>';
	            echo '</div>';


			}


	}

}