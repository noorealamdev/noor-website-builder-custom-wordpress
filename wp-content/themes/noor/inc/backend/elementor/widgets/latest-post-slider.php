<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Latest Posts Carousel
 */
class Latest_Posts_Slider extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-latest-posts-carousel';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'N Latest Posts Carousel', 'noor' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-slider-push';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_noor' ];
	}

	protected function register_controls() {

		//Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Post', 'noor' ),
			]
		);
		$this->add_control(
			'post_cat',
			[
				'label' => __( 'Select Categories', 'noor' ),
				'type' => Controls_Manager::SELECT2,
				'options' => self::select_param_cate_post(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'noor' ),
			]
		);
		$this->add_control(
			'posts_show_number',
			[
				'label' => __( 'Show Number Post', 'noor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'post_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'style_layout',
			[
				'label' => __( 'Layout Style', 'noor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  	=> __( 'Style 1', 'noor' ),
					'style-2' 	=> __( 'Style 2', 'noor' ),
				],
			]
		);

		$this->add_control(
			'caption_hover',
			[
				'label' => __( 'Caption Image Hover', 'noor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'noor' ),
			]
		);

		$this->add_control(
			'is_exc',
			[
				'label' => __( 'Show Excerpt', 'noor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'noor' ),
				'label_off' => __( 'No', 'noor' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->add_control(
			'exc_lenght',
			[
				'label' => __( 'Excerpt Lenght', 'noor' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 16,
				'condition' => [
					'is_exc' => 'yes'
				]
			]
		);

		/* Option Slider */

		$slides_show = range( 1, 10 );
		$slides_show = array_combine( $slides_show, $slides_show );

		$this->add_control(
			'heading_slider_option',
			[
				'label' => __( 'Slider Option', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_responsive_control(
			'tshow',
			[
				'label' => __( 'Slides To Show', 'noor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'noor' ),
				] + $slides_show,
				'default' => ''
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'noor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Autoplay', 'noor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'timeout',
			[
				'label' => __( 'Autoplay Timeout', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 20000,
						'step' => 1000,
					],
				],
				'default' => [
					'size' => 7000,
				],
				'condition' => [
					'autoplay' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'slider_spacing',
			[
				'label' => __( 'Slider Spacing <span class="elementor-control-field-description">(Min: 30px)</span>', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 200,
					],
				],
			]
		);
		
		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'noor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'both' => __( 'Arrows and Dots', 'noor' ),
					'arrows' => __( 'Arrows', 'noor' ),
					'dots' => __( 'Dots', 'noor' ),
					'none' => __( 'None', 'noor' ),
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'general_style_section',
			[
				'label' => __( 'General', 'noor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'noor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'noor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'noor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'noor' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'selectors' => [
					'{{WRAPPER}} .post-item' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => __( 'Spacing', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
				],
				'condition' => [
					'style_layout'	=> 'style-1'
				]
			]
		);

		$this->add_control(
			'overlay_bgcolor',
			[
				'label' => __( 'Background Overlay', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .overlay span.bg' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'caption_color',
			[
				'label' => __( 'Caption Overlay', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .overlay h5' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .overlay h5',
			]
		);
		$this->add_control(
			'radius_thumb',
			[
				'label' => __( 'Border Radius', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rounded, 
					 {{WRAPPER}} .rounded img,
					 {{WRAPPER}} .card' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .card-img-top,
					 {{WRAPPER}} .card-img-top img' => 'border-top-left-radius: {{SIZE}}{{UNIT}}; border-top-right-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		/* title */
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __( 'Spacing', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-title .title-link' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Hover Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-title .title-link:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .post-title',
			]
		);

		/* category */
		$this->add_control(
			'heading_cat',
			[
				'label' => __( 'Category', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'cat_spacing',
			[
				'label' => __( 'Spacing', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-cates' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'cat_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-cates a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .text-line:before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'cat_hcolor',
			[
				'label' => __( 'Hover', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-cates a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'selector' => '{{WRAPPER}} .post-cates',
			]
		);

		/* Excerpt */
		$this->add_control(
			'heading_exc',
			[
				'label' => __( 'Excerpt', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'is_exc' => 'yes',
				]
			]
		);
		$this->add_control(
			'exc_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-content' => 'color: {{VALUE}};',
				],
				'condition' => [
					'is_exc' => 'yes',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'exc_typography',
				'selector' => '{{WRAPPER}} .post-content',
				'condition' => [
					'is_exc' => 'yes',
				]
			]
		);

		/* Post Meta */
		$this->add_control(
			'heading_meta',
			[
				'label' => __( 'Post Meta', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-meta, 
					 {{WRAPPER}} .post-meta li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'meta_hcolor',
			[
				'label' => __( 'Hover', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-meta li a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .post-meta',
			]
		);

		$this->end_controls_section();	

		// Dots.
		$this->start_controls_section(
			'navigation_section',
			[
				'label' => __( 'Dots', 'noor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
			[
				'label' => __( 'Spacing', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'dots_size',
			[
				'label' => __( 'Size', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'dots_bgcolor',
            [
                'label' => __( 'Color', 'noor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .owl-dots .owl-dot:not(.active) span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .owl-dots .owl-dot:hover span, {{WRAPPER}} .owl-dots .owl-dot.active span' => 'border-color: {{VALUE}};'
				],
            ]
        );
        $this->add_control(
			'dots_opacity',
			[
				'label' => esc_html__( 'Opacity', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-dot span' => 'opacity: {{SIZE}};',
				],
			]
		);

        $this->end_controls_section();

        // Arrow.
		$this->start_controls_section(
			'style_nav',
			[
				'label' => __( 'Arrows', 'noor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				]
			]
		);
		
		$this->add_responsive_control(
			'arrow_spacing',
			[
				'label' => __( 'Spacing', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-nav button.owl-prev' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .owl-nav button.owl-next' => 'margin-right: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_bgcolor',
			[
				'label' => __( 'Background', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_hcolor',
			[
				'label' => __( 'Hover', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_bghcolor',
			[
				'label' => __( 'Background Hover', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$dots      = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$arrows    = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		$showXxl   = !empty( $settings['tshow'] ) ? $settings['tshow'] : 3;
		$showXl    = !empty( $settings['tshow_laptop'] ) ? $settings['tshow_laptop'] : $showXxl;
		$showLg    = !empty( $settings['tshow_tablet_extra'] ) ? $settings['tshow_tablet_extra'] : $showXl;
		$showMd    = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $showLg;
		$showSm    = !empty( $settings['tshow_mobile_extra'] ) ? $settings['tshow_mobile_extra'] : $showMd;
		$showXs    = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $showSm;

		$gapXxl      = isset( $settings['slider_spacing']['size'] ) && is_numeric( $settings['slider_spacing']['size'] ) ? $settings['slider_spacing']['size'] : 30;
		$gapXl  = isset( $settings['slider_spacing_laptop']['size'] ) && is_numeric( $settings['slider_spacing_laptop']['size'] ) ? $settings['slider_spacing_laptop']['size'] : $gapXxl;
		$gapLg  = isset( $settings['slider_spacing_tablet_extra']['size'] ) && is_numeric( $settings['slider_spacing_tablet_extra']['size'] ) ? $settings['slider_spacing_tablet_extra']['size'] : $gapXl;
		$gapMd  = isset( $settings['slider_spacing_tablet']['size'] ) && is_numeric( $settings['slider_spacing_tablet']['size'] ) ? $settings['slider_spacing_tablet']['size'] : $gapLg;
		$gapSm  = isset( $settings['slider_spacing_mobile_extra']['size'] ) && is_numeric( $settings['slider_spacing_mobile_extra']['size'] ) ? $settings['slider_spacing_mobile_extra']['size'] : $gapMd;
		$gapXs  = isset( $settings['slider_spacing_mobile']['size'] ) && is_numeric( $settings['slider_spacing_mobile']['size'] ) ? $settings['slider_spacing_mobile']['size'] : $gapSm;
		$timeout  = isset( $settings['timeout']['size'] ) ? $settings['timeout']['size'] : 5000;
		if( $settings['style_layout'] == 'style-2' ){
			$gapXxl = $gapXxl - 30 ;
			$gapXl 	= $gapXl - 30 ;
			$gapLg 	= $gapLg - 30 ;
			$gapMd 	= $gapMd - 30 ;
			$gapSm 	= $gapSm - 30 ;
			$gapXs 	= $gapXs - 30 ;
		}

		$owl_options = [
			'slides_show_desktop'  		 => absint( $showXxl ),
			'slides_show_laptop'  		 => absint( $showXl ),
			'slides_show_tablet_extra'   => absint( $showLg ),
			'slides_show_tablet'   		 => absint( $showMd ),
			'slides_show_mobile_extra'   => absint( $showSm ),
			'slides_show_mobile'   		 => absint( $showXs ),
			'margin_desktop'   	   		 => absint( $gapXxl ),
			'margin_laptop'   	   		 => absint( $gapXl ),
			'margin_tablet_extra'  		 => absint( $gapLg ),
			'margin_tablet'   	   		 => absint( $gapMd ),
			'margin_mobile_extra'   	 => absint( $gapSm ),
			'margin_mobile'   	   		 => absint( $gapXs ),
			'autoplay'      	   		 => $settings['autoplay'] ? $settings['autoplay'] : 'no',
			'autoplay_time_out'    		 => absint( $timeout ),
			'loop'      		   		 => $settings['loop'] ? $settings['loop'] : 'no' ,
			'arrows'        	   		 => $arrows,
			'dots'          	   		 => $dots,
		];

		$this->add_render_attribute(
			'slides', [
				'class'               => [
					'ot-carousel ot-latest-post-carousel',
					'style-2' === $settings['style_layout'] ? 'style-2' : ''
				],
				'data-slider_options' => wp_json_encode( $owl_options ),
			]
		);

		$tag_body_open = '';
		$tag_body_close = '';
		$post_box_class = '';
		$figure_class = 'post-thumbnail overlay hover-scale rounded mb-5';
		$footer_class = 'post-footer';
		if( $settings['style_layout'] == 'style-2' ){
			$tag_body_open = '<div class="card-body">';
			$tag_body_close = '</div">';
			$post_box_class = 'card shadow-lg';
			$figure_class = 'post-thumbnail overlay hover-scale card-img-top';
			$footer_class = 'card-footer';
		}

		$number_show = !empty( $settings['posts_show_number'] ) ? $settings['posts_show_number'] : 5 ;

    	if( $settings['post_cat'] ){
            $args = array(
	            'post_type' => 'post',
	            'post_status' => 'publish',
	            'posts_per_page' => $number_show,
	            'tax_query' => array(
			        array(
			            'taxonomy' => 'category',
			            'field'    => 'slug',
			            'terms'    => $settings['post_cat']
			        ),
			    ),
	        );
        }else{
            $args = array(
                'post_type' => 'post',
	            'post_status' => 'publish',
	            'posts_per_page' => $number_show,
            );
        }
        $the_query = new \WP_Query($args);

        if( $the_query->have_posts() ) : ?>
			<div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
				<div class="owl-carousel owl-theme">
		        	<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

		        		<article class="post-item">
							<div class="<?php echo esc_attr( $post_box_class ); ?>">
								<figure class="<?php echo esc_attr( $figure_class ); ?>">
									<a href="<?php the_permalink(); ?>">
										<?php
											if ( has_post_thumbnail() ) {
												$settings['post_thumbnail'] = [
													'id' => get_post_thumbnail_id(),
												];
												$thumbnail_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'post_thumbnail' );
											}else{
												$thumbnail_html = '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.png" />';
											}
											echo wp_kses_post( $thumbnail_html );
										?>
										<span class="bg"></span>

										<?php if( !empty( $settings['caption_hover'] ) ){ ?> 
										<figcaption>
											<h5 class="from-top mb-0"><?php $this->print_unescaped_setting( 'caption_hover' ); ?></h5>
										</figcaption>
										<?php } ?>
									</a>
								</figure>
								<?php echo wp_kses_post( $tag_body_open ); ?>
									<div class="post-header">
										<?php noor_posted_in(); ?>
							        	<h2 class="post-title h3 mt-1 mb-3">
							        		<a class="title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							        	</h2>
							        </div>
							        <?php if( $settings['is_exc'] == 'yes' ){ ?>
							        <div class="post-content">
							        	<p><?php echo noor_excerpt( $settings['exc_lenght'] ); ?></p>
							        </div>
						        	<?php } ?>
						        <?php echo wp_kses_post( $tag_body_close ); ?>
						        <div class="<?php echo esc_attr( $footer_class ); ?>">
						        	
						        	<?php noor_post_meta(); ?>
						        	
						        </div>
							</div>
						</article>
							
				    <?php endwhile; wp_reset_postdata(); ?>
			    </div>
		    </div>
	    <?php
	    endif; 
	}

	public function get_keywords() {
		return [ 'slider', 'carousel', 'post' ];
	}

	protected function select_param_cate_post() {
		$args = array( 'orderby=name&order=ASC&hide_empty=0' );
		$terms = get_terms( 'category', $args );
		$cat = array();
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){		    
		    foreach ( $terms as $term ) {
		        $cat[$term->slug] = $term->name;
		    }
		}
	  	return $cat;
	}
}
// After the Latest_Posts_Slider class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Latest_Posts_Slider() );