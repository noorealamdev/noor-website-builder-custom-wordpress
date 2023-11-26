<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Sidepanel
 */
class Noor_Sidepanel extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'isidepanel';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'Noor Side Panel', 'noor' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-sidebar';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_noor_header' ];
	}

	protected function register_controls() {
		
		/*** Style ***/
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => __( 'Icon', 'noor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .panel-btn i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_hcolor',
			[
				'label' => __( 'Hover Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .panel-btn i:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .panel-btn i:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_panel_section',
			[
				'label' => __( 'Side Panel', 'noor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'panel_size',
			[
				'label' => __( 'Width', 'noor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 100,
						'max'  => 1000,
						'step' => 10,
					],
				],
				'selectors' => [
					'#side-panel' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'bg_panel',
			[
				'label' => __( 'Background Panel', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'#side-panel' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'bg_close',
			[
				'label' => __( 'Background Close Button', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'#side-panel .side-panel-close' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'color_close',
			[
				'label' => __( 'Color Close Button', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'#side-panel .side-panel-close' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'bg_overlay_color',
			[
				'label' => __( 'Background Overlay', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'.side-panel-active .panel-overlay' => 'background: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		/*** scroll ***/
		$this->start_controls_section(
			'style_sicon_section',
			[
				'label' => __( 'Scroll Icon', 'noor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'sicon_color',
			[
				'label' => __( 'Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .scrolled i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_scolor',
			[
				'label' => __( 'Hover Color', 'noor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .scrolled i:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
			
	    	<div class="octf-sidepanel octf-cta-header hitem">
				<div class="site-overlay panel-overlay"></div>
				<div id="panel-btn" class="panel-btn octf-cta-icons">
					<i class="uil uil-info-circle"></i>
				</div>
			</div>
		    
	    <?php
	}

}
// After the Noor_Sidepanel class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Noor_Sidepanel() );