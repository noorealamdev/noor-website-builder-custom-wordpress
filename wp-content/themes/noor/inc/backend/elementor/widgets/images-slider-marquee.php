<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Images Slider
 */
class Noor_Images_Slider_Marquee extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-images-slider-marquee';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'N Images Slider Marquee', 'noor' );
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

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Image', 'noor' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Name', 'noor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Title', 'noor' ),
			]
		);
		
		$repeater->add_control(
			'image_item',
			[
				'label' => __( 'Image', 'noor' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);
		
		$this->add_control(
		    'images_slider',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		        	[
			        	'title'	  => __( 'Image 1', 'noor' ),
						'image_item'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					],
					[
			        	'title'	  => __( 'Image 2', 'noor' ),
						'image_item'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					],
					[
			        	'title'	  => __( 'Image 3', 'noor' ),
						'image_item'	  => [
							'url' 	=> Utils::get_placeholder_image_src(),
						],
					]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_carousel_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

		/* Option Slider */

		$this->add_control(
			'heading_option_slider',
			[
				'label' => esc_html__( 'Slider Option', 'noor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$slides_show = range( 1, 10 );
		$slides_show = array_combine( $slides_show, $slides_show );

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
			'item_auto',
			[
				'label' => __( 'Item Auto', 'noor' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'reverse_direction',
			[
				'label' => __( 'Reverse Direction', 'noor' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'resize_update',
			[
				'label' => __( 'Resize Update', 'noor' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);
		
		$this->add_control(
			'marquee_speed',
			[
				'label' => __( 'Speed', 'noor' ),
				'type' => Controls_Manager::NUMBER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 20000,
						'step' => 1000,
					],
				],
				'min' => 1000,
				'max' => 20000,
				'step' => 100,
				'default' => 3000,
			]
		);
		$this->add_control(
			'slider_spacing',
			[
				'label' => __( 'Item Spacing', 'noor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1000,
				'step' => 5,
			]
		);

		$this->end_controls_section();

		//Style

		$this->start_controls_section(
			'image_style_section',
			[
				'label' => __( 'Image', 'noor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_vertical_align',
			[
				'label' => __( 'Vertical Align', 'noor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Start', 'noor' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Center', 'noor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => __( 'End', 'noor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'condition' => [
					'tshow!' => '1',
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-wrapper' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label' => __( 'Width', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-images-slider-marquee figure img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'noor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-images-slider-marquee figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'noor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-images-slider-marquee figure,
					 {{WRAPPER}} .ot-images-slider-marquee figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['images_slider'] ) ) {
			return;
		}
		$showXxl   = !empty( $settings['tshow'] ) ? $settings['tshow'] : 3;
		$showXl    = !empty( $settings['tshow_laptop'] ) ? $settings['tshow_laptop'] : $showXxl;
		$showLg    = !empty( $settings['tshow_tablet_extra'] ) ? $settings['tshow_tablet_extra'] : $showXl;
		$showMd    = !empty( $settings['tshow_tablet'] ) ? $settings['tshow_tablet'] : $showLg;
		$showSm    = !empty( $settings['tshow_mobile_extra'] ) ? $settings['tshow_mobile_extra'] : $showMd;
		$showXs    = !empty( $settings['tshow_mobile'] ) ? $settings['tshow_mobile'] : $showSm;
		$gap      			 = isset( $settings['slider_spacing'] ) && is_numeric( $settings['slider_spacing'] ) ? $settings['slider_spacing'] : 30;
		$sliderAutoPlayTime  = isset( $settings['marquee_speed'] ) ? $settings['marquee_speed'] : 5000;

		$marquee_options = [
			'data_show_desktop'  	   => absint( $showXxl ),
			'data_show_laptop'  	   => absint( $showXl ),
			'data_show_tablet_extra'   => absint( $showLg ),
			'data_show_tablet'   	   => absint( $showMd ),
			'data_show_mobile_extra'   => absint( $showSm ),
			'data_show_mobile'   	   => absint( $showXs ),
			'data_margin'   	 	   => absint( $gap ),
			'data_speed'  	 	 	   => absint( $sliderAutoPlayTime ),
			'data_reverse'       	   => $settings['reverse_direction'] ? $settings['reverse_direction'] : 'no' ,
			'data_arrows'        	   => false,
			'data_dots'          	   => false,
			'data_centered'		 	   => true,
			'data_loop'		 	 	   => true,
			'data_items_auto'	 	   => $settings['item_auto'] ? $settings['item_auto'] : 'no' ,
			'data_autoplay'	 	 	   => true,
			'data_autoplaytime'	 	   => 1,
			'data_drag'			 	   => false,
			'data_resizeupdate'	 	   => $settings['resize_update'] ? $settings['resize_update'] : 'no' ,
		];

		$this->add_render_attribute(
			'slides', [
				'class'               => 'ot-images-slider-marquee swiper swiper-container',
				'data-slider_options' => wp_json_encode( $marquee_options ),
			]
		);
		if( 'yes' === $settings['item_auto'] ){
			$this->add_render_attribute( 'slides', 'class', 'swiper-auto swiper-auto-xs' );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
			<div class="swiper-wrapper ticker">

				<?php
				foreach ( $settings['images_slider'] as $key => $item ) {

					$title = $item['title'];
					$image_url = Group_Control_Image_Size::get_attachment_image_src( $item['image_item']['id'], 'image_carousel_size', $settings );

					if ( ! $image_url && isset( $item['image_item']['url'] ) ) {
						$image_url = $item['image_item']['url'];
					}
	            	$image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( $title ) . '">';
	            	
					$slide_html = '<div class="swiper-slide"><figure>' . $image_html;

					$slide_html .= '</figure></div>';

					if( $image_url ){
						$slides[] = $slide_html;
					}
				}
				echo implode( '', $slides );
				?>
			</div>
	    </div>
		<?php 
		
	}

	public function get_keywords() {
		return [ 'slider', 'carousel', 'marquee', 'client' ];
	}

}
// After the Noor_Images_Slider_Marquee class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Noor_Images_Slider_Marquee() );