<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Blog Post Widget .
 *
 */
class Ensaf_Blog extends Widget_Base {

	public function get_name() {
		return 'ensafblog';
	}
	public function get_title() {
		return __( 'Blog Post', 'ensaf' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'ensaf' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'blog_post_section',
			[
				'label' => __( 'Blog Post', 'ensaf' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        ensaf_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three','Style Four','Style Five' ] );

        ensaf_general_fields($this, 'arrow_id', 'Arrow ID or Class', 'TEXT', 'blogSlider1', ['1', '2']);

        $this->add_control(
			'blog_post_count',
			[
				'label' 	=> __( 'No of Post to show', 'ensaf' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default'  	=> __( '3', 'ensaf' )
			]
        );

        ensaf_general_fields( $this, 'title_count', 'Title Length', 'TEXT2', '6');
        ensaf_general_fields( $this, 'excerpt_count', 'Excerpt Length', 'TEXT2', '14' );

        $this->add_control(
			'blog_post_order',
			[
				'label' 	=> __( 'Order', 'ensaf' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ASC'   	=> __('ASC','ensaf'),
                    'DESC'   	=> __('DESC','ensaf'),
                ],
                'default'  	=> 'DESC'
			]
        );
        $this->add_control(
			'blog_post_order_by',
			[
				'label' 	=> __( 'Order By', 'ensaf' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ID'    	=> __( 'ID', 'ensaf' ),
                    'author'    => __( 'Author', 'ensaf' ),
                    'title'    	=> __( 'Title', 'ensaf' ),
                    'date'    	=> __( 'Date', 'ensaf' ),
                    'rand'    	=> __( 'Random', 'ensaf' ),
                ],
                'default'  	=> 'ID'
			]
        );
       
        $this->add_control(
            'post_display_type',
            [
                'label'   => __( 'Post Display Type', 'ensaf' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'all'      => __( 'All Posts', 'ensaf' ),
                    'category' => __( 'Category', 'ensaf' ),
                    'tags'     => __( 'Tags', 'ensaf' ),
                ],
                'default' => 'category',
            ]
        );        

        $this->add_control(
            'post_customization_note',
            [
                'type'    => \Elementor\Controls_Manager::RAW_HTML,
                'raw'     => __( '<strong>All posts are displayed by default.</strong><br>Use the "Include" or "Exclude" options below to customize which categories, tags, or specific posts should be shown or hidden.', 'ensaf' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'     => [
                    'post_display_type' => 'all',
                ],
            ]
        );
        $this->add_control(
            'include_exclude_option',
            [
                'label'   => __( 'Include or Exclude', 'ensaf' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'include' => __( 'Include', 'ensaf' ),
                    'exclude' => __( 'Exclude', 'ensaf' ),
                ],
                'default' => 'exclude',
                'condition'     => [
                    'post_display_type' => 'all',
                ],
            ]
        );
        
        $this->add_control(
            'blog_categories',
            [
                'label'         => __( 'Categories', 'ensaf' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => $this->ensaf_get_categories(),
                'label_block'   => true,
                'condition'     => [
                    'post_display_type' => ['category', 'all'],
                ],
            ]
        );
        $this->add_control(
            'blog_tags',
            [
                'label'         => __( 'Tags', 'ensaf' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => $this->ensaf_get_tags(),
                'label_block'   => true,
                'condition'     => [
                    'post_display_type' => ['tags', 'all'],
                ],
            ]
        );
        $this->add_control(
            'blog_posts',
            [
                'label'         => __( 'Posts', 'ensaf' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
                'options'       => $this->ensaf_post_id(),
                'label_block'   => true,
                'condition'     => [
                    'post_display_type' => 'all',
                ],
            ]
        );

        ensaf_general_fields( $this, 'button_text', 'Read More Text', 'TEXTAREA2', 'Read More' );

        // Get all registered image sizes
        $image_sizes = get_intermediate_image_sizes(); 
        $options = [];
        foreach ( $image_sizes as $size ) {
            $options[ $size ] = ucfirst( str_replace( '_', ' ', $size ) );
        }
        $this->add_control(
            'image_resolution',
            [
                'label'       => __( 'Image Resolution', 'ensaf' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'thumbnail',
                'options'     => $options,
            ]
        ); 

        ensaf_switcher_fields( $this, 'show_post_meta_icons', 'Display Post Meta Icons?' );
        ensaf_switcher_fields( $this, 'show_author', 'Display Post Author?' );
        ensaf_switcher_fields( $this, 'show_date', 'Display Post Date?' );
        ensaf_switcher_fields( $this, 'show_category', 'Display Post Category?' );
        ensaf_switcher_fields( $this, 'show_comment', 'Display Post Comment?' );

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//--------------------------------------- 

		//-------Title Style-------
		ensaf_common2_style_fields( $this, '01', 'Title', '{{WRAPPER}} .box-title a' );
		ensaf_common_style_fields( $this, '02', 'Content', '{{WRAPPER}} .box-text' );

        //-------Button Style-------
		$this->start_controls_section(
			'button_styling',
			[
				'label'     => __( 'Button Styling', 'ensaf' ),
				'tab'       => Controls_Manager::TAB_STYLE,
                'condition'		=> [ 
					'layout_style' => ['1', '2', '3', '4'] 
				],
			]
        );

		ensaf_color_fields( $this, 'color11', 'Color', '--title-color', '{{WRAPPER}} .line-btn', ['1'] );
		ensaf_color_fields( $this, 'color22', 'Hover Color', '--theme-color', '{{WRAPPER}} .line-btn:hover', ['1'] );          

		$this->end_controls_section();

    }

    public function ensaf_get_categories() {
        $cats = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        ));

        $cat = [];

        foreach( $cats as $singlecat ) {
            $cat[$singlecat->term_id] = __($singlecat->name,'ensaf');
        }

        return $cat;
    }

    public function ensaf_get_tags() {
        $tags = get_terms(array(
            'taxonomy' => 'post_tag',
            'hide_empty' => true,
        ));

        $tag = [];

        foreach( $tags as $singletag ) {
            $tag[$singletag->term_id] = __($singletag->name,'ensaf');
        }

        return $tag;
    }

    // Get Specific Post
    public function ensaf_post_id(){
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        );

        $ensaf_post = new WP_Query( $args );

        $postarray = [];

        while( $ensaf_post->have_posts() ){
            $ensaf_post->the_post();
            $postarray[get_the_Id()] = get_the_title();
        }
        wp_reset_postdata();
        return $postarray;
    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        $post_display_type = $settings['post_display_type'];
        $include_exclude_option = isset($settings['include_exclude_option']) ? $settings['include_exclude_option'] : 'exclude';
        $blog_posts = !empty($settings['blog_posts']) ? $settings['blog_posts'] : [];
        $blog_categories = !empty($settings['blog_categories']) ? $settings['blog_categories'] : [];
        $blog_tags = !empty($settings['blog_tags']) ? $settings['blog_tags'] : [];
        
        // Default query arguments
        $args = [
            'post_type'             => 'post',
            'posts_per_page'        => !empty($settings['blog_post_count']) ? esc_attr($settings['blog_post_count']) : 3,
            'order'                 => !empty($settings['blog_post_order']) ? esc_attr($settings['blog_post_order']) : 'DESC',
            'orderby'               => !empty($settings['blog_post_order_by']) ? esc_attr($settings['blog_post_order_by']) : 'ID',
            'ignore_sticky_posts'   => true,
        ];
        
        // Modify query based on `post_display_type` and `include_exclude_option`
        if ($post_display_type === 'all') {
            if ($include_exclude_option === 'include') {
                if (!empty($blog_posts)) {
                    $args['post__in'] = $blog_posts;
                }
                if (!empty($blog_categories)) {
                    $args['category__in'] = $blog_categories;
                }
                if (!empty($blog_tags)) {
                    $args['tag__in'] = $blog_tags;
                }
            } elseif ($include_exclude_option === 'exclude') {
                if (!empty($blog_posts)) {
                    $args['post__not_in'] = $blog_posts;
                }
                if (!empty($blog_categories)) {
                    $args['category__not_in'] = $blog_categories;
                }
                if (!empty($blog_tags)) {
                    $args['tag__not_in'] = $blog_tags;
                }
            }
        } elseif ($post_display_type === 'category') {
            // Show posts only from selected categories
            $args['category__in'] = $blog_categories;

        } elseif ($post_display_type === 'tags') {
            // Show posts only from selected tags
            $args['tag__in'] = $blog_tags;
            
        }
        
        // Create the WP_Query
        $blogpost = new WP_Query($args);     
        
        // Get the dynamic image resolution setting
        $image_resolution = !empty($settings['image_resolution']) ? $settings['image_resolution'] : 'ensaf-shop-small-image';
        

		if( $settings['layout_style'] == '5'  ){
            echo '<div class="slider-area blog-slider5">';
                echo '<div class="swiper th-slider has-shadow" id="'.esc_attr($settings['arrow_id']).'" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}, "autoHeight": "true"}\'>';
                    echo '<div class="swiper-wrapper">';
                        while( $blogpost->have_posts() ){
                            $blogpost->the_post(); 
                            $categories = get_the_category();
                            $content = get_the_content();
                            $title_count =  $settings['title_count'];
                            $excerpt_count =  $settings['excerpt_count'];

                            echo '<div class="swiper-slide">';
                                echo '<div class="blog-card style-4">';
                                    if ( has_post_thumbnail() ) {
                                        echo '<div class="blog-img">';
                                            echo '<a href="'.esc_url( get_permalink() ).'">';
                                                the_post_thumbnail( $image_resolution );
                                            echo '</a>';
                                        echo '</div>';
                                    }
                                    echo '<div class="blog-content">';
                                        echo '<div class="blog-meta">';
                                            if(!empty($settings['show_author'])){
                                                echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="fa-regular fa-user"></i>';
                                                    }
                                                    echo esc_html__('By ', 'ensaf') . esc_html( ucwords( get_the_author() ) );
                                                echo '</a>';
                                            }
                                            if(!empty($settings['show_date'])){
                                                echo '<a href="'.esc_url( ensaf_blog_date_permalink() ).'">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="fa-regular fa-calendar"></i>';
                                                    }
                                                    echo esc_html( get_the_date() );
                                                echo '</a>';
                                            }
                                            if(!empty($settings['show_category'])){
                                                if(!empty($categories)){
                                                    echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">';
                                                        if(!empty($settings['show_post_meta_icons'])){
                                                            echo '<i class="far fa-tag"></i>';
                                                        }
                                                        echo esc_html( $categories[0]->name );
                                                    echo '</a>';
                                                }
                                            }
                                            if(!empty($settings['show_comment'])){
                                                $commnet = (get_comments_number() == 1) ? ' Comment ':' Comments ';
                                                echo '<a href="#">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="fa-regular fa-comment"></i>';
                                                    }
                                                    echo get_comments_number() . esc_html__($commnet, 'ensaf');
                                                echo '</a>';
                                            }
                                        echo '</div>';
                                        echo '<h3 class="box-title"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ),  $title_count , '' ) ).'</a></h3>';
                                        if ( ! empty( $content && $excerpt_count ) ) {
                                            echo '<p class="box-text pb-3">' . esc_html( wp_trim_words( $content, $excerpt_count , '' ) ) . '</p>';
                                        }
                                        if(!empty($settings['button_text'])){
                                            echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn style4">'.wp_kses_post($settings['button_text']).'</a>';
                                        }
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';

                        }wp_reset_postdata(); 
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}else{
            if( $settings['layout_style'] == '2'  ){
                $style = ' style-2';
            }elseif( $settings['layout_style'] == '3'  ){
                $style = ' style-2 style-3';
            }elseif( $settings['layout_style'] == '4'  ){
                $style = ' style-4';
            }elseif( $settings['layout_style'] == '5'  ){
                $style = ' style-5';
            }else{
                $style = '';
            }

            if($settings['layout_style'] == '4' ){
                $btn_class = 'th-btn style4';
            }else{
                $btn_class = 'line-btn';
            }
            echo '<div class="slider-area">';
                echo '<div class="swiper th-slider has-shadow" id="'.esc_attr($settings['arrow_id']).'" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}, "autoHeight": "true"}\'>';
                    echo '<div class="swiper-wrapper">';
                        while( $blogpost->have_posts() ){
                            $blogpost->the_post(); 
                            $categories = get_the_category();
                            $content = get_the_content();
                            $title_count =  $settings['title_count'];
                            $excerpt_count =  $settings['excerpt_count'];

                            echo '<div class="swiper-slide">';
                                echo '<div class="blog-card '.esc_attr($style).'">';
                                    if ( has_post_thumbnail() ) {
                                        echo '<div class="blog-img">';
                                            echo '<a href="'.esc_url( get_permalink() ).'">';
                                                the_post_thumbnail( $image_resolution );
                                            echo '</a>';
                                        echo '</div>';
                                    }
                                    echo '<div class="blog-content">';
                                        echo '<div class="blog-meta">';
                                            if(!empty($settings['show_author'])){
                                                echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="fa-regular fa-user"></i>';
                                                    }
                                                    echo esc_html__('By ', 'ensaf') . esc_html( ucwords( get_the_author() ) );
                                                echo '</a>';
                                            }
                                            if(!empty($settings['show_date'])){
                                                echo '<a href="'.esc_url( ensaf_blog_date_permalink() ).'">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="fa-regular fa-calendar"></i>';
                                                    }
                                                    echo esc_html( get_the_date() );
                                                echo '</a>';
                                            }
                                            if(!empty($settings['show_category'])){
                                                if(!empty($categories)){
                                                    echo '<a href="'.esc_url( get_category_link( $categories[0]->term_id ) ).'">';
                                                        if(!empty($settings['show_post_meta_icons'])){
                                                            echo '<i class="far fa-tag"></i>';
                                                        }
                                                        echo esc_html( $categories[0]->name );
                                                    echo '</a>';
                                                }
                                            }
                                            if(!empty($settings['show_comment'])){
                                                $commnet = (get_comments_number() == 1) ? ' Comment ':' Comments ';
                                                echo '<a href="#">';
                                                    if(!empty($settings['show_post_meta_icons'])){
                                                        echo '<i class="fa-regular fa-comment"></i>';
                                                    }
                                                    echo get_comments_number() . esc_html__($commnet, 'ensaf');
                                                echo '</a>';
                                            }
                                        echo '</div>';
                                        echo '<h3 class="box-title"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ),  $title_count , '' ) ).'</a></h3>';
                                        if ( ! empty( $content && $excerpt_count ) ) {
                                            echo '<p class="box-text pb-3">' . esc_html( wp_trim_words( $content, $excerpt_count , '' ) ) . '</p>';
                                        }
                                        if(!empty($settings['button_text'])){
                                            echo '<a href="'.esc_url( get_permalink() ).'" class="'.esc_attr($btn_class).'">'.wp_kses_post($settings['button_text']).'</a>';
                                        }
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';

                        }wp_reset_postdata(); 
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }
	
      
	}
}